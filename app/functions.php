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
   
   //Cotización
   function get_quote(){
    if(!isset($_SESSION['new_quote'])){
        return $_SESSION['new_quote'] =
        [
            'number'   => rand(111111, 999999),
            'name'     => '',
            'company'  => '',
            'email'    => '',
            'items'    => [],
            'subtotal' => 0,
            'taxes'    => 0,
            'shipping' => 0,
            'total'    => 0
        ];
    }

    //recalcular todos los totales
    recalculate_quote();
    return $_SESSION['new_quote'];
   }

   function recalculate_quote(){
    $items    = [];
    $subtotal = 0;
    $taxes    = 0;
    $shipping = 0;
    $total    = 0;

    if(!isset($_SESSION['new_quote'])){
        return false;
    }

    //Validar items
    $items = $_SESSION['new_quote']['items'];

    //Si la lista de itesm está vacia no es necesario recalcular nada
    if(!empty($items)){
        foreach($items as $item){
            $subtotal += $item['total'];
            $taxes    += $item['taxes'];
        }
    }

    $shipping = $_SESSION['new_quote']['shipping'];
    $total    = $subtotal + $taxes + $shipping;

    $_SESSION['new_quote']['subtotal']=$subtotal;
    $_SESSION['new_quote']['taxes']   =$taxes;
    $_SESSION['new_quote']['shipping']=$shipping;
    $_SESSION['new_quote']['total']   =$total;
    return true;
   }
   
   function restart_quote(){
    $_SESSION['new_quote'] =
    [  
        'number'   => rand(111111, 999999),
        'name'     => '',
        'company'  => '',
        'email'    => '',
        'items'    => [],
        'subtotal' => 0,
        'taxes'    => 0,
        'shipping' => 0,
        'total'    => 0
    ];
   }

   function get_items(){
    $items = [];

    //Si no existe la cotización y obviamente está vacío el array
    if(!isset($_SESSION['new_quote']['items'])){
        return $items;
    }

    //La cotización existe, se asigna el valor
    $items = $_SESSION['new_quote']['items'];
    return $items;

   }

?>