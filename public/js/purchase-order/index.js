$(document).on('ready',principal);

var order;

function principal()
{
    search();
    $('#search').on('input',search);
    $('#orders').on('click', 'tr', showDetails);
    $('#filter').on('click', filter);

}

function search()
{
    order = $('#search').val();
    if( order.length == 0 )
        order = 'z';

    var url = '../../ingreso/listar/orden_compra/'+order;
    $.ajax({
            url: url,
            method: 'GET'
        })
        .done(function( orders ) {
            $('#details').html('');
            $('#orders').html('');
            $.each(orders,function(key,order){
                var document = (order.type_doc=='F')?'Factura':'Boleta';
                var toAppend =
                    '<tr data-order="'+order.id+'">' +
                        '<td>'+order.provider.name+'</td>' +
                        '<td>'+order.currency+'</td>' +
                        '<td>'+order.igv+'</td>' +
                        '<td>'+order.total+'</td>' +
                        '<td>'+order.shipping+'</td>' +
                        '<td>'+order.invoice+'</td>' +
                        '<td>'+document+'</td>' +
                        '<td>'+order.invoice_date+'</td>' +
                    '</tr>';
                $('#orders').append(toAppend);
            });
            $('.pagination').html('');
            paginate();
        });
}

function showDetails()
{
    var order = $(this).data('order');

    var url = '../../ingreso/listar/orden_compra/detalles/'+order;
    $.ajax({
            url: url,
            method: 'GET'
        })
        .done(function( details ) {
            $('#details').html('');
            $.each(details,function(key,detail){
                var toAppend =
                    '<tr>' +
                        '<td>'+detail.product.name+'</td>' +
                        '<td>'+detail.quantity+'</td>' +
                        '<td>'+detail.originalprice+'</td>' +
                        '<td>'+detail.igv+'</td>' +
                        '<td>'+detail.subtotal+'</td>' +
                    '</tr>';
                $('#details').append(toAppend);
            });
        });
}

function filter()
{
    var start = $('#start').val();
    var end = $('#end').val();

    var _start = new Date(start);
    var _end = new Date(end);

    if( _start.getTime() > _end.getTime()  ) {
        alert('Rango de fechas inválido');
        return;
    }

    var url = '../../ingreso/listar/orden_compra/fechas/'+start+'/'+end;
    $.ajax({
            url: url,
            method: 'GET'
        })
        .done(function( orders ) {
            $('#details').html('');
            $('#orders').html('');
            $.each(orders,function(key,order){
                var document = (order.type_doc=='F')?'Factura':'Boleta';
                var toAppend =
                    '<tr data-order="'+order.id+'">' +
                    '<td>'+order.provider.name+'</td>' +
                    '<td>'+order.currency+'</td>' +
                    '<td>'+order.igv+'</td>' +
                    '<td>'+order.total+'</td>' +
                    '<td>'+order.shipping+'</td>' +
                    '<td>'+order.invoice+'</td>' +
                    '<td>'+document+'</td>' +
                    '<td>'+order.invoice_date+'</td>' +
                    '</tr>';
                $('#orders').append(toAppend);
            });
            $('.pagination').html('');
            paginate();
        });
}
