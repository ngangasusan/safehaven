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
  include "./classloader.inc.php";
 
  $firstname = "";
  $lastname = "";
  $email = "";
  $phonenumber = "";
  $hospital = "";
  $specialty = "";


  $id = 0;

  if (isset($_GET['view']) && (int)$_GET['view'] > 1) {
    $id = (int)$_GET['view'];

    $dbmanager = new DbManager();
    $userinfo = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userId = ?", [$id]);
    $userInfo = $dbmanager->query(DbManager::THERAPIST_TABLE, ["*"], "therapistId = ?", [$id]);

    if ($userinfo !== false) {
      $firstname = $userinfo['firstname'];
      $lastname = $userinfo['lastname'];
      $email = $userinfo['email'];
      $phonenumber = $userinfo['phonenumber'];
      $specialty = $userInfo['specialty'];
      $hospital = $userInfo['hospital'];
      $profilepic = $userinfo['profile_picture'];

    }
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
  <!--Standard Cover-->
  <div class="flex flex-row bg-green-300 flex-row justify-center space-x-4 items-center p-6 m-0 w-full">
    <p class="my-4 font-bold italic text-xl text-gray-500">A step away from clarity</p>
  </div>
  <!--Therapist Details-->
  <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
    <!--Left with logo-->
    <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
      <!--<img src="assets/img/logo.png" alt="logo" class="w-32 sm:w-64">-->
      <img src="./storage/profile_images/<?php echo $row['profile_picture']?>" alt="Therapists Profile" class="w-32 sm:w-64">
      <span class="text-green-300 text-3xl"><?php echo $firstname ." " .$lastname?></span>
      <p class="my-4 text-gray-500">Member Since: 2010</p>
      <div class="space-x-4">
        <a href="./message.php"><i class="fas fa-comment"></i></a>
        <i class="fas fa-phone"></i>
        <i class="fa fa-video"></i>
      </div>
      <!--Display therapists with the same specialty-->
      <div>
          <p>Similar Profiles</p>
          <img src="./assets/img/tempusers/therapist1.jpg" class="inline object-cover w-16 h-16 mr-2 rounded-full" alt="">
          <img src="./assets/img/tempusers/user3.jpg" class="inline object-cover w-16 h-16 mr-2 rounded-full" alt="">
          <img src="./assets/img/tempusers/user2.jpg" class="inline object-cover w-16 h-16 mr-2 rounded-full" alt="">
      </div>
    </div>
    
    
    <!--Right with therapist details-->
    <div class="flex flex-col flex-grow items-center p-6">
    <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
        <img src="assets/img/logo.png" alt="logo" class="w-12">
        <span class="text-xs font-bold text-gray-500">Therapist Details</span>
      </div>

      <form class="flex justify-around flex-col p-4" id="registerForm" method="GET" enctype="multipart/form-data">
        <div class="flex">
          <!--First Name-->
          <div>
            <label for="firstname" class="text-gray-500 text-xs font-bold mb-2 ml-2">First Name</label>
            <input type="text" name="firstname" id="firstname"  class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $firstname ?>" disabled>
          </div>

          <!--Last Name-->
          <div>
            <label for="lastname" class="text-gray-500 text-xs font-bold mb-2 ml-2">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $lastname ?>" disabled>
          </div>
        </div>
        <!--Email-->
        <div class="flex flex-col mb-6">
          <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
          <input type="email" name="email" id="email" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $email ?>" disabled>
        </div>
        
        <!--Phone number-->
        <div class="flex flex-col mb-6">
            <label for="phone" class="text-gray-500 text-xs font-bold mb-2 ml-2">Mobile Number</label>
            <input type="tel" name="phone" id="phone" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $phonenumber ?>" disabled>
        </div>

        <!--Hospital-->
        <div class="flex flex-col mb-6">
            <label for="hospital" class="text-gray-500 text-xs font-bold mb-2 ml-2">Hospital</label>
            <input type="text" name="hospital" id="hospital" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $hospital ?>" disabled>
        </div>
        <!--Specialty-->
        <div class="flex flex-col mb-6">
            <label for="specialty" class="text-gray-500 text-xs font-bold mb-2 ml-2">Specialty</label>
            <input type="text" name="specialty" id="specialty" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" value="<?php echo $specialty ?>" disabled>
        </div>        
        
    
        <!--Book An Appointment-->
        <div class="flex flex-col mb-4">
          <!--<button type="button" id="register-btn" name="register-btn" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Book Appointment</button>-->
          <a href='<?php echo "bookAppointment.php?i=" .$id?>' class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Book Appointment</a>
          
        </div>
      </form>
    </div>
  </div>
</body>
</html>