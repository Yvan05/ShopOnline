<?php

function autoloadclass($classname){
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('autoloadclass');
?>
