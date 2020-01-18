$(function () {

    let buttonSingle = $("#single"),
        buttonMulti = $("#multi"),
        file;

    new AjaxUpload(buttonSingle, {
        action: adminpath + buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'),
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
                alert("Error only photo");
                return false;
            }
            buttonSingle.closest(".file-upload").find('.overlay').css({'display': 'flex'});
        },
        onComplete: function (file, response) {
            setTimeout(function () {
                buttonSingle.closest(".file-upload").find('.overlay').css({'display': 'none'});

                response = JSON.parse(response);

                $('.' + buttonSingle.data('name')).show('fade', function () {
                    $('.' + buttonSingle.data('name')).html("<img src='/images/" + response.file + "' style='max-height: 150px'>");
                });
            }, 1000);
        }
    });

    new AjaxUpload(buttonMulti, {
        action: adminpath + buttonMulti.data('url') + "?upload=1",
        data: {name: buttonMulti.data('name')},
        name: buttonMulti.data('name'),
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
                alert("Error only photo");
                return false;
            }
            buttonMulti.closest(".file-upload").find('.overlay').css({'display': 'flex'});
        },
        onComplete: function (file, response) {
            setTimeout(function () {
                buttonMulti.closest(".file-upload").find('.overlay').css({'display': 'none'});

                response = JSON.parse(response);

                $('.row-' + buttonMulti.data('name')).append("<div class='multi'><img src='/images/" + response.file +
                    "' style='max-height: 150px;'><a href='#' class='text-danger btm-delete btn-delete-multi' " +
                    "data-url='" + response.file + "' data-id='null'><i class='fas fa-times'></i></a></div>");
            }, 1000);
        }
    });

    $('body').on('click', '.btm-delete', function (e) {
        e.preventDefault();
       let id =  $(this).data('id'),
           url =  $(this).data('url');

       $.ajax({
           url: adminpath + '/product/delete-image',
           data: ({id:id,url:url}),
           success:function () {
               show(url);
           },
           error: function (res) {
               alert(res)
           }
       });
    });

    function show(url) {
        $(".btm-delete[data-url='" + url +"']").closest('.multi').hide('fade', 500, function () {
            $(".btm-delete[data-url='" + url +"']").closest('.multi').html('');
        });
    }

});