$(document).on('ready', principal);

function principal()
{
    $('#form').on('submit', registerConcept);
}

function registerConcept() {
    event.preventDefault();
    var _token = $(this).find('[name=_token]');
    var data = new FormData(this);
    console.log(data);
    $.ajax({
        url: 'cajachica/save',
        data: new FormData(this),
        dataType: "JSON",
        processData: false,
        contentType: false,
        method: 'POST'
    })
        .done(function( response ) {
            if(response.error)
                alert(response.message);
            else{
                alert(response.message);
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        });
}