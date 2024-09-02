$('document').ready(() => {

    function notify(content, type = 'success'){
        let wrapper  = $('.wrapper_notifications');
        id          = Math.floor(Math.random()* 500 + 1);
        notificacion = '<div class="alert alert-'+type+'" id="noty_'+id+'">'+content+'</div>';
        time         = 5000;

        //insertar en el contenedor la notificación
        wrapper.append(notificacion);

        //Timer para ocultar la notificación
        setTimeout(function(){
            //wrapper.html('');
            $('#noty_'+id).remove();
        }, time);

        return true;

    } 

    //Cargar contenido de la cotización
    function get_quote(){
        let wrapper = $('.wrapper_quote'),
        action      = 'get_quote_res';
        nombre      = $('#nombre'),
        empresa     = $('#empresa'),
        email       = $('#email');


        $.ajax({
            url: 'ajax.php',
            type: 'get',
            cache: false,
            dataType: 'json',
            data: {action},
            beforeSend: function(){
                wrapper.waitMe({});
            }
        }).done(res => {
            if(res.status === 200){
                nombre.val(res.data.quote.nombre);
                empresa.val(res.data.quote.empresa);
                email.val(res.data.quote.email);
                wrapper.html(res.data.html);
            } else {
                wrapper.html(res.msg);
            }
        }).fail(err => {
            wrapper.html('Ocurrió un error, por favor recarga la página');
        }).always(() => {
            wrapper.waitMe('hide');
        });
    }
    get_quote();

    //Función para agregar un concepto a la cotización
    $('#add_to_quote').on('submit', add_to_quote);
    function add_to_quote(e) {
        e.preventDefault();
    }
});