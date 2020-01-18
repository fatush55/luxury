$(function () {
    $('.main-sidebar a').each(function () {
        let location =  window.location.protocol + '//' + window.location.hostname + window.location.pathname;

        if (this.href === location){
            $(this).addClass('active');
            $(this).closest('.has-treeview').children('a').addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });
});