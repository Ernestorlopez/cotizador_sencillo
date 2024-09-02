$('document').ready(() => {

    //Cargar contenido de la cotización
    function get_quote(){
        let wrapper = $('.wrapper_quote'),
        action = 'get_quote_res';

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
                wrapper.html(res.data.html)
            } else {
                wrapper.html(res.msg)
            }
        }).fail(err => {
            wrapper.html('Ocurrió un error, por favor recarga la página');
        }).always(() => {
            wrapper.waitMe('hide');
        });
    }
    get_quote();
});