<?php

class database{
    public static function conectar() {
        $host='localhost'; 
        $username='administrador'; 
        $passwd='admin'; 
        $dbname='tienda';
        $conexion=new mysqli($host, $username, $passwd, $dbname );
        $conexion->query("SET NAMES 'utf8' ");
        
        return $conexion;
        
        
    }
}

