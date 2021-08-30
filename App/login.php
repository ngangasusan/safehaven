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
    <!--Navbar-->
    <?php
  include "./classloader.inc.php";
  include "./components/header.cmp.php";
 
  ?>
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
            <!--Displaying errors-->
            <div id="error" class="opacity-100 transition-all text-red-600 py-2 px-4 rounded-3xl"></div>
            <div id="success-display" class="opacity-100 transition-all text-green-500 py-2 px-4 rounded-3xl"></div>

            <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
                <img src="assets/img/logo.png" alt="logo" class="w-12">
                <span class="text-xs font-bold text-gray-500">Login</span>
            </div>

            <form class="flex justify-around flex-col p-4" id="loginForm" method="POST">
           
            <!--Email-->
            <div class="flex flex-col mb-6">
                <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
                <input type="email" name="email" id="email" onkeyup="nameInputVerify(this)" value="alexandria@gmail.com" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your email address" required autocomplete="email" >
            </div>

            <!--Password-->
            <div class="flex flex-col mb-6">
                <label for="password" class="text-gray-500 text-xs font-bold mb-2 ml-2">Password</label>
                <input type="password" name="password" id="password" onkeyup="checkPassword(this)" value="Aa123456789" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Enter your password" required/>
            </div>

            <!--Login Button-->
            <div class="flex flex-col mb-4">
                <button type="button" id="login-btn" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Login</button>
            </div>

            <!--Recovery-->
            <div class="flex flex-col items-center text-gray-500 text-sm">
                <span class="mb-3">Don't have an account?<a href="register.php" class="text-blue-500 hover:underline">Sign up</a></span>
                    <a href="" class="text-blue-500 hover:underline">Forgot password?</a>
            </div>
        </form> 
        </div>
    </div>
    <?php
    include "scripts.php";
    ?>
    <script src="./js/login.js"></script>
  </body>
</html>
