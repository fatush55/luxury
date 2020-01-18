$(function () {

    $('body').on('click', '.add-to-cart-link', function (e) {
        e.preventDefault();
        let id = $(this).data('id'),
            qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
            mod = $('.available select').val() ? $('.available select').val() : '';

        $.ajax({
            url: '/cart/add',
            data: {id: id, qty: qty, mod: mod},
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert("Error ");
            }
        })
    });

    function showCart(cart) {
        if ($.trim(cart) === '<h3>Cart is empty</h3>') {
            $('#buy, #empty_trash').css('display', 'none');
        } else {
            $('#buy, #empty_trash').css('display', 'inline-block');
        }

        $('#cart .modal-body').html(cart);
        $('#cart').modal();

        $.getScript( path + '/js/quantity_product_cart.js');

        if ($('.sum').text()) {
            $('.simpleCart_total').html($('.sum').text());
        } else {
            $('.simpleCart_total').html('Empty Cart');
        }

        if ($('.qty_item').text()) {
            $('.quantity-icon').html($('.qty_item').text());
            $('.quantity-icon').css('opacity', 1);
        } else {
            $('.quantity-icon').html('');
            $('.quantity-icon').css('opacity', 0);
        }
    }

    $('body').on('click', '.box_mod_cart', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/cart/show',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert("box_mod_cart");
            }
        })
    });

    $('body').on('click', '#delete-product', function () {
        let id = $(this).data('id');
        $.ajax({
            url: 'cart/delete',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('ERROR');
            }
        });
    });

    $('body').on('click', '#empty_trash', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'cart/clear',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('ERROR');
            }
        });
    });

    $('body').on('change', '.cart_qty_product input',function (e) {
        e.preventDefault();

        let id = $(this).data('id'),
            qty = $(this.value);

        qty = Number(qty.selector);

        $.ajax({
            url: 'cart/count',
            data: {id:id, qty:qty},
            type: "GET",
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert("cart/count")
            }
        })
    })
});