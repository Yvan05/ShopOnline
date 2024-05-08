<?php

class Utilities{
    
public static function deleteSession($name) {
        if(isset( $_SESSION[$name])){
        $_SESSION[$name]=null;
        unset($_SESSION[$name]);
        }
        return $name;
        
    } 
 /* 
 FUNCIONES PARA MOSTRAR LOS ERROES EN LA VISTA DELFORMULARIO
 */
public static function mostrarError($errores,$campo){
    $alert=' ';
    if(isset($errores[$campo])&&!empty($campo)){
 
       $alert="<div class='alertform alert alert-danger' role='alert'>".$errores[$campo]."</div>";  
    }
    return $alert;
}
public static function mostraralert($errores) {
        $alert = ' ';
        if (isset($errores)) {

            $alert = '<script>
                            Swal.fire({
                            icon: "info",
                            title: "'.$errores.'"
                          })
                    </script>';
        }
        return $alert;
    }
public static function isAdmin() {
    if(!isset($_SESSION['admin'])){
        header("Location:".base_url);
    } else {
        return true;
    }
}
public static function isIdentity() {
    if(!isset($_SESSION['identity'])){
        header("Location:".base_url);
    } else {
        return true;
    }
    
}
public static function showCategory() {
    require_once 'models/category.php';
    $category=new category();
    $categorys=$category->getAll();
    return $categorys;
    
}
public static function shownameCategory($id) {
    require_once 'models/category.php';
    $category=new category();
    $category->setId($id);
    $categorys=$category->getOne();
    return $categorys;
    
}
public static function updateSession(){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = new user();
        $user->setId($id);
        $identity = $user->getOne();
        if ($identity && is_object($identity)) {
            $_SESSION['identity'] = $identity;
        }else{
            return true;
        }
    }
}
public static function mostrarError2($errores,$campo){
    $alert=' ';
    if(isset($errores[$campo])){
 
       $alert="<div class='alertform alert alert-danger' role='alert'>".$errores[$campo]."</div>";  
    }
    return $alert;
}
public static function statsCar() {
    $stats=array(
        'count'=>0,
        'subtotal'=>0,
        'oferta'=>0,
        'total'=>0,
        'totalprecio'=>0
        
    );
    if(isset($_SESSION['car'])){
        
        $stats['count']=count($_SESSION['car']);
         
        foreach ($_SESSION['car'] as $producto){
            
            $stats['subtotal']+=$producto['precio']*$producto['cantidad'];
           
           if(!$producto['oferta']==null||!$producto['oferta']==0||!$producto['oferta']== ''){
            $desc=$producto['oferta']/100;
            $stats['oferta']+=$desc*$producto['precio']*$producto['cantidad'];
            
           }
          
           
           
         
        }
        $stats['total'] =  $stats['subtotal']-$stats['oferta'];
    }
    return $stats;
    
}
public static function rutaActual() {
   
     $url= $_SESSION['url']= $_SERVER["REQUEST_URI"];

      $ruta= $url;
     return $ruta;  
}
public static function alert($cadena){
    $alert=' ';
    
    $alert="<script>".$cadena."</script>";  
  
    return $alert;
}
public static function status($status){
    $value='Pendiente';
    if($status=='confirm'){
        
       $value= 'Pendiente';
    }elseif($status=='preparation'){
            $value= 'En Preparacion';
    }elseif($status=='ready'){
           $value= 'Preparado para enviar' ;
    }elseif($status=='sended'){
            $value= 'Pedido Enviado';
    }
     
  
    return $value;
}
public static function datos_order_pdf($require) {
    if (isset($_SESSION['identity'])) {
            //miorder pagina visualizar mis pedidos
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $order = new order();
                $order->setId($id);
                $pedido = $order->getOne();
                $pedido_product = new order();
                $productos = $pedido_product->getProductsByOrder($id);
                //cargando datos del pedidos en lapagina de confirmado
                if ($pedido && $productos) {
                    //obtner payment por un usuario
                    $payment = new order();
                    $paypal = $payment->getPaymentByOrder($pedido->id);
                   require_once ''.$require.'';
                } else {
                    show_error();
                }
            } else {
                $identity = $_SESSION['identity'];
                //obtener datos de un usuario
                $order = new order();
                $order->setUsuario_id($identity->id);
                $pedido = $order->getOneByUser();
                //obtener losproductos por un usuarios
                $pedido_product = new order();
                $productos = $pedido_product->getProductsByOrder($pedido->id);
                if ($pedido && $productos) {
                    //obtner payment por un usuario
                    $payment = new order();
                    $paypal = $payment->getPaymentByOrder($pedido->id);
                    //views/fpdf/INVOICE-main/invoice.php
                    require_once ''.$require.'';
                } else {
                    show_error();
                }
            }
        } else {
            header("Location:" . base_url);
        }
    
}

}
