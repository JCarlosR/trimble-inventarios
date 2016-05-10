$(document).on('ready', principal);

function principal()
{
    $modalEditar = $('#modalEditar');
    $modalEliminar = $('#modalEliminar');

    $('[data-id]').on('click', mostrarEditar);
    $('[data-delete]').on('click', mostrarEliminar);

//Index
    $('#categories').change( function(){
        var marcax = $('#brands').val();
        $.ajax({
                url: "../producto/registrar/"+marcax+"/"+$(this).val(),
                type: 'GET',
                dataType: "html",
                async: true
            })
            .done(function( data ) {
                $('body').html(data);
            });
    } );

    $('#brands').change( function(){
        var categoriax = $('#categories').val();
        $.ajax({
                url: "../producto/registrar/"+$(this).val()+"/"+categoriax,
                type: 'GET',
                dataType: "html",
                async: true
            })
            .done(function( data ) {
                $('body').html(data);
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