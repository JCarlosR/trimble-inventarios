$(document).on('ready', function () {
    $('#exportExcel').on('click', exportarExcel);
    $('#exportExcel2').on('click', exportarExcel2);
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    if(mm<10){mm='0'+mm}
    today = yyyy+'-'+mm+'-'+dd;

    $('#start').attr('value',today);
    $('#end').attr('value',today);
    $('#start2').attr('value',today);
    $('#end2').attr('value',today);
});

function exportarExcel() {
    var datestart = $('#start').val();
    var dateend = $('#end').val();
    if (datestart > dateend) {
        alert('Orden de fechas incorrecta.');
        return;
    }

    var url = $('#exportExcel').data('url');
    location.href = url+'/'+datestart+'/'+dateend;
}

function exportarExcel2() {
    var datestart = $('#start2').val();
    var dateend = $('#end2').val();
    var cliente = $('#clientes').val();
    if (datestart > dateend && cliente == "") {
        alert('Error en los datos ingresados.');
        return;
    }

    var url = $('#exportExcel').data('url');
    location.href = url+'/'+datestart+'/'+dateend+'/'+cliente;
}