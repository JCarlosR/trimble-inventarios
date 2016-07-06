$(document).on('ready', principal);

function principal()
{

    $('#reporte').on('click',reporte);
    $('#xcel').on('click',excel);
    $('#pdf').on('click',pdf);

    var url_customers ='../../../public/customer/names';
    $.ajax({
        url: url_customers,
        method: 'GET'
    }).done(function (datos) {

        customers = datos.customers;
        loadAutoCompleteCustomers(customers);
    });

}

function loadAutoCompleteCustomers(data) {
    $('#cliente').typeahead(
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

function reporte()
{
    event.preventDefault();
    var customer = $('#cliente').val();
    var inicio   = $('#inicio').val();
    var fin      = $('#fin').val()
    if(!customer)
    {
        alert('Ingrese nombre de cliente');
        return;
    }

    if(!inicio)
    {
        alert('ingrese fecha de inicio');
        return;
    }

    if(!fin)
    {
        alert('ingrese fecha de Fin');
        return;
    }

    if(  fin<inicio )
    {
        alert('La fecha de inicio debe ser menor que la fecha de fin');
        return;
    }

    var _token = $('#form').find('[name=_token]');
    var data = $('#form').serializeArray();

    $.ajax({
        url: '../../../public/salida/venta/data',
        data:data,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': _token }
    }).done(function (data) {
        $.each(data.x,function(key,value)
        {
            alert(value);
        });
    });


}