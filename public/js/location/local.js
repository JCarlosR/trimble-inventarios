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

    var comment = $(this).data('comment');
    $modalEditar.find('[name="comment"]').val(comment);

    var type = $(this).data('type');
    if( type == 1 )
        $("#almacen").prop("checked", true);
    else
        $("#oficina").prop("checked", true);

    $modalEditar.modal('show');
}

function mostrarEliminar() {
    access_denied();

    var id = $(this).data('delete');
    $modalEliminar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEliminar.find('[name="nombreEliminar"]').val(name);
    $modalEliminar.modal('show');
}