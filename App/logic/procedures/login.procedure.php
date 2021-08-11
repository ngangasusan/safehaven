<?php
    session_start();
    require_once "./classloader.inc.php";
    
    $dbmanager = New DbManager();
    
    //Get from form
    $email = isset($_POST["email"])?$_POST["email"]:"";
    $password = isset($_POST["password"])? $_POST["password"]:"";

    //Validation
    if (!Utility::checkEmail($email)) {
        exit(Response::make("EIE","Email address is required")); //EIE - Email Invalid Error
    }
    if(empty($password)){
        exit(Response::make("PIE", "Password is required")); //PIE - Password Input Error
    }

    $logindetails = $dbmanager->query(DbManager::USER_TABLE, ["userId","email","password","userType"], "email = ?", [$email]);

    //print_r($logindetails);
    
    if($logindetails === false)
    {
        exit(Response::make("WEE","Wrong Email Error")); //Wrong Email Error
    }

    if(!password_verify($password, $logindetails["password"]))
    {
        exit(Response::make("WPI","Wrong Password")); //Wrong Password Error)
    }
    
    $userId = $logindetails["userId"];
    $userType = $logindetails["userType"];

    $_SESSION['userId'] = $userId;
    $_SESSION['userType'] = $userType;

    
    

        //$this->email = $email;
        //header('Location: ../../home.php');
        //return "OK";
        //echo "Hello"; 
        exit(Response::make("OK",$userType)); //

        
?>
    

  

    
