<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    

    require_once "../classloader.inc.php";
   
    if (!isset($dbmanager)) {
        $dbmanager = New DbManager();
    }
    
    // if (isset($userId)){
    //     //echo "success";
    //     if (isset($_GET['id'])) {
    //         $userId = $_GET['id'];
    //     }
    //     else{
    //         $userId = $_SESSION['userId'];
    //     }
    // }
    // $deleteUser = $dbmanager->delete(DbManager::USER_TABLE, "userId = ?", [$userId]);


    if(isset($_GET['delete']))
    { 
        $ID = (int)$_GET['delete'];
        $deleteUser = $dbmanager->delete(DbManager::USER_TABLE, "userId = ?", [$ID]);

        if ($deleteUser) {
            echo "User deleted successfully!";
            header ('Location:'. $_SERVER["PHP_SELF"]);
        }
        else{
            echo "Error deleting record";
        }

    }
    

?>