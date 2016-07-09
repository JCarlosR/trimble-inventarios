$(document).on('ready', principal);

function principal()
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    if(mm<10){mm='0'+mm}
    today = yyyy+'-'+mm+'-'+dd;

    //Sale
    $('#inicioV').val(today);
    $('#finV').val(today);
    $('#excelV').on('click',excelV);
    $('#pdfV').on('click',pdfV);

    //Rented
    $('#inicioA').val(today);
    $('#finA').val(today);
    $('#excelA').on('click',excelA);
    $('#pdfA').on('click',pdfA);

    //Lowed
    $('#inicioB').val(today);
    $('#finB').val(today);
    $('#excelB').on('click',excelB);
    $('#pdfB').on('click',pdfB);

    var url_customers ='../../../../public/customer/names';
    $.ajax({
        url: url_customers,
        method: 'GET'
    }).done(function (datos) {
        customers = datos.customers;
        loadAutoCompleteCustomersV(customers);
    });

    var url_customers ='../../../../public/customer/names';
    $.ajax({
        url: url_customers,
        method: 'GET'
    }).done(function (datos) {
        customers = datos.customers;
        loadAutoCompleteCustomersA(customers);
    });

}

function loadAutoCompleteCustomersV(data) {
    $('#clienteV').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'customers',
            source: substringMatcher(data)
        }
    );
}

function loadAutoCompleteCustomersA(data) {
    $('#clienteA').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'customers',
            source: substringMatcher(data)
        }
    );
}

function excelV()
{
    event.preventDefault();
    var cliente = $('#clienteV').val();
    var inicio   = $('#inicioV').val();
    var fin      = $('#finV').val()
    if(!cliente)
    {
        alert('Ingrese nombre de cliente');
        return;
    }

    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/sales/verify/'+inicio+'/'+fin+'/'+cliente,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else
            location.href = '../../../../public/salida/venta/data/'+inicio+'/'+fin+'/'+cliente;
    });
}

function excelA()
{
    event.preventDefault();
    var cliente = $('#clienteA').val();
    var inicio   = $('#inicioA').val();
    var fin      = $('#finA').val()
    if(!cliente)
    {
        alert('Ingrese nombre de cliente');
        return;
    }

    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/rental/verify/'+inicio+'/'+fin+'/'+cliente,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else
            location.href = '../../../../public/salida/alquiler/data/'+inicio+'/'+fin+'/'+cliente;
    });
}

function excelB()
{
    event.preventDefault();
    var inicio   = $('#inicioB').val();
    var fin      = $('#finB').val();
    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/low/verify/'+inicio+'/'+fin,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else
            location.href = '../../../../public/salida/baja/data/'+inicio+'/'+fin;
    });
}

function pdfV()
{
    event.preventDefault();
    var cliente = $('#clienteV').val();
    var inicio   = $('#inicioV').val();
    var fin      = $('#finV').val()
    if(!cliente)
    {
        alert('Ingrese nombre de cliente');
        return;
    }

    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/sales/verify/'+inicio+'/'+fin+'/'+cliente,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else {
            var url = '../../../../public/salida/venta/data/pdf/' + inicio + '/' + fin + '/' + cliente;
            window.open(url, '_blank');
        }
    });
}

function pdfA()
{
    event.preventDefault();
    var cliente = $('#clienteA').val();
    var inicio   = $('#inicioA').val();
    var fin      = $('#finA').val()
    if(!cliente)
    {
        alert('Ingrese nombre de cliente');
        return;
    }

    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/rental/verify/'+inicio+'/'+fin+'/'+cliente,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else {
            var url = '../../../../public/salida/alquiler/data/pdf/' + inicio + '/' + fin + '/' + cliente;
            window.open(url, '_blank');
        }
    });
}

function pdfB()
{
    event.preventDefault();
    var inicio   = $('#inicioB').val();
    var fin      = $('#finB').val();
    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    $.ajax({
        url: '../../../../public/low/verify/'+inicio+'/'+fin,
        method: 'GET'
    }).done(function (data) {

        if( data.error )
            alert(data.message);
        else {
            var url = '../../../../public/salida/baja/data/pdf/' + inicio + '/' + fin;
            window.open(url, '_blank');
        }
    });
}