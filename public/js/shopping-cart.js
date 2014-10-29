$(function() {
    var cart_ajax = false;

    if (cart_ajax == true) {

        $("form.product-form").off("submit").on("submit", function() {
            var $form = $(this);

            $.post("/nakupni-kosik/pridano-do-kosiku/", $form.serialize() + "&ajax=true", function(result) {
//                console.log(result);
                var json = $.extend({
                    cart    : {
                        cart_price    : "none",
                        cart_quantity : "none"
                    },
                    product : []
                }, $.parseJSON(result));

                var $header = $("#header-cart");

                // update header cart
                if (json.cart.cart_quantity != "none" && json.cart.cart_quantity != "none") {
                    $header.find(".cart-quantity").html(Math.round(Number(json.cart.cart_quantity)));
                    $header.find(".cart-price").html(Math.round(Number(json.cart.cart_price)));
                }
                if (json.product) {
                    $header.addClass("active");

                    var prd = json.product;
                    var o = '';
                    o += '<div class="row">';
                    o += '  <div class="col-xs-20">';
                    o += '      <p class="muted text-center">Přidali jste do košíku:</p>';
                    o += '      <h4>' + prd.product_title + '</h4>';
                    o += '  </div>';
                    o += '</div>';
                    o += '<div class="row">';
                    o += '  <div class="col-xs-10">';
                    o += '      <img class="img-responsive" src="' + prd.product_image.url + '" alt=""/>';
                    o += '  </div>';
                    o += '  <div class="col-xs-10">';
                    o += '      <h4 class="font-weight-semibold text-info">' + prd.product_price + ' Kč <span class="font-weight-light muted">(1 ks)</span></h4>';
                    o += '  </div>';
                    o += '</div>';

                    $header.find(".add-to-cart").html(o).fadeIn(100).delay(5000)
                        .fadeOut(100, function() {
                            $(this).html("");
                            $header.removeClass("active");
                        });
                }
            });

            // neodesilat jako klasicky form
            return false;
        });
    }

    var $content = $("#page").find("#shopping-cart");


    $content.filter(".step1").find("form select").on("change", function() {
        $(this).closest("form").submit();
    });
    $content.filter(".step1").find("form input").on("submit blur", function() {
        $(this).closest("form").submit();
    });

    $content.filter(".step2").find("[name='billing-address']").on("change", function() {
        var $this = $(this);
        if ($this.is(":checked")) {
            $this.closest(".cart-content").find(".billing-address").show();
        } else {
            $this.closest(".cart-content").find(".billing-address").hide();
        }
    });



    $content.filter(".step3").find("[name='payment_id'], [name='transport_id'], input[data-toggle='datepicker'], input[data-toggle='timepicker']").on("change",function() {
        var $this = $(this);
        var $form = $("form");
        var $picker = $content.filter(".step3").find("input[data-toggle='datepicker']").pickadate('picker');

        // min date in datepicker
        var delivery = $form.find("[name='payment_id']:checked").closest("label").find("[name*='delivery-date']").val() || $form.find("[name='payment_id']:first").closest("label").find("[name*='delivery-date']").val();
        delivery = delivery.split(",");
        delivery[1]--;
        $picker.set('min', delivery);

        //calc price
        var payment = $form.find("[name='payment_id']:checked").closest("label").find("[name*='payment-price']").val() || 0;
        var transport = $form.find("[name='transport_id']:checked").closest("label").find("[name*='transport-price']").val() || 0;
        var order_price = $form.find("[name='order-price']").val();

        var picked_date = $form.find("input[data-toggle='datepicker']").val().split(". ");
        var picked_time = $form.find("input[data-toggle='timepicker']").val().split(":");
        var delivery_price = 0;
        if (picked_date.length == 3 && picked_time.length == 2) {
            var date = new Date(picked_date[2], (picked_date[1] - 1), picked_date[0], picked_time[0], picked_time[1]);
            var time = Number(picked_time.join(""));

            var weekend = $form.find(".check.weekend");
            var weekday = $form.find(".check.weekday");
            var day = date.getDay();

            if ($form.find("[name='transport_id']:checked").val() == 2) {
                if ((day == 0 || day == 6) && (time >= 1000 && time <= 1300)) {
                    weekend.css({"visibility" : "visible"});
                    weekday.css({"visibility" : "hidden"});

                } else if (time >= 1000 && time <= 1300) {
                    weekend.css({"visibility" : "hidden"});
                    weekday.css({"visibility" : "visible"});
                } else {
                    weekend.css({"visibility" : "hidden"});
                    weekday.css({"visibility" : "hidden"});
                    delivery_price = 100;
                }
            } else {
                delivery_price = 0;
            }
        }

        //set price
        $form.find("[name='delivery-price']").val(delivery_price);
        $form.find(".cart-price-overall").html((Number(payment) + Number(transport) + Number(order_price) + Number(delivery_price)) + " Kč");

        $form.find(".hidden-box").hide();
        $("[name='payment_id']:checked, [name='transport_id']:checked").closest(".radio").find(".hidden-box").show();
    }).filter(":first").trigger("change");
});