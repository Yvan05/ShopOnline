<?php
require_once 'models/category.php';
//para poder hacer uso de los metodos del la clase category delmodelo
class category_Controller{
    public function index() {
        ///verificar si el usuario es administrador
        Utilities::isAdmin();
        
        $category=new category();
        $categorys=$category->getAll();
        require_once 'views/category/index.php';
        //require_once 'views/category/index.php';
        
        
        
    }
    public function crear() {
        ///verificar si el usuario es administrador
        Utilities::isAdmin();
        require_once 'views/category/crear.php';
        
    }
    public function ver() {
        if(isset($_GET['id'])){
           $id=$_GET['id'];
           $category=new category();
           $category->setId($id);
           $cat=$category->getOne();
           $all_produc_cat=$category->getCategory();
        }
        
      require_once 'views/category/ver.php';  
    }
    public function delete() {
        Utilities::isAdmin();
       
        if (isset($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
           
            $category = new category();
            $category->setId($id);
            $delete=$category->delete();
            if ($delete) {
                $alert = $_SESSION['delete'] = "success";
                
            } else {
                //fallido al eliminar
                //falla por esta categoria essta vincula a un producto
                $alert = $_SESSION['delete'] = "failed";
            }
        }else{
            //falla por que no llego nada por get
          $alert = $_SESSION['delete'] = "failed";  
        }
        header('Location:' . base_url . 'category/index');
        ob_end_flush();
      }
   public function edit() {
        Utilities::isAdmin();
        if(isset($_POST['name_edit'])&& isset($_GET['id'])){
            
        $id=$_GET['id'];
        $name=$_POST['name_edit'];
       
        $category=new category();
        $category->setId($id);
        $category->setNombre($name);
        $edit=$category->edit();
        
               
        if($edit){
            $alert = $_SESSION['delete'] = "success";
        }else{
            
             $alert = $_SESSION['delete'] = "failed";
        }
         
                 
        }else{
             $alert = $_SESSION['delete'] = "failed";
        }
         header('Location:' . base_url . 'category/index');
        ob_end_flush();
      }
     public function save() {
         ///verificar si el usuario es administrador
         Utilities::isAdmin();
         
         
         
   
         if (isset($_POST)) {
             
           
            $nameC = isset($_POST['nameCat']) ? $_POST['nameCat'] : false;
            ///array de errores
            $errores = array();
//validar los datos antes de guardarlos en la base de datos
//VALIDANDO CAMPO NOMBRE
            if (!empty($nameC) && !is_numeric($nameC)) {
                $nameC_validate = true;
            } else {
                $nameC_validate = false;
                $errores['nameCat'] = 'verifique el nombre';
            }
            if (count($errores) == 0) {
                
                //if($name && $lastname && $email && $password && $rol ){   
                $category = new category();
                $category->setNombre($nameC);
                $save = $category->save();
                
             
                
                if ($save) {
                   
                    $alert = $_SESSION['save'] = "success";
                } else {
                    $alert = $_SESSION['save'] = "failed";
                    //mantener los datos del formulario
                    //$_SESSION['buff'] = $_POST;
                }
            } else {
                $alert = $_SESSION['save'] = "vacio";
                //$_SESSION['buff'] = $_POST;
                $form = $_SESSION['error'] = $errores;
                //mantener los datos del formulario
            }
        } else {
            $alert = $_SESSION['save'] = "failed";
        }
        header('Location:' . base_url . 'category/index');
        ob_end_flush();
    }

}
?>
