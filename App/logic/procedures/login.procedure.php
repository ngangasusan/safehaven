<?php
    spl_autoload_register(function($name){
        $name = strtolower($name);
        require_once("../classes/$name.class.php");
    });

    $dbmanager = New DbManager();
    
    //Get from form
    $email = $_POST["email"];
    $password = $_POST["password"];


    $logindetails = $dbmanager->query("users", ["email","password"], "email = ?", ["$email"]);

    //print_r($logindetails);

    if($logindetails)
    {
        if(!password_verify($password, $logindetails["password"]))
        {
            print_r("Wrong password!");
            return "Wrong password!";
        }
        $_SESSION['email'] = $email;
        //$this->email = $email;
        header('Location: ../../home.php');
        //return "OK";

    }else{
        print_r("Wrong email!");
        return "Wrong email!";
    }  
    //echo "Hello";
   
    
?>
    

  

    
