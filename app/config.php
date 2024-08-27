<?php
    //Para saber si estamos en servidor local
    define('IS_LOCAL' , in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1', '::1']));

    //URL absoluta
    $web_url = IS_LOCAL ? 'localhost/cotizador_sencillo' : 'LA URL EN PRODUCCIÓN';
    define('URL'      , $web_url);

    //Constantes para rutas de directorios
    define('DS'       , DIRECTORY_SEPARATOR);
    define('ROOT'     , getcwd().DS);
    define('APP'      , ROOT.'app'.DS);
    define('ASSESTS'  , ROOT.'assets'.DS);
    define('TEMPLATES', ROOT.'templates'.DS);
    define('INCLUDES' , TEMPLATES.'includes'.DS);
    define('MODULES'  , TEMPLATES.'modules'.DS);
    define('VIEWS'    , TEMPLATES.'views'.DS);
    define('UPLOADS'  ,ROOT.'uploads'.DS);

    //Constantes para URLs
    define('CSS'      , URL.'assets/css/');
    define('IMG'      , URL.'assets/img/');
    define('JS'       , URL.'assets/js/');
    
?>