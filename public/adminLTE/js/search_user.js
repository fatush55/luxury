$(function () {

    let users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            url: adminpath + '/search/typeahead-user?query=%QUERY',
            filter: function (users) {
                return $.map(users,function (user) {
                    return {
                        user_id: user.id,
                        user_name: user.name,
                        user_img: user.img,
                    }
                })
            }
        }
    });

    users.initialize();

    $('#typeahead').typeahead({
        highlight: true
    },{
        name: 'users',
        display: 'user_name',
        limit: 10,
        source: users.ttAdapter(),
        templates: {
            suggestion: function (data) {
                return `
                <div>
                    <span>ID(` + data.user_id + `)</span>
                    <img src="`+ path +`/images/users/` + data.user_img +`" width="30">
                    <span>` + data.user_name + `</span>
                </div>
                `
            }
        }
    });

    $('#typeahead').bind('typeahead:select', function (ev, suggestion) {
        window.location = adminpath + '/search/user?s=' + encodeURIComponent(suggestion.user_name)
    })


});