<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Safe Haven</title>
        <link rel="stylesheet" href="assets/css/style.css" />
    
    
        <!--Icon-->
        <link rel="icon" href="assets/img/logo.png" sizes="16x16" />
      </head>

      <body>
          <!-- Navbar -->
        <nav class="flex flex-col sm:flex-row sm:justify-between p-2 bg-white shadow-sm border-b items-center">
        <!--Left Side-->
        <ul class="flex flex-col sm:flex-row items-center">
          <!--Logo-->
          <li class="pl-3 pr-6 mb-4 sm:mb-0">
            <a href="index.php" class="flex items-center">
              <img
                src="./assets/img/logo.png"
                alt="logo"
                class="w-10 sm:w-20 mr-6"
              />
              <span class="text-green-300 text-xl">Safe Haven</span>
            </a>
          </li>
          <!--Search bar-->
          <li class="pl-3 pr-6 mb-4 sm:mb-0">
            <div>
              <input type="text" class="bg-gray-100 mx-6 outline-none p-3 rounded-2xl" placeholder="Search therapist" />
              <i class="fas fa-search"></i>
            </div>
          </li>
        </ul>
        <!--Right Side-->
        <ul class="flex flex-col sm:flex-row items-center">
          <!--Home-->
          <li class="mb-4 sm:mb-0">
            <a
              href="index.php"
              class="
                text-gray-500
                px-6
                py-3
                hover:bg-green-200
                rounded-md
                text-sm
              "
              >Home</a
            >
          </li>
  
          <!--Therapists-->
          <li class="mb-4 sm:mb-0">
            <a
              href="therapists.php"
              class="
                text-gray-500
                px-6
                py-3
                hover:bg-green-200
                rounded-md
                text-sm
              "
              >Therapists</a
            >
          </li>
  
          <!--Community-->
          <li>
            <a
              href="community.php"
              class="
                text-gray-500
                px-6
                py-3
                hover:bg-green-200
                rounded-md
                text-sm
              "
              >Community</a
            >
          </li>
          <!--User in session-->
          <ul class="hidden sm:flex sm:flex-row sm:items-center">
            <?php
                if(isset($_SESSION['userId'])) {
            ?>

            <li id="user-drop-down-li">
                <div id="user-drop-down" class="mx-6"></div>
            </li>
            <?php
                }else{
            ?>
            <li class="mb-4 sm:mb-0" id="login-btn">
                <a
                    href="login.php"
                    class="text-gray-500 px-6 py-3 hover:bg-indigo-100 rounded-md text-sm"
                    >Login</a
                >
            </li>
            <li class="mb-4 sm:mb-0" id="register-btn">
                <a
                    href="register.php"
                    class="text-gray-500 px-6 py-3 hover:bg-indigo-100 rounded-md text-sm"
                    >Register</a
                >
            </li>
            <?php }?>
          </ul>
          <!--End of user session-->
        </ul>
      </nav>

      <!--Password Reset Box-->
      <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
        <!--Logo-->
        <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
            <img src="assets/img/logo.png" alt="logo" class="w-32 sm:w-64">
            <span class="text-green-300 text-3xl">Safe Haven</span>
            <p class="my-4 text-gray-500">A step away from clarity</p>
        </div>
        <!--Reset-->
        <form class="flex justify-around flex-col p-4" id="registerForm" method="POST">
            <!--Old Password-->
            <div class="flex flex-col mb-6">
                <label for="oldassword" class="text-gray-500 text-xs font-bold mb-2 ml-2">Password</label>
                <input type="password" name="oldpassword" id="oldpassword" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Enter your password" required/>
                <span id="password_error" class="text-red-500 text-xs ml-2"></span>
            </div>
            <!--New Password-->
            <div class="flex flex-col mb-6">
                <label for="newpassword" class="text-gray-500 text-xs font-bold mb-2 ml-2">Password</label>
                <input type="password" name="newpassword" id="newpassword" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Enter your password" required/>
                <span id="password_error" class="text-red-500 text-xs ml-2"></span>
            </div>

            <!-- Confirm New Password-->
            <div class="flex flex-col mb-6">
              <label for="cpassword" class="text-gray-500 text-xs font-bold mb-2 ml-2">Confirm Password</label>
              <input type="password" name="cpassword" id="cpassword" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Confirm your password" required/>
              <span id="password_error" class="text-red-500 text-xs ml-2"></span>
          </div>


            <!--Reset Password Button-->
            <div class="flex flex-col mb-4">
                <button class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Reset Password</button>
            </div>
        </form> 
        </div>
    </div>
    </body>
</html>