var products;
var packages;
var items = [];
var selectedProduct;

$(document).on('ready', function () {

    $('#btnAdd').on('click', addRow);
    $(document).on('click', '[data-delete]', deleteItem);
    $('#btnAccept').on('click', addItemsSeries);
    $('#form').on('submit', registerPackage);
});

function addRow() {
    // Validate the product name
    var code = $('#code').val();
    if (!code) {
        alert('Ingrese el código del paquete');
        return;
    }

    var name = $('#name').val();
    if (!name) {
        alert('Ingrese el nombre del paquete');
        return;
    }

    var product = $('#product').val();
    if (!product){
        alert('Seleccione el nombre del producto'); // Not continue
        return;
    }

    $.ajax({
            url: '../public/producto/buscar/' + product
        })
        .done(function( data ) {
            if (data) {
                // if require series
                $('#bodySeries').html('');

                renderTemplateSeries();
                loadAutoCompleteItems(data);

                // Temporary variables
                selectedProduct = { id: data.id, name: data.name };

                $('#modalSeries').modal('show');

            } else {
                alert('Producto no existe');
            }
        });
}

function loadAutoCompleteItems(data) {
    $.ajax({
            url: '../public/items/producto/' + data.id
        })
        .done(function(datos){
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
            items.push({ id: selectedProduct.id, series: series_array[i] });
            renderTemplateItem( selectedProduct.id, selectedProduct.name, series_array[i] );
        }
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

function renderTemplateSeries() {

    var clone = activateTemplate('#template-series');

    $('#bodySeries').append(clone);
}

// Funciones relacionadas al template HTML5
function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

function renderTemplateItem( id, name, series ) {
    var clone = activateTemplate('#template-item');
    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;

    clone.querySelector("[data-delete]").setAttribute('data-delete', id);

    $('#table-items').append(clone);
}

function registerPackage() {
    event.preventDefault();
    var _token = $(this).find('[name=_token]');
    var data = $(this).serializeArray();

    var url_paquete = '../public/paquete/registrar';

    data.push({name: 'items', value: JSON.stringify(items)});

    $.ajax({
            url: url_paquete,
            data: data,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': _token }

        })
        .done(function( response ) {
            if(response.error)
                alert(response.message);
            else{
                console.log(response);
                alert('Paquete registrado correctamente.');
                location.reload();
            }
        });
}