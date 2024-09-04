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

      function get_item($id){
    $items = get_items();

    //Si no hay items
    if(empty($items)){
        return false;
    }

    //Si hay items iteramos
    foreach($items as $item){
        //Validar si existe con el mismo id pasado
        if($item['id'] === $id){
            return $item;
        }
    }

    //No hubo match o resultados
    return false;
   }

   function delete_items(){
    $_SESSION['new_quote']['items'] = [];

    recalculate_quote();

    return true;
   }

   function delete_item($id){
    $items = get_items();

    //Si no hay items
    if(empty($items)){
        return false;
    }

    //Si hay items iteramos
    foreach($items as $i => $item){
        //Validar si existe con el mismo id pasado
        if($item['id'] === $id){
            unset($_SESSION['new_quote']['items']['$i']);
            return $item;
        }
    }

    //No hubo match o resultados
    return false;
   }
   
   function add_item($item){
    $items = get_items();

    //Si existe el id ya en nuestros items
    //podemos actualizar la información en lugar de agregarlo
    if(get_item($item['id'])!== false) {
        foreach ($items as $i => $e_item){
            if($item['id'] === $e_item['id']){
                $_SESSION['new_quote']['items'][$i] = $item;
                return true;
            }
        }
    }

    //No existe en la lista, se agrega simplemente
    $_SESSION['new_quote']['items'][] = $item;
    return true;
   }

/* 
    200 OK 
    201 Created 
    300 Multiple Choices 
    301 Moved Permanently 
    302 Found 
    304 Not Modified 
    307 Temporary Redirect 
    400 Bad Request 
    401 Unauthorized 
    403 Forbidden 
    404 Not Found 
    410 Gone 
    500 Internal Server Error 
    501 Not Implemented 
    503 Service Unavailable 
    550 Permission denied 
 */

   function json_build($status = 200, $data = null, $msg = ''){
    if(empty($msg) || $msg == ''){
        switch ($status){
            case 200:
                $msg = 'OK';
                break;
            case 201:
                $msg = 'Created';
                break;
            case 400:
                $msg = 'Invalid Request';
                break;
            case 403:
                $msg = 'Acces Denied';
                break;
            case 404:
                $msg = 'Not Found';
                break;
            case 500:
                $msg = 'Internal Server Error';
                break;
            case 550:
                $msg = 'Permission denied';
                break;
            default:
                break;
        }
    }
    $json =
    [
        'status' => $status,
        'data'   => $data,
        'msg'    => $msg
    ];

    return json_encode($json);
   }

   function json_output($json){
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json;charset=utf-8');

    if(is_array($json)){
        $json = json_encode($json);
    }
    
    echo $json;

    exit;
   }

   function get_module($view, $data = []){
    $view = $view.'.php';
    if(!is_file($view)){
        return false;
    }

    $d = $data = json_decode(json_encode(($data))); //conversión a objeto

    ob_start();
    require_once $view;
    $output = ob_get_clean();

    return $output;
   }

   function hook_get_quote_res(){
    //Vamos a cargar la cotización
    $quote = get_quote();
    $html  = get_module(MODULES.'quote_table', $quote);

    json_output(json_build(200, ['quote' => $quote, 'html' => $html]));
   }

   //Agregar concepto
   function hook_add_to_quote(){
    //Validar
    if(!isset($_POST['concepto'], $_POST['tipo'], $_POST['precio_unitario'], $_POST['cantidad'])){
        json_output(json_build(403, null, 'Parámetros incompletos'));
    }

    $concept       = trim($_POST['concepto']);
    $type          = trim($_POST['tipo']);
    $price         = (float) str_replace([',','$'], '', $_POST['precio_unitario']);
    $quantity      = (int) trim($_POST['cantidad']);
    $subtotal      = (float) $price * $quantity;
    $taxes         = (float) $subtotal * (TAXES_RATE / 100);

    $item          =
    [
        'id'       => rand(1111, 9999),
        'concept'  => $concept,
        'type'     => $type,
        'quantity' => $quantity,
        'price'    => $price,
        'taxes'    => $taxes,
        'total'    => $subtotal
    ];

    if(!add_item($item)){
        json_output(json_build(400, null, 'Hubo un problema al guarda el concepto en la cotización'));
    }
    json_output(json_build(201, get_item($item['id']), 'Concepto agregado con éxito'));
   }

   //Reiniciar Cotización
   function hook_restart_quote(){
    $items = get_items();

    if(empty($items)){
        json_output(json_build(400, null, 'No es necesario reiniciar la cotización, ya que no hay items cargados.'));
    }

    if(restart_quote()){
        json_output(json_build(400, null, 'Hubo un problema al reiniciar la cotización.'));
    }
    json_output(json_build(200, get_quote(), 'La cotización se ha reiniciado con éxito.'));
   }
   
?>