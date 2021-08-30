<?php
session_start();
include "./classloader.inc.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Safe Haven</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">


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
          <span class="text-green-400 text-xl">Safe Haven</span>
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
        <a href="index.php" class="
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

      <?php
      $dbmanager = new DbManager();
      $userInfo = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userId = ?", [$_SESSION['userId']]);
      $firstname = $lastname = $email = $location = "";
      if ($userInfo !== false) {
        $firstname = $userInfo['firstname'];
        $lastname = $userInfo['lastname'];
        $email = $userInfo['email'];
        $phonenumber = $userInfo['phonenumber'];
        $profilepic = $userInfo['profile_picture'];
        // $verified = $userInfo['verified'];
      } else {
        //echo "User info is false";
        echo "User id is " . $_SESSION['userId'];
      }
      ?>

      <div class="px-5 flex flex-row bg-green-300 p-4 rounded-xl">
        <!--Username-->
        <li class="px-2">

          <!-- <p class="font-bold"><?php echo "$firstname $lastname" ?> -->
          <?php $username = "$firstname $lastname" ?>
        </li>
        <li>
          <!-- <i class="far fa-user"></i> -->
          <!-- <i class="fas fa-caret-down dropdown-menu"></i> -->
        </li>
        <li class="flex-1 md:flex-none md:mr-3">
          <div class="relative inline-block">
            <button onclick="toggleDD('myDropdown')" class="drop-button text-white focus:outline-none"> <span class="pr-2"><i class="far fa-user"></i></span> <?php echo $username ?> <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg></button>
            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
              <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
              <a href="profile.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
              <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="far fa-calendar-check"></i></i> My Appointments</a>
              <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-users"></i> Therapists</a>
              <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
              <div class="border border-gray-800"></div>
              <a href="logout.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
            </div>
          </div>
        </li>
      </div>
    </ul>
  </nav>
  <!--Profile picture section-->
  <div class="sm:flex flex-col sm:w-8/12 sm:mx-auto sm:mt-20 place-items-center">
    <!--Picture-->
    <div>
      <img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="./storage/profile_images/<?php echo $profilepic?>" alt="Profile image" />
    </div>


  <!--User Details-->
  <!--"w-6/12 mx-auto flex flex-col p-6 border rounded-sm mt-6 shadow text-gray-500 mb-6"-->
  <div class="flex flex-col sm:flex sm:w-6/12 sm:mx-auto sm:mt-20 bg-gray-50 rounded-md w-full mb-6">

   <!--Displaying errors-->
   <div id="error" class="opacity-100 transition-all text-red-600 py-2 px-4 rounded-3xl"></div>
   <div id="success-display" class="opacity-100 transition-all text-green-500 py-2 px-4 rounded-3xl"></div>

    <!--Form with details-->
    <div>
      <form class="flex justify-around flex-col p-4" id="upfateForm" method="POST">
        <!--specialty-->
        <div class="flex flex-col mb-6">
          <label for="specialty" class="text-gray-500 text-xs font-bold mb-2 ml-2">Specialty</label>
          <input type="text" name="specialty" id="specialty" onkeyup="nameInputVerify(this)" value="Psychologist" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your area of expertise">
        </div>


        <!--Phone number-->
        <div class="flex flex-col mb-6">
          <label for="hospital" class="text-gray-500 text-xs font-bold mb-2 ml-2">Hospital</label>
          <input type="text" name="hospital" id="hospital" onkeyup="nameInputVerify(this)" value="Coptic" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your hospital/ where you work">
        </div>

        <!--Hidden input field-->
        <input type="hidden" id="action" name="action" value="<?php echo $action ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">

        <!--Upgrade Account-->
        <div class="flex flex-col mb-4">
            <button type="button" id="upgrade-btn" class="rounded-md text-white bg-green-400 w-full py-2 px-4 text-xs font-bold">Upgrade Account</button>
        </div>
      </form>
    </div>
  </div>
  <?php
    include "scripts.php";
    ?>
    <script src="./js/upgrade.js"></script>

</body>
</html>