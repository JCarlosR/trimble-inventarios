$(document).on('ready', principal);

function principal()
{
    $modalEditar = $('#modalEditar');
    $modalEliminar = $('#modalEliminar');

    $('[data-id]').on('click', mostrarEditar);
    $('[data-delete]').on('click', mostrarEliminar);
}

//Create
var $modalEditar;
var $modalEliminar;

function mostrarEditar() {
    var id = $(this).data('id');
    $modalEditar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEditar.find('[name="name"]').val(name);

    var address = $(this).data('address');
    $modalEditar.find('[name="address"]').val(address);

    var phone = $(this).data('phone');
    $modalEditar.find('[name="phone"]').val(phone);

    var surname = $(this).data('surname');
    $modalEditar.find('[name="surname"]').val(surname);

    var gender = $(this).data('gender');
    document.getElementById(gender).checked  = true;

    var typeid = $(this).data('typeid');
    document.getElementById(typeid).selected = true;

    $modalEditar.modal('show');
}

function mostrarEliminar() {
    var id = $(this).data('delete');
    $modalEliminar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEliminar.find('[name="nombreEliminar"]').val(name);
    $modalEliminar.modal('show');
}