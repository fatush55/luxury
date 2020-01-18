$(function () {

    $('.delete').click(function () {


        var id = $(this).data('id'),
            res = confirm('Confirm Removal #' + id + ' Order');
        if (!res) return false;
    });

    $('.delete_cat').click(function () {


        var id = $(this).data('id'),
            res = confirm('Confirm Removal Category');
        if (!res) return false;
    });

});