<?php
spl_autoload_register(function($name){
        $name = strtolower($name);
        require_once(__DIR__."/logic/classes/$name.class.php"); 
    });
?>