$(function () {

    $('.preloader').fadeIn(300, function () {
        $('.product-one').hide();
    });

    setTimeout(function () {
        $('#payment').submit();
    },2000);

});