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
    $('[data-clase]').removeClass('active');

    var id = $(this).data('id');
    $modalEditar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEditar.find('[name="name"]').val(name);

    var address = $(this).data('address');
    $modalEditar.find('[name="address"]').val(address);

    var phone = $(this).data('phone');
    $modalEditar.find('[name="phone"]').val(phone);

    var document = $(this).data('document');
    $modalEditar.find('[name="document"]').val(document);

    var persona = $(this).data('persona');
    $('#'+persona).prop('checked', true);
    $('#'+persona).parent().addClass('active');
    
    var typeid = $(this).data('typeid');
    $('#'+typeid).prop('selected', true);

    $modalEditar.modal('show');
}

function mostrarEliminar() {
    var id = $(this).data('delete');
    $modalEliminar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalEliminar.find('[name="nombreEliminar"]').val(name);
    $modalEliminar.modal('show');
}