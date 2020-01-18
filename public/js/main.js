// Can also be used with $(document).ready()
$(window).load(function () {
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
    });
});


var menu_ul = $('.menu_drop > li > ul'),
    menu_a = $('.menu_drop > li > a');

menu_ul.hide();

menu_a.click(function (e) {
    e.preventDefault();
    if (!$(this).hasClass('active')) {
        menu_a.removeClass('active');
        menu_ul.filter(':visible').slideUp('normal');
        $(this).addClass('active').next().stop(true, true).slideDown('normal');
    } else {
        $(this).removeClass('active');
        $(this).next().stop(true, true).slideUp('normal');
    }
});

$(function () {

    // Slideshow 4
    $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
            $('.events').append("<li>after event fired.</li>");
        }
    });


    addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }

});

$(function () {

    $('body').on('click', '.order_event', function () {
         let id = $(this).data('id');

         window.location.replace( path + '/user/order-show?id=' + id);

         // $.ajax({
         //     url: '/user/order-show',
         //     data: {id:id},
         // })

    });

});