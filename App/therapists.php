<?php
 session_start();
 include "./classloader.inc.php";

 $dbmanager =  New DbManager();
 $dbmanager->setFetchAll(true);
 $tabledata = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userType = ?", ["therapist"]);


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
              text-green-200
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
              font-bold
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
      $dbmanager = New DbManager();
      $userInfo = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userId = ?", [$_SESSION['userId']]);
      $firstname = $lastname = $email = "";
      if ($userInfo!==false) {
        $firstname = $userInfo['firstname'];
        $lastname = $userInfo['lastname'];
        $email = $userInfo['email'];
       // $verified = $userInfo['verified'];
      }
      else{
        //echo "User info is false";
        echo "User id is ".$_SESSION['userId'];
      }
      ?>

      <div class="px-5 flex flex-row bg-green-300 p-4 rounded-xl">
        <!--Username-->
        <li class="px-2">

          <!-- <p class="font-bold"><?php echo "$firstname $lastname"?> -->
          <?php $username = "$firstname $lastname"?>
        </li>
        <li>
        <!-- <i class="far fa-user"></i> -->
        <!-- <i class="fas fa-caret-down dropdown-menu"></i> -->
        </li>
        <li class="flex-1 md:flex-none md:mr-3">
                <div class="relative inline-block">
                    <button onclick="toggleDD('myDropdown')" class="drop-button text-white focus:outline-none"> <span class="pr-2"><i class="far fa-user"></i></span> <?php echo $username?> <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
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
  
</body>
<!--Display registered therapists-->
<div>
  <!--Therapists Picture
  <div></div>
  Therapists name-->
  <div class="tbg mx-auto my-0 mt-3 bg-white">
    <!--Settings-->
  <div class="theader flex justify-between">
    <div class="flex items-center text-gray-500 text-center px-5">
      <i class="fa fa-cog" aria-hidden="true"></i>
    </div>
    <!--Comments icon-->
    <div class="flex items-center text-gray-500 text-center px-5">
      <i class="fa fa-comments" aria-hidden="true"></i>
    </div>
  </div>
  
  <!--Therapists Details-->
  <div class="px-10 flex flex-row items-center sm:justify-between">
    <!--Previous Arrow-->
    <div>
      <i class="fas fa-arrow-left fa-6x text-green-300"></i>
    </div>
    <!--Therapist Card-->
    <div class="tphoto rounded-lg border border-gray-400 shadow-lg items-center">
      
      <img src="./assets/img/tempusers/therapist1.jpg" 
           class="w-full user-image "
           title="tphoto"
           alt="Therapist Photo"
      />
      
      <div class="flex justify-between">
        <div class="tname text-xl float-left p-4">Sophia Grace <span class="font-light">Dr.</span></div>
      
        <div class="tinfo text-lg float-right text-gray-500 p-4">
          <i class="fas fa-calendar pr-2"></i>
        </div>
      </div>
      
      <div class="pl-4 text-gray-400">
        <p>Psychologist</p>
        <p>Nairobi West Hospital</p>
      </div>
      <div class="flex items-center justify-center w-full h-full pt-12">
       <a class=" text-blue-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm"href="therapistProfile.php">Visit Profile</a>
      </div>
    </div>
    <!--Previous Arrow-->
    <div>
      <i class="fas fa-arrow-right fa-6x text-green-300"></i>
    </div>

    
    
    
  </div>

</div>

<?php
  include "scripts.php";
  ?>

</html>