<?php
   //Función que llama a las vistas
   function get_view($view_name) {
    $view = VIEWS.$view_name.'View.php';
    if(!is_file($view)){
        die('La vista no existe');
    }
    //Existe la vista
    require_once $view;
   } 
?>