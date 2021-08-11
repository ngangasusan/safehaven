<?php
    session_start();
    require_once "./classloader.inc.php";
    require_once "../classes/utility.class.php";

    $dbmanager = new DbManager();

    $firstname = "";
    $lastname = "";
    $email = "";
    $action = "r";
    //if user clicks on the sign up button
   
    $post = array_map("urldecode",$_POST);

        $firstname = $post['firstname'];
        $lastname = $post['lastname'];
        $email = $post['email'];
       
        $action = $post['action'];

        //validation
        if (empty($firstname)) {
            exit(Response::make("FNE", "First name is required")); //FNE - First Name Error
        }
        if (empty($lastname)) {
            exit (Response::make("LNE","Last Name required")); //LNE - Last Name Error
        }
        if (!Utility::checkEmail($email)) {
            exit(Response::make("EIE","Email address is required")); //EE - Email Invalid Error
        }
        
        //
        switch ($action) {
            case "r":
                {
                    $password = $post['password'];
                    $isPasswordStrong = Utility::isPasswordStrong($password);
                    if ($isPasswordStrong!== true) {
                        exit($isPasswordStrong);
                    }
                    if(Utility::doesEmailExist($email)){
                        exit(Response::make("EAE", "Email Already Exists")); //EAE - Email Already Exists
                    }
                    $password = password_hash($password,  PASSWORD_DEFAULT);
            
                    //Token for email verification
                    $token = bin2hex(random_bytes(50));
                    
                    //
                    $verified = false;
        
                    //insert to db
                    $userId = $dbmanager->insert(DbManager::USER_TABLE, ["firstname","lastname","email","password","userType","verified","token"], [$firstname,$lastname,$email,$password,"patient",$verified,$token]);        


                    $_SESSION['userId'] = $userId;
                    $_SESSION['userType'] = "patient";
                    break;
                }
            
            case "u": 
                {
                    $userId = $post['id'];
                    $updateString = "firstname = ?, lastname = ?, email = ?";
                    $values = [$firstname, $lastname, $email]; 
            
                    $userInfo = $dbmanager->query(DbManager::USER_TABLE,["email","password"],"userId = ?", [$userId]);
                    if ($userInfo === false) {
                        exit(Response::SQE());
                    }
                    if($userInfo['email'] !== $email){
                        if(Utility::doesEmailExist($email)){
                            exit(Response::make("EAE", "Email Already Exists")); //EAE - Email Already Exists
                        }
                        $updateString .= " , verified = ? ";
                        $values[] = 0;
                    }
                    
                    if ($post['withPassword'] === "true") {
                        $password = $post['password'];
                        
                        if ($_SESSION['userType'] != "admin") {
                            if (!isset($post['oldPassword'])) {
                                exit(Response::make("",""));
                            }
                            $oldPassword = $post['oldPassword'];
                            if (!password_verify($oldPassword, $userInfo['password'])) {
                                exit(Response::make("PDNM", "Password you entered does not match your current password"));
                            }
                        }
    
                        $isPasswordStrong = Utility::isPasswordStrong($password);
                        if ($isPasswordStrong!== true) {
                            exit($isPasswordStrong);
                        }

                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $updateString .= ", password = ? ";
                        $values[] = $password;
                    }

                    if (!$dbmanager->update(DbManager::USER_TABLE, $updateString, $values, "userId = ?", [$userId])) {
                        exit(Response::SQE());
                    }
                    break;
                }

            default:
                break;
        }
        exit(Response::make("OK","You have successfully registered")); //
        

            /*if this is executed, register the user and log them in
            *insert_id gives the last inserted id in the connect object
            */
            // if($userId){
            //     //Send email
            //     $to = $email;
            //     $subject = "Email verification";
            //     $mesage = "a href='http://localhost/registration/verify.php?vkey=$token'>Register Account</a>";
            //     $headers = "FROM: suengangaw@gmail.com";
            //     $headers .= "MIME-Version:1.0" . "\r\n";
            //     $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";

            //     mail($to,$subject,$message,$headers);
                
            //     header('location: home.php');
            //         }
           
            // $_SESSION['firstname'] = $firstname;
            // $_SESSION['lastname'] = $lastname;
            // $_SESSION['email'] = $email;
            //$_SESSION['verified'] = $verified;


            //Sending the verification email

            //sendVerificationEmail($email, $token);

            //flash message
           //$_SESSION['message'] = "You are now logged in!";

             //Redirect to home after successfully registering in
             //header('Location: ../../home.php');
             

        
        /*if not registered
        *display error
        */
