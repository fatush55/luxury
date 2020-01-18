$(function () {



    let products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            url: path + '/search/typeahead?query=%QUERY',
            filter: function (products) {
                return $.map(products,function (product) {
                    return {
                        product_id: product.id,
                        product_title: product.title,
                        product_img: product.img,
                    }
                })
            }
        }
    });

    console.log();

    products.initialize();

    $('#typeahead').typeahead({
        highlight: true
    },{
        name: 'product',
        display: 'product_title',
        limit: 10,
        source: products.ttAdapter(),
        templates: {
            suggestion: function (data) {
                return `
                <div>
                    <img src="images/` + data.product_img +`" width="30">
                    <span>` + data.product_title + `</span>
                </div>
                `
            }
        }
    });

    $('#typeahead').bind('typeahead:select', function (ev, suggestion) {
        console.log(encodeURIComponent(suggestion.title));
        window.location = path + '/search/?s=' + encodeURIComponent(suggestion.product_title)
    })


});