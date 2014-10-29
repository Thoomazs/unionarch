$(function() {

    // price text font-size
    function product_price_font() {
        var originalFontSize = 19;
        $('.product-box .product-box-price h5').each(function() {
            var width = $(this).width();
            var fontSize = (60 / width) * originalFontSize;
            $(this).css({"font-size" : fontSize});
        });

        $('.product-box .product-box-name h4').each(function() {
            var height = $(this).height();
            if(height > 40)
                $(this).css({"font-size" : "13px"});
        });
    }
    product_price_font();



    // FILTER

    var $filter = $("#product-filter");

    $filter.find("form h4 i.mobile").click(function() {
        var $this = $(this);
        var $form = $(this).closest("form");
        if ($form.hasClass("open")) {
            $this.removeClass("fa-caret-up");
            $form.removeClass("open");
        } else {
            $this.addClass("fa-caret-up");
            $form.addClass("open");
        }
    });

    $filter.find("form ul li a").each(function() {
        $(this).data("href", $(this).attr("href"));
    });

    // check inputs form hash url
    var hash_string = window.location.hash;
    var hash = hash_string.split("/");
    hash.shift();
    $.each(hash, function(k, v) {
        if (v != "") {
            var a = v.split("=");
            var data = a[1].split(";");

            $.each(data, function(k, v) {
                var $input = $filter.find(".product-filter-" + a[0]).find("input[data-hash='" + v + "']");
                if ($input) $input.prop("checked", true);

                $input = $filter.find("input[name='" + a[0] + "']");
                if ($input) $input.val(v);
            });
        }
    });


    // generate hash when click to input and AJAX refresh products

    $filter.find("form input").on("change submit", function() {
        var $form = $(this).closest("form");
        //generate hash
        var hash = {
            "search" : [],
            "price"  : []
        };

        var $search = $filter.find(".product-filter-search input[name='search']").val();
        if ($search != "")
            hash.search.push($filter.find(".product-filter-search input[name='search']").val());

        $filter.find(".product-filter-price").find("input:checked").each(function() {
            hash.price.push($(this).data("hash"));
        });

        var hash_string = "";
        $.each(hash, function(k, v) {
            if (null !== v && v.length != 0)
                hash_string += "/" + k + "=" + v.join(";");
        });


        $filter.find("form ul li a").each(function() {
            $(this).attr("href", $(this).data("href") + "#" + hash_string);
        });
        window.location.hash = hash_string;


        // AJAX refresh products
        $(".product-list").html('<div class="col-xs-20 text-center muted font-weight-light" style="padding: 15px;font-size: 20px;"><i class="fa fa-spinner fa-spin fa-margin"></i> Produkty se načítají</div>');
        $.post($form.attr("action"), $form.serialize() + "&ajax=true", function(result) {
            Ext.loading("close");
            $(".product-list").html(result);

            $(".product-list #pager .pagination li a").each(function() {
                $(this).attr("href", $(this).attr("href") + "#" + hash_string);
            })
            product_price_font();
        });
    });

    // if hash ajax upload
    if (window.location.hash) {
        $filter.find("form input:first").change();
    }

    // DETAIL RATING

    var $detail = $("#product.detail");

    $detail.find(".rating .star").on("click", function() {
        var $this = $(this);
        var i = 5 - $this.index();
        $.post(location.href, {rating : i}, function(result) {
            if (Number(result) == 1)
                window.location.reload();
        })
    })
});