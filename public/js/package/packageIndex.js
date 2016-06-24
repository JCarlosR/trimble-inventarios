$(document).on('ready', function () {
    $('[data-look]').on('click', lookDetails);
    $('[data-delete]').on('click', mostrarDescomponer);
    $('[data-edit]').on('click', mostrarEditar);

    $modalDescomponer = $('#modalDescomponer');
    $modalEdit = $('#modalEdit');

    var url_products ='../public/productos/names';
    var url_locations ='../public/paquete/ubicaciones';

    $.ajax({
        url: url_locations,
        method: 'GET'
    }).done(function(datos) {

        locations = datos;
        loadAutoCompleteLocations(locations);
    });

    $.ajax({
        url: url_products,
        method: 'GET'
    }).done(function(datos) {

        products = datos.products;
        loadAutoCompleteProducts(products);
    });
});

var $modalDescomponer;
var $modalEdit;

function mostrarDescomponer()
{
    var id = $(this).data('delete');
    $modalDescomponer.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalDescomponer.find('[name="name"]').val(name);
    $modalDescomponer.modal('show');


    var id_destroy = $('#id').val();
    $('#sayYes').click( function(event) {
        event.preventDefault();
        $.ajax({
            url: '../public/paquete/descomponer/'+id_destroy,
            method: 'GET'
        }).done(function (response) {
            alert(response.message);
            location.reload();
        });
    });
}

function mostrarEditar()
{
    var id = $(this).data('edit');

    var code = $(this).data('code');
    $modalEdit.find('[name="code"]').val(code);

    var name = $(this).data('name');
    $modalEdit.find('[name="name"]').val(name);

    var location = $(this).data('location');
    $modalEdit.find('[name="location"]').val(location);

    var description = $(this).data('description');
    $modalEdit.find('[name="description"]').val(description);

    $modalEdit.modal('show');
}



// Funciones relacionadas al template HTML5
function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

// Deails of packages
function lookDetails() {
    var id = $(this).data('look');

    $.ajax({
        url: '../public/paquete/detalles/'+id,
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

function renderTemplateDetails(name, series, price) {
    var clone = activateTemplate('#template-details');

    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;
    clone.querySelector("[data-price]").innerHTML = price;

    $('#table-details').append(clone);
}

function loadAutoCompleteProducts(data) {
    $('#product').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'products',
            source: substringMatcher(data)
        }
    );

}

function loadAutoCompleteLocations(data) {
    $('#location').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'locations',
            source: substringMatcher(data)
        }
    );
}