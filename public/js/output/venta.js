// Global variables
var items = [];

// Temporary variables
var selectedProduct;

$(document).on('ready', function () {
    $('#btnAdd').on('click', addItem);
    $(document).on('click', '[data-delete]', deleteItem);
    $('#btnAccept').on('click', addItemsSeries);
    $('#form').on('submit', registerOutput);
});

function registerOutput() {
    event.preventDefault();

    var _token = $(this).find('[name=_token]');
    var data = $(this).serializeArray();
    data.push({name: 'items', value: JSON.stringify(items)});
    $.ajax({
        url: 'venta',
        data: data,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': _token }
    })
    .done(function( response ) {
        if(response.error)
            alert(response.message);
        else{
            alert('Venta registrada correctamente.');
            location.reload();
        }

    });
}

function addItem() {
    // Validate the product name
    var name = $('#producto').val();
    if (!name) return;

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
    console.log(series_total);
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
};

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

function renderTemplateSeries() {

    var clone = activateTemplate('#template-series');

    $('#bodySeries').append(clone);
}
