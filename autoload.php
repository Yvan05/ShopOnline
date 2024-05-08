<?php

function autoloadclass($classname){
    if(file_exists('controllers/' . $classname . '.php'))
    {
    include 'controllers/'. $classname . '.php';
    
}
}

spl_autoload_register('autoloadclass');
?>
