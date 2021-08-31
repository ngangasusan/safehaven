<?php
 session_start();
 include "./classloader.inc.php";

 $dbmanager =  New DbManager();
 $dbmanager->setFetchAll(true);
 $tabledata = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userType = ?", ["therapist"]);
 $therapist = 0;

 //therapist id
 if(!isset($_GET["i"])){
  ?>
  <script>
    history.back();
  </script>
  <?php
 }
 else{
  $therapist = (int)$_GET["i"];
 }

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
                        <a href="bookedAppointment.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="far fa-calendar-check"></i></i> My Appointments</a>
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

  <!--Booking Appointment-->
  <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
    <!--Left with logo-->
    <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
      <img src="./assets/img/logo.png" alt="" class="w-32 sm:w-64">
      <span class="text-green-400 text-3xl">Safe Haven</span>
      <p class="my-4 text-gray-500">A step away from clarity</p>
    </div>
    
    
    <!--Right with appointment details-->
    <div class="flex flex-col flex-grow items-center p-6">
    <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
        <img src="assets/img/logo.png" alt="logo" class="w-12">
        <span class="text-xs font-bold text-gray-500">Appointment Details</span>
      </div>

      <form class="flex justify-around flex-col p-4" id="registerForm" method="GET">
       <!--Displaying errors-->
        <div id="error" class="opacity-100 transition-all text-red-600 py-2 px-4 rounded-3xl"></div>
        <div id="success-display" class="opacity-100 transition-all text-green-500 py-2 px-4 rounded-3xl"></div>
      
       <!--Appointment Date-->
        <div class="flex flex-col mb-6">
          <label for="date" class="text-gray-500 text-xs font-bold mb-2 ml-2">Select the appointment date</label>
          <input type="date" name="date" id="a-date" min="date()" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
        </div>

        <!--Start time-->
        <div class="flex flex-col mb-6">
            <label for="starttime" class="text-gray-500 text-xs font-bold mb-2 ml-2">Start time</label>
            <input type="time" name="starttime" id="s-time" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
        </div>
        <!--End time-->
        <div class="flex flex-col mb-6">
            <label for="endtime" class="text-gray-500 text-xs font-bold mb-2 ml-2">End time</label>
            <input type="time" name="endtime" id="e-time" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
        </div>
        <!--Duration-->
        <div class="flex flex-col mb-6">
            <label for="duration" class="text-gray-500 text-xs font-bold mb-2 ml-2">Session Length</label>
    
        </div>
        <input type="hidden" value="<?php echo $therapist ?>" id="t-id">

        <!--Book An Appointment-->
        <div class="flex flex-col mb-4">
          <button type="button" id="appointment-btn" name="appointment-btn" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Book Appointment</button>
        </div>
      </form>
      
    </div>
  </div>
  <script src="js/main.js"></script>
  <script src="js/book.js"></script>
</body>

</html>