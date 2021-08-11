<?php
    spl_autoload_register(function($name){
        $name = strtolower($name);
        require_once("../classes/$name.class.php");
    });

    //Getting user in session id
    $userId = $_GET['userId'];
    
    //Query to select the user in session
    $dbmanager = new DbManager();

    //query("users", ["email","password"], "email = ?", ["$email"]);
    echo $dbmanager->query("users",["user"],"userId=?",["$userId"]);

    //Request for values in the database
    $userId = $_REQUEST["userId"];
    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $profile_picture = $_REQUEST["profile_picture"];
    $location = $_REQUEST["location"];

    //Query to update table with new values
    //echo $dbmanager->update("users","firstname=?",["Change"],"firstname=?",["Person"]);
    //$dbmanager->update($USER_TABLE,"firstname=?, lastname=?, email=?, location=?, profile_picture=?",["$firstname","$lastname","$email","$location","$profile_picture"],"firstname=?, lastname=?, email=?, location=?, profile_picture=?",[$userId= "userId"]);
    //$dbmanager->update("user",)




?>