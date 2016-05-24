$(document).on('ready', principal);

function principal()
{
    $modalRetornar = $('#modalRetornar');

    $('[data-back]').on('click', mostrarRetornar);
}

var $modalRetornar;

function mostrarRetornar() {
    var id = $(this).data('back');
    $modalRetornar.find('[name="id"]').val(id);

    var name = $(this).data('name');
    $modalRetornar.find('[name="nombreRetornar"]').val(name);
    $modalRetornar.modal('show');
}