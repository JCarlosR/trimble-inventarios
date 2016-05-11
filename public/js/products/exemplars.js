$(document).on('ready', principal);

function principal() {
    $modalEditar = $('#modalEditar');
    $modalEliminar = $('#modalEliminar');

    $('[data-id]').on('click', mostrarEditar);
    $('[data-delete]').on('click', mostrarEliminar);
}

var $modalEditar;
var $modalEliminar;

function mostrarEditar() {
    var id = $(this).data('id');
    $modalEditar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEditar.find('[name="name"]').val(name);

    var description = $(this).data('description');
    $modalEditar.find('[name="description"]').val(description);

    var brand = $(this).data('brand');

    $.getJSON("modelo/dropdown",function(data)
    {
        $.each(data,function(key,value)
        {
            if( value.id == brand )
                $("#brands").append(" <option value='" + value.id+"' selected='selected'>" + value.name  + "</option> ");
            else
                $("#brands").append(" <option value='" + value.id+"' >" + value.name  + "</option> ");
        });
    });

    $modalEditar.modal('show');
}

function mostrarEliminar() {
    var id = $(this).data('delete');
    $modalEliminar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEliminar.find('[name="nombreEliminar"]').val(name);
    $modalEliminar.modal('show');
}