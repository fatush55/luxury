$('#editor_1').ckeditor();

$(function () {
    $('#reset_attr').click(function () {
        $(".reset_attr input[type = radio]").prop('checked', false)
    });

    $('.select2').select2({
        placeholder: "Enter name product",
        minimumInputLength: 2,
        cache: true,
        ajax: {
            url: adminpath + '/product/related-product',
            delay: 250,
            dataType: 'json',
            data: function (params) {
                return{
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items,
                };
            },
        },
    });

    $('body').on('click', '.custom-switch', function () {
        let id =  $(this).data('id'),
            status =  $(this).data('status');

        $.ajax({
            url: adminpath + '/product/status',
            data: {id:id,status:status},
            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

    /* modification product - start */

    $('#add_mod').click(function () {
        let qty =  $('.body_mod .card').length,
            id = qty + 1;

        $.getScript( path + '/js/validator.js');

        let res = '                                        <div class="card card-warning" id="card-mod-' + id + '">\n' +
            '                                            <div class="card-header">\n' +
            '                                                <div class="row">\n' +
            '                                                    <div class="col col-md-11">\n' +
            '                                                        <h3 class="card-title">Modification</h3>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col col-md-1 text-right">\n' +
            '                                                        <a href="" class="text-danger mod_del" data-id="' + id + '">\n' +
            '                                                            <i class="fas fa-times"></i>\n' +
            '                                                        </a>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <div class="card-body">\n' +
            '                                                <div class="row">\n' +
            '                                                    <div class="col-6">\n' +
            '                                                        <div class="form-group has-feedback">\n' +
            '                                                            <input name="mod[' + id + '][title]" type="text" class="form-control"\n' +
            '                                                                   placeholder="Name"\n' +
            '                                                                   data-error="Enter name modification" required>\n' +
            '                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>\n' +
            '                                                            <div class="help-block with-errors text-danger"></div>\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-3">\n' +
            '                                                        <div class="form-group has-feedback">\n' +
            '                                                            <input name="mod[' + id + '][price]" type="text" class="form-control"\n' +
            '                                                                   placeholder="Price"\n' +
            '                                                                   data-error="Only integers and points" required pattern="^[0-9.]{1,}$">\n' +
            '                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>\n' +
            '                                                            <div class="help-block with-errors text-danger"></div>\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-3">\n' +
            '                                                        <input type="text" class="form-control" placeholder="Old Price"\n' +
            '                                                               name="mod[' + id + '][old_price]" value="0">\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n';
        $('.body_mod').append(res);
    });

    $('body').on('click', '.mod_del', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $('#card-mod-' + id).html('');

    })

    /* modification product - end */

});


