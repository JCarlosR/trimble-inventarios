$(document).on('ready', principal);

function principal()
{
    $modalEditar = $('#modalEditar');
    $modalEliminar = $('#modalEliminar');

    $('[data-id]').on('click', mostrarEditar);
    $('[data-delete]').on('click', mostrarEliminar);

//Index
    $('#categories').change( function(){
        var categoria = $(this).val();
        $("#subcategories").empty();
        $.getJSON("../producto/subcategoria/"+categoria,function(data)
        {
            $.each(data,function(key,value)
            {
                $("#subcategories").append(" <option value='" + value.id+"'>" + value.name  + "</option> ");
            });
        });
    } );

    $('#brands').change( function(){
        var marca = $(this).val();
        $("#exemplars").empty();
        $.getJSON("../producto/modelo/"+marca,function(data)
        {
            $.each(data,function(key,value)
            {
                $("#exemplars").append(" <option value='" + value.id+"'>" + value.name  + "</option> ");
            });
        });
    } );
//End Index

}

//Create
var $modalEditar;
var $modalEliminar;

function mostrarEditar() {
    var id = $(this).data('id');
    $modalEditar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEditar.find('[name="name"]').val(name);

    var description = $(this).data('description');
    $modalEditar.find('[name="description"]').val(description);

    $modalEditar.modal('show');
}

function mostrarEliminar() {
    var id = $(this).data('delete');
    $modalEliminar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEliminar.find('[name="nombreEliminar"]').val(name);
    $modalEliminar.modal('show');
}