$(document).ready(function(){

//Funcion para procesar la peticion del formulario
$('#do_contact_form').on('submit', do_contact_form);
function do_contact_form(event) {
    event.preventDefault();
    
    var data = new FormData($('#do_contact_form').get(0)),
    wrapper_msg = $('.wraper_msg'),
    wrapper_contact_form = $('.wrapper_contact_form'),
    submit_button = $('.submit_button');
    submit_button_default =submit_button.html();


    //peticion ajax
    $.ajax({
        url:'./ajax.php',
        type: 'post',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        beforeSend: function () {
            submit_button.html('Enviando...')
        }
    }).done(function (res) {
        if (res.status === 200) {
            wrapper_msg.addClass('alert alert-danger');    
            wrapper_msg.html(res.msg);
            wrapper_contact_form.html(res.data);
        }else{
            wrapper_msg.addClass('alert alert-danger');
            wrapper_msg.html(res.msg);
            submit_button.html(submit_button_default);
        }
    }).always(function () {
      
    }).fail(function (err) {
        wrapper_msg.addClass('alert alert-danger');
        wrapper_msg.html('Hubo un error en la petición');
        submit_button.html(submit_button_default);
    })
    }
    
});