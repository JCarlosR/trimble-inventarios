$(document).on('ready',principal);

var $modalQuitar;
var invoices = [];

function principal()
{
    populate_table_invoices();
    $modalQuitar = $('#modalQuitar');
    $('[data-invoice]').on('click',modalQuitar);
    $('#accept').on('click',quitarElemento);
    $('#ir').on('click',ir);
    $('#igv').on('click',igv);
}

function populate_table_invoices(){
    var table_invoices = document.getElementById('invoices').children;

    for (var i=0; i<table_invoices.length; i++)
        invoices.push(table_invoices[i].getAttribute('data-id'));
}

function modalQuitar(){
    var invoice = $(this).data('invoice');
    $modalQuitar.find('[name=nombreQuitar]').val(invoice);
    $modalQuitar.modal('show');
}

function quitarElemento(){
    event.preventDefault();
    var invoice = $modalQuitar.find('[name=nombreQuitar]').val();
    $modalQuitar.modal('hide');

    var table_invoices = document.getElementById('invoices').children;

    for (var i=0; i<table_invoices.length; i++) {
        if (table_invoices[i].getAttribute('data-id') == invoice) {
            table_invoices[i].remove();
            delete_element(invoices, invoice);
        }
    }
}

function delete_element(  array, element ){
    var pos = 0;
    for( var i=0; i<array.length;i++ )
        if( array[i] == element )
            pos = i;

    array.splice(pos,1);
}

function search_element( array, element ){
    for( var i=0; i<array.length;i++ )
        if( array[i] == element )
            return true;
    return false;
}

function ir(){
    event.preventDefault();

    var _token = $('#_token').val();
    var formData = new FormData();
    formData.append( 'ir',JSON.stringify(invoices) );

    $.ajax({
            url: 'listar-facturas-declarar-ir',
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': _token }
        })
        .done(function( response ) {
            if(response.error)
                alert(response.message);
            else{
                alert(response.message);
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
}
function igv(){
    event.preventDefault();

    var _token = $('#_token').val();
    var formData = new FormData();
    formData.append( 'ir',JSON.stringify(invoices) );

    $.ajax({
            url: 'listar-facturas-declarar-igv',
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': _token }
        })
        .done(function( response ) {
            if(response.error)
                alert(response.message);
            else{
                alert(response.message);
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
}
