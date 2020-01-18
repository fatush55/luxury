$(function () {

    $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    $('.quantity').each(function () {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });


    $(".quantity").on("mouseenter", function () {

        $(".quantity-up").animate({
            backgroundColor: "#73b6e1",
        }, 300);

        $(".quantity-down").animate({
            backgroundColor: "#73b6e1"
        }, 300);

        $('.quantity input').animate({
            backgroundColor: "#73b6e1"
        },300)

    });

    $(".quantity").on("mouseleave", function () {

        $(".quantity-up").animate({
            backgroundColor: "black",
        }, 300);

        $(".quantity-down").animate({
            backgroundColor: "black"
        }, 300);

        $('.quantity input').animate({
            backgroundColor: "black"
        },300)

    });
});


