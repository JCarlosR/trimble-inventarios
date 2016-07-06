$(document).on('ready', function () {
    $('#exportExcel').on('click', exportarExcel);

});

function exportarExcel() {
    var datestart = $('#start').val();
    var dateend = $('#end').val();
    if (datestart > dateend) {
        alert('Orden de fechas incorrecta.');
        return;
    }

    console.log('No debo aparecer');
    $.ajax({
        url: '../salidas/range/' + datestart + '/' + dateend
    })
        .done(function( data ) {
            if (data) {
                alert('El archivo se descargó con éxito');
            } else {
                alert('El archivo no se descargó');
            }
        });
}