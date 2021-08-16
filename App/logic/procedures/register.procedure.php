<?php
session_start();
require_once "./classloader.inc.php";
require_once "../classes/utility.class.php";

$dbmanager = new DbManager();

$firstname = "";
$lastname = "";
$email = "";
$phonenumber = "";
$action = "r";
//if user clicks on the sign up button

$post = array_map("urldecode", $_POST);

$firstname = $post['firstname'];
$lastname = $post['lastname'];
$email = $post['email'];
//$phonenumber = $post['phone'];
$action = $post['action'];

//var_dump($post);
//validation
if (empty($firstname)) {
    exit(Response::make("FNE", "First name is required")); //FNE - First Name Error
}
if (empty($lastname)) {
    exit(Response::make("LNE", "Last Name required")); //LNE - Last Name Error
}
if (!Utility::checkEmail($email)) {
    exit(Response::make("EIE", "Email address is required")); //EE - Email Invalid Error
}

//
switch ($action) {
    case "r": {
            $password = $post['password'];
            $isPasswordStrong = Utility::isPasswordStrong($password);
            if ($isPasswordStrong !== true) {
                exit($isPasswordStrong);
            }
            if (Utility::doesEmailExist($email)) {
                exit(Response::make("EAE", "Email Already Exists")); //EAE - Email Already Exists
            }
            $password = password_hash($password,  PASSWORD_DEFAULT);

            //Token for email verification
            $token = bin2hex(random_bytes(50));

            //
            $verified = false;

            //insert to db
            $userId = $dbmanager->insert(DbManager::USER_TABLE, ["firstname", "lastname", "email", "password", "userType", "verified", "token"], [$firstname, $lastname, $email, $password, "patient", $verified, $token]);


            $_SESSION['userId'] = $userId;
            $_SESSION['userType'] = "patient";
            break;
        }

    case "u": {
            $userId = $post['id'];
            $phonenumber = $post['phone'];
            $updateString = "firstname = ?, lastname = ?, email = ?, phonenumber = ?";
            $values = [$firstname, $lastname, $email, $phonenumber];

            $userInfo = $dbmanager->query(DbManager::USER_TABLE, ["email", "password"], "userId = ?", [$userId]);
            if ($userInfo === false) {
                exit(Response::SQE());
            }
            if ($userInfo['email'] !== $email) {
                if (Utility::doesEmailExist($email)) {
                    exit(Response::make("EAE", "Email Already Exists")); //EAE - Email Already Exists
                }
                $updateString .= " , verified = ? ";
                $values[] = 0;
            }

            if ($post['withPassword'] === "true") {
                $password = $post['password'];

                if ($_SESSION['userType'] != "admin") {
                    if (!isset($post['oldPassword'])) {
                        exit(Response::make("", ""));
                    }
                    $oldPassword = $post['oldPassword'];
                    if (!password_verify($oldPassword, $userInfo['password'])) {
                        exit(Response::make("PDNM", "Password you entered does not match your current password"));
                    }
                }


                $isPasswordStrong = Utility::isPasswordStrong($password);
                if ($isPasswordStrong !== true) {
                    exit($isPasswordStrong);
                }

                $password = password_hash($password, PASSWORD_DEFAULT);
                $updateString .= ", password = ? ";
                $values[] = $password;
            }

            //Phone number
            if (!empty($phonenumber)) {
                $phonenumber = ($phonenumber[0] == "+") ? $phonenumber : "+" . substr($phonenumber, 1);

                $phoneVerify = Utility::checkPhone($phonenumber);


                //If the format of the number is wrong

                if (!$phoneVerify) {
                    exit(Response::make("WNF", "Check your phone number format")); //WNF- Wrong Number Format
                }
                //If the format is okay, update it.
                if ($phoneVerify) {
                    $updateString .= ", phonenumber = ? ";
                    $values[] = $phonenumber;
                }
            }

            //adding a profile picture

            if (isset($post["withPicture"]) && $post["withPicture"] == "true") {
                //Check if the format is acceptable
                $profileImage = $_FILES["profilePicture"];
                if (Utility::isImage($profileImage['tmp_name'])) {
                    //query the user table for the profile picture
                    $profilequery = $dbmanager->query(DbManager::USER_TABLE, ["profile_picture"], "userId = ?", [$userId]);
                    //if the profile pic is empty, updating is equal to true and pass the name of the profile picture in the upload Image file at the end - saved as
                    $update = false;
                    $lastSavedAs = "";
                    if (!empty($profilequery['profile_picture'])) {
                        $update = true;
                        $lastSavedAs = $profilequery['profile_picture'];
                    }

                    $imageName = Utility::uploadImage($profileImage, $userId, "profile_images", $update, $lastSavedAs);
                    if ($imageName !== false) {
                        $updateString .= ", profile_picture = ? ";
                        $values[] = $imageName;
                    }

                    //$imageName = Utility::uploadImage($_FILES['profilePicture'],"profileImage","App/assets/img/ProfilePictures","false","image");
                    //$imageName = Utility::uploadImage($profileImage, $profileImage["name"], "profile_image", true)
                }
            }


            if (!$dbmanager->update(DbManager::USER_TABLE, $updateString, $values, "userId = ?", [$userId])) {
                exit(Response::SQE());
            }
            break;
        }

    default:
        break;
}

exit(Response::make("OK", "You have Successfully Registered")); //
        

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
