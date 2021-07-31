<?php
    spl_autoload_register(function($name){
        $name = strtolower($name);
        require_once("../classes/$name.class.php");
    });

        //Get POST values
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
      
        if ($password!=$cpassword) {
            echo "The two passwords do not match";
        }

        //hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        
        //create class in order to access functionalities
        $dbmanager = New DbManager();
        $dbmanager->insert("users", ["firstname","lastname","email","password"], [$firstname,$lastname,$email,$hashed_password]);
        
        //Redirect to home after logging in
        // header("Location: ../home.php");
        header('Location: ../../home.php');
    
    

    
?>

