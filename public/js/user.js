
$(function () {
    $('body').on('click', '.box_mod_user_0', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/user/show',
            type: 'GET',
            success: function (res) {
                show(res);
            } ,error: function () {
                // alert('ERROR /user/show');
            }
        });
    });

    $('body').on('click', '#login_btn', function (e) {
        e.preventDefault();
        $data = {};

        $('#remember').on('change', function(){
            this.value = this.checked ? 1 : 0;
            // alert(this.value);
        }).change();

        $('#login_form').find('input').each(function () {
            $data[this.name] = $(this).val();
        });

        $.ajax({
            url: '/user/login',
            type: 'POST',
            data: $data,
            success: function (res) {
                if ($.trim(res) === "<p></p>"){
                    window.location = location.href;
                } else {
                    show(res);
                }
            }, error: function (res) {
                alert(res)
            }
        })
    });

    // $('body').on('click', '#register', function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: '/users/register',
    //         type: 'GET',
    //         success: function (res) {
    //             show(res);
    //         } ,error: function () {
    //             alert('/users/show');
    //         }
    //     });
    //
    //     let head = 'Registered';
    //     $('#users .modal-title').html(head);
    // });

    // $('body').on('click', '#authorization', function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: '/users/show',
    //         type: 'GET',
    //         success: function (res) {
    //             show(res);
    //         } ,error: function () {
    //             alert('/users/show');
    //         }
    //     });
    //     let head = 'Enter in shop Luxury Watches';
    //     $('#users .modal-title').html(head);
    //
    // });

    // $(function () {
    //     $('body').on('click', '#singnup_btn', function (e) {
    //         e.preventDefault();
    //         $data = {};
    //
    //         $('#signup_form').find('input').each(function () {
    //            $data[this.name] = $(this).val();
    //         });
    //
    //         $.ajax({
    //            url: '/users/signup',
    //            type: 'POST',
    //            data: $data,
    //            success: function (res) {
    //                show(res);
    //            }, error: function (res) {
    //                alert(res)
    //            }
    //        })
    //    })
    // });


    function show(res){
        $('#user .modal-body').html(res);
        $('#user').modal();
    }

});