$(document).on('ready',principal);

function principal()
{
    $('#excel_outputs').on('click',excel_outputs);
}

function excel_outputs()
{
    $.ajax({
            url: 'datos-excel',
            dataType: "JSON",
            method: 'GET'
        })
        .done(function( response ) {
            if(response.error)
                alert('No existen datos para exportar');
            else
            {
                location.href = '../public/exportar-datos-excel-facturas';
            }
        });
}
