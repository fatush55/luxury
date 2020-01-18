$(function () {
    $('.available select').on('change', function () {
        let modsId = $(this).val(),
            color = $(this).find('option').filter(':selected').data('title'),
            price = $(this).find('option').filter(':selected').data('price'),
            oldPrice = $(this).find('option').filter(':selected').data('old-price'),
            basePrice = $('#base_price').data('base-price'),
            baseOldPrice = $('#base_price').data('base-old-price');

        if (price) {
            $('#base_price').text(symbolLeft + price + symbolRight);
        } else {
            $('#base_price').text(symbolLeft + basePrice + symbolRight);
        }

        if (oldPrice) {
            $('#old_price').text(symbolLeft + oldPrice + symbolRight);
        } else {
            $('#old_price').text(symbolLeft + baseOldPrice + symbolRight);
        }
    });
});