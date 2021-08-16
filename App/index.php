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
  <link rel="icon" href="assets/img/logo.png" sizes="48x48" />
</head>

<body>
  <!-- Navbar -->
  <nav class="
        flex flex-col
        sm:flex-row sm:justify-between
        p-2
        bg-white
        shadow-sm
        border-b
        items-center
      ">
    <!--Left Side-->
    <ul class="flex flex-col sm:flex-row items-center">
      <!--Logo-->
      <li class="pl-3 pr-6 mb-4 sm:mb-0">
        <a href="index.php" class="flex items-center">
          <img src="./assets/img/logo.png" alt="logo" class="w-10 sm:w-20 mr-6" />
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
        <a href="home.php" class="
              text-gray-500
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
            ">Home</a>
      </li>

      <!--Therapists-->
      <li class="mb-4 sm:mb-0">
        <a href="therapists.php" class="
              text-gray-500
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
            ">Therapists</a>
      </li>

      <!--Community-->
      <li>
        <a href="community.php" class="
              text-gray-500
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
            ">Community</a>
      </li>

      <!--Login-->
      <li>
        <a href="login.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Login</a>
      </li>

      <!--Register-->
      <li>
        <a href="register.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Sign Up</a>
      </li>

    </ul>
  </nav>

  <!--Body with image and details-->
  <!-- <div class="flex flex-col p-6"> -->
  <div class="flex flex-col p-6 m-5">
    <div class="flex">
      <img class="object-contain m-5" src="assets/img/therapySession.jpg" class=".bg-opacity-100" alt="Therapy Session">
      <h2 class="font-serif	italic p-6 my-1"><strong class="text-3xl">"Growing up, the biggest misconception I had was that </strong> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur"<span><a class="text-blue-400" href="./login.php">Read more</a></span></h2>

    </div>

    <div class="flex">
      <h2 class="font-serif	italic p-6 my-1"><strong class="text-3xl">"The community built here is </strong> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur"<span><a class="text-blue-400" href="./login.php">Read more</a></span></h2>
      <img class="object-contain m-5" src="assets/img/therapySession2.jpeg" class=".bg-opacity-100" alt="Therapy Session">

    </div>


  </div>
</body>

</html>