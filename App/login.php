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

        <!--Login-->
        <li>
            <a href="login.php" class="text-gray-500 px-6 py-3 bg-green-200 rounded-md text-sm">Login</a>
        </li>

        <!--Register-->
        <li>
            <a href="register.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Sign Up</a>
        </li>
      </ul>
    </nav>

    <!--Login Box-->
    <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
        <!--Left with Dets-->
        <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
            <img src="assets/img/logo.png" alt="logo" class="w-32 sm:w-64">
            <span class="text-green-300 text-3xl">Safe Haven</span>
            <p class="my-4 text-gray-500">A step away from clarity</p>
        </div>

        <!--Right with pic-->
        <div class="flex flex-col flex-grow items-center p-6">
            <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
                <img src="assets/img/logo.png" alt="logo" class="w-12">
                <span class="text-xs font-bold text-gray-500">Login</span>
            </div>

            <form class="flex justify-around flex-col p-4" id="loginForm" action="logic/procedures/login.procedure.php" method="POST">
            
            <?php 
              if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
           
            <!--Email-->
            <div class="flex flex-col mb-6">
                <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
                <input type="email" name="email" id="email" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="suengangaw@gmail.com" placeholder="Your email address" required autocomplete="email" >
                <span id="email-error" class="text-red-500 text-xs ml-2"></span>
            </div>

            <!--Password-->
            <div class="flex flex-col mb-6">
                <label for="password" class="text-gray-500 text-xs font-bold mb-2 ml-2">Password</label>
                <input type="password" name="password" id="password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="Password12345" placeholder="Enter your password" required/>
                <span id="password_error" class="text-red-500 text-xs ml-2"></span>
            </div>

            <!--Login Button-->
            <div class="flex flex-col mb-4">
                <button class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Login</button>
            </div>

            <!--Recovery-->
            <div class="flex flex-col items-center text-gray-500 text-sm">
                <span class="mb-3">Don't have an account?<a href="register.php" class="text-blue-500 hover:underline">Sign up</a></span>
                    <a href="" class="text-blue-500 hover:underline">Forgot password?</a>
            </div>
        </form> 
        </div>
    </div>
  </body>
</html>
