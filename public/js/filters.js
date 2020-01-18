$(function () {

    $('body').on('change', '.w_sidebar input', function (e) {
        let checked = $('.w_sidebar input:checked'),
            data = '';
        checked.each(function () {
            data += $.trim(this.value) + ',';
        });
        if (data) {
            $.ajax({
                url: location.href,
                data: {filter: data},
                type: 'GET',
                beforeSend: function () {
                    $('.preloader').fadeIn(300, function () {
                        $('.product-one').hide();
                    });
                },
                success: function (res) {
                    $('.preloader').delay(500).fadeOut('slow', function () {
                        $('.product-one').html(res).fadeIn();
                        let url = location.search.replace(/filter(.+?)(&|$)/g, '');
                        let newUrl = location.pathname + url + (location.search ? "&" : '?') + "filter=" + data;
                        newUrl = newUrl.replace('&&', '&');
                        newUrl = newUrl.replace('?&', '?');
                        history.pushState({}, '', newUrl);
                    })
                }
            });
        } else {
            window.location = location.pathname;
        }

    });
});