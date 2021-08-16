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

  <div>
    <a href="http://"></a>
  </div>
  <?php
  //$profile = echo $userInfo['profile_picture'];
  ?>
  <!--Profile picture section-->
  <div class="sm:flex flex-col sm:w-8/12 sm:mx-auto sm:mt-20 place-items-center">
    <!--Picture-->
    <div>
     
      <!-- <img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="./assets/img/therapySession5.jpeg" alt="Profile image"/> -->
      <!--<img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="./assets/img/therapySession4.jpg" alt="Profile image" />-->
      <img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="./storage/profile_images/$userInfo['profile_picture']" alt="Profile image" />

    </div>
  </div>


  <!--User Details-->
  <!--"w-6/12 mx-auto flex flex-col p-6 border rounded-sm mt-6 shadow text-gray-500 mb-6"-->
  <div class="flex flex-col sm:flex sm:w-6/12 sm:mx-auto sm:mt-20 bg-gray-50 rounded-md w-full mb-6">

    <!--Form with details-->
    <div>
      <form class="flex justify-around flex-col p-4" id="registerForm" method="GET">
        <div class="flex">
          <!--First Name-->
          <div>
            <label for="firstname" class="text-gray-500 text-xs font-bold mb-2 ml-2">First Name</label>
            <input type="text" name="firstname" id="firstname" onkeyup="nameInputVerify(this)" value="<?php echo $firstname ?>" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your first name" disabled>
          </div>

          <!--Last Name-->
          <div>
            <label for="lastname" class="text-gray-500 text-xs font-bold mb-2 ml-2">Last Name</label>
            <input type="text" name="lastname" id="lastname" onkeyup="nameInputVerify(this)" value="<?php echo $lastname ?>" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your first name" disabled>
          </div>
        </div>
        <!--Email-->
        <div class="flex flex-col mb-6">
          <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
          <input type="email" name="email" id="email" onkeyup="emailInputVerify(this)" value="<?php echo $email ?>" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your email address" disabled>
        </div>


        <!--Phone number-->
        <div class="flex flex-col mb-6">
          <label for="phone" class="text-gray-500 text-xs font-bold mb-2 ml-2">Mobile Number</label>
          <input type="tel" name="phone" id="phone" onkeyup="nameInputVerify(this)" value="<?php echo $phonenumber ?>" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Your first name" disabled>
        </div>

        <!--Hidden input field-->
        <input type="hidden" id="action" name="action" value="<?php echo $action ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">


        <!--Registration Button-->
        <div class="flex flex-col mb-4">
          <!--<button type="button" id="register-btn" name="register-btn" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Edit details</button>-->
          <a class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold" href='<?PHP echo "./register.php?edit=" . $userInfo['userId']; ?>'>Edit Profile</a>
        </div>

        <?php if (!$_SESSION['userId']) { ?>
          <!--Recovery-->
          <div class="flex flex-col items-center text-gray-500 text-sm">
            <span class="mb-3">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login</a></span>
          <?php } ?>
          </div>
      </form>
    </div>
  </div>

</body>
<?php
include "scripts.php";
?>

</html>