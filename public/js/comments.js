var Comments = function (element, options) {
    this.type = null;
    this.options = null;
    this.$element = null;

    this.init('comments', element, options)
};

Comments.prototype.init = function (type, element, options) {
    this.type = type;
    this.$element = $(element);
    this.options = this.get_options(options);
    this.$inner = $(element).html(this.options.template).find(this.options.inner).html(this.options.loading_div);

    this.load_data({form: true, comments: true, level: 0});
};

Comments.prototype.get_defaults = function () {
    return {
        code: null,
        levels: 0,
        animation: false,
        ajax_url: "http://" + location.host + "/ajax/comment",
        loading_div: '<div class="comments-loading text-center"><i class="fa fa-spinner fa-spin"></i>Komentáře se načítají</div>',
        template: '<div class="comments-list"></div>',
        inner: '.comments-list',
        editable: false
    }
};

Comments.prototype.get_options = function (options) {
    options = $.extend({}, this.get_defaults(), this.$element.data(), options);
    return options;
};

Comments.prototype.load_data = function (options) {
    var $this = this;
    options = $.extend({
        offset: 0,
        comments: false,
        form: false,
        return: location.pathname,
        reply: ($this.options.levels >= (options.level - 1)),
        code: $this.options.code
    }, options);

    $.post(this.options.ajax_url + "/load/", options, function (result) {

        if (options.id && options.comments) {
            $this.$inner.find(".comment-wrap[data-id='" + options.id + "'] .comments-loading").remove();
            $this.$inner.find(".comment-wrap[data-id='" + options.id + "'] .comment-replies:first").append(result);
        } else if (options.id && options.form) {
            var elm = $this.$inner.find(".comment-wrap[data-id='" + options.id + "'] .comment-replies:first").prepend(result);
        } else {
            $this.$inner.find(".comments-loading").remove();
            $this.$inner.append(result);
        }

        // init ovladacich prvku nove nactenych prispevku
        $this.control_init();

        // focus formu
        if (options.id && options.form)
            elm.find(".comment-form-editable").focus();
    });
};

Comments.prototype.send_new = function (options, callback) {
    var $this = this;
    options = $.extend({}, options);

    // AJAXovy dotaz
    $.post($this.options.ajax_url + "/new/", options, function (result) {
        if (typeof callback == "function") callback();
    });
};

Comments.prototype.rate = function (options) {
    var $this = this;
    options = $.extend({}, options);

    // AJAXovy dotaz
    $.post($this.options.ajax_url + "/rate/", options, function (result) {

    });
};

Comments.prototype.control_init = function () {
    var $this = this;

    //inicializace podpurnych funkci
    Ext.init();
    // new
    $this.$inner.find(".comment-new .comment-form")
        .off("submit").on("submit", function () {
            var $form = $(this);

            //není prázdný komentář
            if ($form.find(".comment-form-editable").text().length != 0) {

                var id = $form.closest(".comment-wrap[data-id]").data("id");

                // parametry pro ajax
                var options = {
                    text: $form.find(".comment-form-editable").html(),
                    code: $this.options.code,
                    replyTo: id
                };

                // disabled během odesílaní
                $form.find(".comment-form-editable").addClass("disabled").attr("contenteditable", false);
                $form.find(".comment-form-remove").fadeOut(200);
                $form.find(".comment-form-controls [type=submit]").html("<i class='fa fa-spinner fa-spin'></i> Odesílám").attr("disabled", true);

                // odeslani
                $this.send_new(options, function () {
                    if (isFinite(id)) {
                        var wrap = $form.closest(".comment-replies");
                        var count = Number(wrap.find(".comment-controls:first .count").html()) + 1;
                        wrap.find(".comment-controls:first .count").html(count);

                        wrap.find(".comment-hide:first").click();
                        wrap.find(".comment-show:first").click();
                        wrap.find(".comment-new").remove();
                    } else {
                        $this.$inner.html($this.options.loading_div);
                        $this.load_data({form: true, comments: true, level: 0});
                    }
                });

            } else {
                $form.find(".comment-form-editable").focus();
            }
        });
    // editable
    $this.$inner.find(".comment-form-editable")
        .off("focus").on("focus", function () {
            var wrap = $(this).closest(".comment-form");

            wrap.find(".comment-form-remove").fadeIn(200);
            wrap.find(".comment-form-controls").fadeIn(200);
        });

    // Clear text button
    $this.$inner.find(".comment-form-remove").off("click").on("click", function () {
        var wrap = $(this).closest(".comment-form");

        if (wrap.parents(".comment-wrap[data-id]").length != 0) {
            wrap.parents(".comment-new:first").remove();
            return;
        }

        wrap.find(".comment-form-editable").text("");
        wrap.find(".comment-form-controls").fadeOut(0);
        $(this).fadeOut(0);
    });

    // reply comment
    $this.$inner.find(".comment-controls .reply").off("click").on("click", function () {
        var wrap = $(this).closest(".comment-wrap[data-id]");
        if (wrap.find(".comment-replies:first > .comment-new").length == 0) {
            var options = {
                id: wrap.data("id"),
                comments: false,
                form: true
            };
            $this.load_data(options);
        }
    });

    // show/hide comment
    $this.$inner.find(".comment-replies .comment-show").off("click").on("click", function () {
        var wrap = $(this).closest(".comment-wrap[data-id]");
        var level = $(this).parents(".comment-wrap[data-id]").length;

        $(this).hide().siblings(".comment-hide").show();


        var options = {
            id: wrap.data("id"),
            level: level,
            comments: true
        };
        wrap.find(".comment-replies").append($this.options.loading_div);
        $this.load_data(options);
    });
    $this.$inner.find(".comment-replies .comment-hide").off("click").on("click", function () {
        var wrap = $(this).closest(".comment-wrap");

        $(this).hide().siblings(".comment-show").show();
        wrap.find(".comment-replies .comment-wrap[data-id], .comments-older, .comments-loading").remove();
    });

    //rate
    $this.$inner.find(".comment-wrap .comment-controls .rate").off("click").on("click", function () {
        var wrap = $(this).closest(".comment-wrap[data-id]");
        var options = {
            value: $(this).data("value"),
            id: wrap.data("id")
        };

        $this.rate(options);
    });


    //older
    $this.$inner.find(".comments-older").off("click").on("click", function () {
        var i = $(this).siblings(".comment-wrap[data-id]").length;
        var id = $(this).closest(".comment-wrap[data-id]").data("id");
        var level = $(this).parents(".comment-wrap[data-id]").length;

        $(this).after($this.options.loading_div).remove();

        var options = {
            offset: i,
            id: id,
            level: level,
            comments: true
        };

        $this.load_data(options);
    });

};

Comments.prototype.refresh = function () {
    var $this = this;
    $this.$inner.html($this.options.loading_div);
    $this.load_data({form: true, comments: true, level: 0});
};

$.fn.comments = function (option) {

    return this.each(function () {
        var $this = $(this);
        var data = $this.data('Ext.comments');
        var options = typeof option == 'object' && option;

        if (!data) $this.data('Ext.comments', (data = new Comments(this, options)));
        if (typeof option == 'string') data[option]();
    });
};

$.fn.comments.Constructor = Comments;