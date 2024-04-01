<?php
ob_start();
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utilities.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';




function show_error() {
    $error = new error_controller();
    $error->index();
}

if (isset($_GET['controller'])) {
    $name_controller = $_GET['controller'] . '_controller';
   
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $name_controller = controller_default;
    //echo ''.$controller->controller_default;
   
} else {
    show_error();
    require_once 'views/layout/main.php';
    exit();
}
if (class_exists($name_controller)) {

    $controller = new $name_controller();

//cargando los metodos dinamicamente por url
    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
       
       $default = action_default;
       $controller->$default();
        
        
        
    } else {
        show_error();
        require_once 'views/layout/main.php';
    }
} else {
    show_error();
   require_once 'views/layout/main.php';
}

require_once 'views/layout/main.php';
?>