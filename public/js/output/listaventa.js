$(document).on('ready', function (){
    $('#btnShowOutputs').on('click', showOutputs);
    $('#bodyOutput').on('click', 'tr', showDetails);
});

function showOutputs() {
    var cliente = $('#clientes').val();
    var inicio = $('#inicio').val();
    var fin = $('#fin').val();

    if (!cliente || !inicio || !fin)
        return;

    var url = $(this).data('href');
    url = url.replace('{cliente}',cliente);
    url = url.replace('{inicio}',inicio);
    url = url.replace('{fin}',fin);
    location.href = url;
}

function showDetails() {
    var id = $(this).find('[data-id]').data('id');
    var url = $('#bodyOutput').data('href').replace('{id}', id);
    $.ajax({
            url: url
        })
        .done(function( data ) {
            if (data) {
                $('#bodyDetails').html('');
                $(data).each(function(i, e) {
                    renderTemplateDetail(e.name, e.series, e.quantity, e.price, e.quantity * e.price);
                });

            } else {
                alert('Compra no encontrada');
            }
        });
}

// Funciones relacionadas al template HTML5
function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
};

function renderTemplateDetail(name, series, quantity, price, sub) {

    var clone = activateTemplate('#template-detail');

    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;
    clone.querySelector("[data-quantity]").innerHTML = quantity;
    clone.querySelector("[data-price]").innerHTML = price;
    clone.querySelector("[data-sub]").innerHTML = sub;

    $('#bodyDetails').append(clone);
}
