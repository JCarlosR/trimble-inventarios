$(document).on('ready', principal);

var $modalHabilitar;
function principal() {
    //FooTable
    $('.mytable').footable();

    $modalHabilitar = $('#modalHabilitar');
    $('[data-habilitar]').on('click', mostrarHabilitar);
}

function mostrarHabilitar() {
    var id = $(this).data('habilitar');
    $modalHabilitar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalHabilitar.find('[name="nombreHabilitar"]').val(name);
    $modalHabilitar.modal('show');
}