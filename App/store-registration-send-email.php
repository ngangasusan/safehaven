<?php
    if (isset($_POST['register']) && $_POST['email']) 
    {
        include "db_connect.php";
        $result = mysqli_query($link,"SELECT * FROM users WHERE email='" . $_POST['email'] . "'");
        $row= mysqli_num_rows($result);
        if($row < 0)
        {
            $token = md5($_POST['email']).rand(10,9999);
            mysqli_query($link,)
        }

    }

?>