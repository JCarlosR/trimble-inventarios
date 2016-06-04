var products;
var packages;
var dataset;
var items = [];

// Temporary variables
var selectedProduct;

$(document).on('ready', function () {
    
    $('#product').on('blur', handleBlurProduct);
    $('#btnAdd').on('click', addRow);
    $(document).on('click', '[data-delete]', deleteItem);
    $(document).on('click', '[data-look]', lookDetails);
    $('#btnAccept').on('click', addItemsSeries);


    var url_products ='../productos/names';
    var url_packages = '../paquetes/disponibles';

    $.ajax({
        url: url_products,
        method: 'GET'
    }).done(function(datos) {

        products = datos.products;
        if( Object.prototype.toString.call(products) === '[object Array]'
        && Object.prototype.toString.call(packages) === '[object Array]' )
        {
            dataset = products.concat(packages);
            loadAutoCompleteProducts(dataset);
        }

    });

    $.ajax({
        url: url_packages
    }).done(function(datos) {
        packages = datos.packages;
        if( Object.prototype.toString.call(products) === '[object Array]'
            && Object.prototype.toString.call(packages) === '[object Array]' )
        {
            dataset = products.concat(packages);
            loadAutoCompleteProducts(dataset);
        }

    });

});

function lookDetails() {
    var id = $(this).data('look');
    $.ajax({
        url: '../paquete/detalles/'+id,
        method: 'GET'
    }).done(function(datos) {
        $('#table-details').html('');
        for (var i = 0; i<datos.length; ++i)
        {
            renderTemplateDetails(datos[i].product.name, datos[i].series, datos[i].product.price);
        }

        $('#modalDetails').modal('show');
    });
}

function addRow() {
    // Validate the product name
    var name = $('#product').val();
    if (!name) return;

    var customer = $('#cliente').val();
    if (!customer) return;

    // Validate quantity products
    var _quantity = $('#cantidad').val();
    var quantity = parseInt(_quantity);
    if (!quantity || quantity < 1)
        return;

    // Validate price products
    var _price = $('#precio').val();
    var price = parseFloat(_price);
    if (!price || price <= 0)
        return;

    var search = $('#product').val();

    if ( packages.indexOf(search) != -1 )
    {
        $.ajax({
                url: '../paquete/buscar/' + name
            })
            .done(function( data ) {
                if (data) {
                    items.push({id: data.id, series: data.code, quantity: 1, price:price})
                    renderTemplatePackage(data.id, data.code, 1, price, price)
                    updateTotal();
                } else {
                    alert('Paquete no existe');
                }
            });
    }else {
        $.ajax({
                url: '../producto/buscar/' + name
            })
            .done(function( data ) {
                if (data) {
                    // if require series

                    $('#bodySeries').html('');
                    for (var i = 0; i<quantity; ++i) {
                        renderTemplateSeries();
                    }

                    loadAutoCompleteItems(data);

                    // Temporary variables
                    selectedProduct = { id: data.id, name: name, price: price };

                    $('#modalSeries').modal('show');

                } else {
                    alert('Producto no existe');
                }
            });
    }



}

function loadAutoCompleteItems(data) {
    $.ajax({
            url: '../items/producto/' + data.id

        })
        .done(function(datos){
            //console.log(JSON.parse(datos));
            $('[data-search]').typeahead(
                {
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: 'items',
                    source: substringMatcher(JSON.parse(datos))
                }
            );
        });
}

function handleBlurProduct() {
    $('#cantidad').val("");
    $('#cantidad').prop('readonly', false);
    var search = $('#product').val();

    if ( packages.indexOf(search) != -1 )
    {
        $('#cantidad').val(1);
        $('#cantidad').prop('readonly', true);
    }

}

function addItemsSeries() {
    var series_array = [];
    $('#bodySeries').find('input').each(function (i, element) {
        var series = $(element).val();
        if(series != "")
            series_array.push(series);
    });

    if( dontRepeat(series_array) ) {
        for ( var i=0; i<series_array.length; ++i) {
            items.push({ id: selectedProduct.id, series: series_array[i], quantity: 1, price: selectedProduct.price });
            renderTemplateItem(selectedProduct.id, selectedProduct.name, series_array[i], 1, selectedProduct.price, selectedProduct.price);
        }

        updateTotal();
        $('#modalSeries').modal('hide');

    } else {
        alert('Existen series repetidas.');
    }
}

function dontRepeat(series_array) {

    var series_total = series_array.slice(0);
    for (var i = 0; i<items.length; ++i)
        series_total.push(items[i].series);

    for (var i = 0; i<series_array.length; ++i) {
        for (var j = i+1; j<series_total.length; ++j)
            if (series_array[i] == series_total[j])
                return false;
    }
    return true;
}

function deleteItem() {
    var $tr = $(this).parents('tr');
    var id = $(this).data('delete');
    var series = $tr.find('[data-series]').text();
    itemDelete(id, series);
    $tr.remove();
}

function itemDelete(id, series) {
    for (var i = 0; i<items.length; ++i) {
        if (items[i].id == id && items[i].series == series) {
            items.splice(i, 1);
            updateTotal();
            return;
        }
    }
}

function updateTotal() {
    var total = 0;
    for (var i=0; i<items.length; ++i)
        total += items[i].price * items[i].quantity;
    $('#total').val(total);
}


// Funciones relacionadas al template HTML5
function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

function renderTemplatePackage(id, code, quantity, price, sub) {
    var clone = activateTemplate('#template-package');

    clone.querySelector("[data-name]").innerHTML = 'Paquete';
    clone.querySelector("[data-series]").innerHTML = code;
    clone.querySelector("[data-quantity]").innerHTML = quantity;
    clone.querySelector("[data-price]").innerHTML = price;
    clone.querySelector("[data-sub]").innerHTML = sub;
    clone.querySelector("[data-look]").setAttribute('data-look', id);
    clone.querySelector("[data-delete]").setAttribute('data-delete', id);

    $('#table-items').append(clone);
}

function renderTemplateDetails(name, series, price) {
    var clone = activateTemplate('#template-details');

    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;
    clone.querySelector("[data-price]").innerHTML = price;

    $('#table-details').append(clone);
}

function renderTemplateItem(id, name, series, quantity, price, sub) {
    var clone = activateTemplate('#template-item');

    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;
    clone.querySelector("[data-quantity]").innerHTML = quantity;
    clone.querySelector("[data-price]").innerHTML = price;
    clone.querySelector("[data-sub]").innerHTML = sub;

    clone.querySelector("[data-delete]").setAttribute('data-delete', id);

    $('#table-items').append(clone);
}

function loadAutoCompleteProducts(data) {

    $('#product').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'product',
            source: substringMatcher(data)
        }
    );

}

function renderTemplateSeries() {

    var clone = activateTemplate('#template-series');

    $('#bodySeries').append(clone);
}