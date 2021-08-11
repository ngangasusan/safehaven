<?php
if(isset($_GET['token'])){
    //Process verification
    $token = $_GET['token'];

    //Select verified and token from users where  verified is 0 and token = token limit 1
    $checkVer = $dbmanager->query(DbManager::USER_TABLE, ["verified", "token"], " verified = 0 '$token' LIMIT 1", []);
    if($checkVer->numrows ==1){
        //Validate the email
        //$updateVer = UPDATE user SET verified=1 WHERE token = '$token' LIMIT 1;
        $updateVer = $dbmanager->update(DbManager::USER_TABLE,"verified = ?", [1],["token = $token LIMIT 1"]);
        if (!$updateVer) {
           echo "Your account has not been verified."; 
        }
    
    } else{
        echo "Account is invalid/ Already verified";
    }
}
else{
    die("Something went wrong");
    
}
?>