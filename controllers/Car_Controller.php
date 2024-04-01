<?php
require_once 'models/product.php';
class car_Controller {

    public function index() {
      if(isset($_SESSION['car'])){
        $carrito=$_SESSION['car'];
      }
        require_once 'views/car/cart.php';
       
    }

    public function add() {
        if(isset($_GET['id'])){
          
            $product_id=$_GET['id'];
        }else{
            header('Location:'.base_url);
        }
        if(isset($_SESSION['car']))
        {
              
            $count=0;
            foreach ($_SESSION['car'] as $indice =>$elemento){
                if($elemento['id_producto']==$product_id){
                $stock=$_SESSION['car'][$indice]['producto']->stock;
                    if($_SESSION['car'][$indice]['cantidad']<$stock){
                 
                    $_SESSION['car'][$indice]['cantidad']++;
                    
                    }else{
                        $errores = array();
                        $errores['stockup'] = 'Este prodcuto cuenta con '.$stock.' unidades disponibles';
                         $noadd = $_SESSION['error'] = $errores;          
                         header('Location:'.base_url);
                    }
                    $count++;
                }
            }
           
        }
        if(!isset($count)||$count==0){
            //conseguir el producto
            $pro=new product();
            $pro->setId($product_id);
           $producto= $pro->getOne();
            if(is_object($producto)){
               
            $_SESSION['car'][]=array(
                "id_producto"=>$producto->id,
                "precio"=>$producto->precio,
                "oferta"=>$producto->oferta,
                "cantidad"=>1,
                "producto"=>$producto
                
                
            );
                    
            }
           
        }
      if(isset($_GET['añadir'])&&!isset($noadd)){
         
            $add=$_SESSION['añadido']='add';
            header('Location:'.base_url);
        }elseif (isset($_GET['añadirver'])&&!isset($noadd)) {
            
      
            $add=$_SESSION['añadido']='add';
        header("Location:".base_url.'product/ver&id='.$product_id);
        }elseif(!isset($noadd)){
        header('Location:'.base_url.'car/index');
        }
        
          
    }

    public function down() {
           if(isset($_GET['index'])){
              $index=$_GET['index'];
              
          $_SESSION['car'][$index]['cantidad']--;
           
             if($_SESSION['car'][$index]['cantidad']==0){
                  unset($_SESSION['car'][$index]);
                
             }
          
               header("Location:".base_url."car/index");
                
          }
       
    }
       public function up() {
           if(isset($_GET['index'])){
              $index=$_GET['index'];
              $stock=$_SESSION['car'][$index]['producto']->stock;
            if($_SESSION['car'][$index]['cantidad']<$stock){
                 $_SESSION['car'][$index]['cantidad']++;
               header("Location:".base_url."car/index");
            }else{
            $errores = array();
            $errores['stockup'] = 'Este prodcuto cuenta con '.$stock.' unidades disponibles';
            $form = $_SESSION['error'] = $errores;
            header("Location:".base_url."car/index");
              
            }
             
          }
       
    }

      public function remove() {
          if(isset($_GET['index'])){
              $index=$_GET['index'];
              
              
              unset($_SESSION['car'][$index]);
              
             
               header("Location:".base_url."car/index");
          }
        
       
    }
   
    public function delete_all() {
       unset( $_SESSION['car']);
       header("Location:".base_url."car/index");
        
    }

}

?>