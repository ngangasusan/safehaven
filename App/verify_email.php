<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if ($_GET['key'] && $_GET['token']) 
        {
            include "db_connect.php";
            $email = $_GET['key'];
            $token = $_GET['token'];
            $query = mysqli_query($link, "SELECT * FROM `users` WHERE `email_verification_link`='".$token."' and `email`='".$email."';");
            $d = date('Y-m-d H:i:s');
            if (mysqli_num_rows($query)>0) 
            {
                $row= mysqli_fetch_array($query);
                if($row['email_verified_at'] == NULL)
                {
                    mysqli_query($conn,"UPDATE users set email_verified_at ='" . $d . "' WHERE email='" . $email . "'");
                    $msg = "Congratulations! Your email has been verified.";
                }else
                {
                    $msg = "You have already verified your account with us";
                }
            }else
            {
                $msg = "This email has been not registered with us";
            }  
        }else{
            $msg = "Danger! Your something goes to wrong.";
        }
    ?>
    <div class="card-body">
             <p><?php echo $msg; ?></p>
    </div>
</body>
</html>