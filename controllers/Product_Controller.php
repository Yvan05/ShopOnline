<?php

require_once 'models/product.php';

//require_once 'models/category.php';

class product_Controller {

    public function index() {
        //sacando productos aleatorios de la base de datos para
        //mostrarlos en nuestra pagina principal index de productos
        //variaddos
        $product= new product();
       $productos= $product->getRadom(6);
       
       ///var_dump($productos->fetch_object());//registro aleatorio
      // var_dump($productos->num_rows);//numero de registros en la base tabla de productos
        //renderizar vista
        require_once 'views/product/destacados.php';
    }

    public function gestion() {
        //renderizar vista
        Utilities::isAdmin();
        $product = new product();
        $productos = $product->getALL();
        require_once 'views/product/gestion.php';
    }

    public function crear() {
        Utilities::isAdmin();
        //renderizar vista
        //$category = new category();
        // $categorys = $category->getAll();
        require_once 'views/product/crear.php';
    }

    public function delete() {
        Utilities::isAdmin();

        if (isset($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $producto = new product();
            $producto->setId($id);
            $delete = $producto->delete();
            if ($delete) {
                $alert = $_SESSION['delete'] = "success";
            } else {
                //fallido al registrar
                $alert = $_SESSION['delete'] = "failed";
            }
        } else {
            $alert = $_SESSION['delete'] = "failed";
        }
        header('Location:' . base_url . 'product/gestion');
        ob_end_flush();
    }
    public function ver() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $producto = new product();
            $producto->setId($id);
            $proct = $producto->getOne();
           

        } 
         require_once 'views/product/ver.php'; 
    }

    public function edit() {
        Utilities::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $producto = new product();
            $producto->setId($id);
            $proct = $producto->getOne();
            if($proct){
              require_once 'views/product/crear.php';  
            }else{
                show_error();
            }
                

           // require_once 'views/product/crear.php';
        } else {
            header('Location:' . base_url . 'product/gestion');
            ob_end_flush();
        }
    }

    public function save() {
        Utilities::isAdmin();
        //verificar los datos recibidos por POST
        if (isset($_POST)) {

            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $cat = isset($_POST['cate']) ? $_POST['cate'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $desc = isset($_POST['desc']) ? $_POST['desc'] : false;
            $ofert = isset($_POST['ofer']) ? $_POST['ofer'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $date = isset($_POST['date']) ? $_POST['date'] : false;
            $file = $_FILES['img'];
            //$img = isset($_POST['img']) ? $_POST['img'] : false;
            //$file = isset($_FILES['img']) ? $_FILES['img'] : false;
            ///array de errores
            $errores = array();

            //validar los datos antes de guardarlos en la base de datos
//VALIDANDO CAMPO NOMBRE
            if (!empty($name) && !is_numeric($name)) {
                $name_validate = true;
            } else {
                $name_validate = false;
                $errores['name'] = 'verifique el nombre';
            }
            //VALIDANDO CAMPO DESCRIPCION
            if (!empty($desc) && !is_numeric($desc)) {
                $desc_validate = true;
            } else {
                $desc_validate = false;
                $errores['desc'] = 'verifique el descripcion';
            }
            //VALIDANDO CAMPO OFERTA
            if (preg_match("/[0-9]/", $ofert)&& strlen($ofert)<=2&&!empty($ofert)) {
                $ofert_validate = true;
            } else {
                $ofert_validate = false;
                $errores['ofer'] = 'verifique el oferta';
            }
//VALIDANDO CAMPO CATEGORIA
            if (!empty($cat)) {
                $cat_validate = true;
            } else {
                $cat_validate = false;
                $errores['cate'] = 'verifique el categoria';
            }
//VALIDANDO CAMPO FECHA
            $fecha_act = date('Y-m-d');
            if (!empty($date) && $date <= $fecha_act) {
                $date_validate = true;
            } else {
                $date_validate = false;
                $errores['date'] = 'verifique el fecha';
            }
//VALIDANDO CAMPO STOCK
            if (!empty($stock) && is_numeric($stock) && $stock > 0) {
                $stock_validate = true;
            } else {
                $stock_validate = false;
                $errores['stock'] = 'verifique el stock   ';
            }
//VALIDANDO CAMPO PRECIO
            if (!empty($precio) && !preg_match("/[a-z]/", $precio)) {
                $precio_validate = true;
            } else {
                $precio_validate = false;
                $errores['precio'] = 'verifique el precio';
            }
            //VALIDANDO CAMPO IMG
            if (!empty($file['name']) != null) {
                $file_validate = true;
            } else {
                $file_validate = false;
                $errores['img'] = 'Debes ingresar una imagen';
            }

            if (count($errores) == 0) {

                $product = new product();
                $product->setNombre($name);
                $product->setIdcategory($cat);
                $product->setPrecio($precio);
                $product->setDescripcion($desc);
                $product->setOferta($ofert);
                $product->setStock($stock);
                $product->setFecha($date);

                //imagen guardado en la base de datos y creando una carpeta en el proyecto para
                //alojarlas imagenes
                if (isset($_FILES['img'])) {
                    $filename = $file['name'];
                    $minetype = $file['type'];
                    if ($minetype == "image/jpg" || $minetype == "image/jpeg" || $minetype == "image/png" || $minetype == "image/gif") {
                        if (!is_dir('productos/img')) {
                            mkdir('productos/img', 0777, true);
                        }
                        $product->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'productos/img/' . $filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $product->setId($id);
                    $save = $product->edit();
                   
                } else {
                    $save = $product->save();
                }
                //comprobando que se realizo metodo de inserciona ala base de datos
                if ($save) {
                    //se crean variables de session para cuando se hace la insercion ala base llamando el metodo
                    //exito al registrar
                    $alert = $_SESSION['register'] = "success";
                } else {
                    //fallido al registrar
                    $alert = $_SESSION['register'] = "failed";
                }
            } else {
                //regresamos una alerta cuando hay errores en el formularui de registro
                $alert = $_SESSION['register'] = "vacio";
                $_SESSION['buff'] = $_POST;
                $form = $_SESSION['error'] = $errores;
            }
        } else {
            //si no se recibe nada por post
            $alert = $_SESSION['register'] = "failed";
        }
        //redirigimor ala pagina misma
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            header('Location:' . base_url . 'product/edit&id=' . $id);
            ob_end_flush();
        } else {
            header('Location:' . base_url . 'product/crear');

            ob_end_flush();
        }
    }
     public function buscador() {
        if (isset($_POST['busca'])&&!empty($_POST['busca'])) {
            $busca = isset($_POST['busca']) ? $_POST['busca'] : false;
            
            $errores = array();
            
            if (!empty($busca)) {
                $busca_validate = true;
            } else {
                $busca_validate = false;
                $errores['busca'] = 'Ingresa para buscar';
            }
            if (count($errores) == 0) {
             
   
                $producto=new product();
                $producto->setNombre($busca);
                $productos=$producto->buscador();
               
            }else{
                 $search = $_SESSION['error'] = $errores;
                
            }
             require_once 'views/product/destacados.php'; 
        }else{
         header('Location:' .base_url);
        }
    
     }
}

?>