$(document).on('ready', function () {
        // Details of packages
    $(document).on('click', '[data-look]', lookDetails);
});

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