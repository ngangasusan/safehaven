<?php
    session_start();
    // destroy the session 
    session_destroy(); 
    // remove all session variables
    unset($_SESSION['userId']);
    unset($userInfo['firstname']);
    unset($userInfo['lastname']);
    unset($userInfo['email']);
    header('Location: ./index.php');
    exit();
?>

