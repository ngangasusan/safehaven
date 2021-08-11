<?php
spl_autoload_register(function($name){
        $name = strtolower($name);
        require_once(__DIR__."/../classes/$name.class.php");   
    });
?>
