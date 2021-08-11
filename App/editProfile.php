<?php
  session_start();
  include "./classloader.inc.php";

  //Query to select the user in session
  $dbmanager = new DbManager();

  //Getting user in session id
  $userId = $_GET['userId'];

  //query("users", ["email","password"], "email = ?", ["$email"]);
  $dbmanager->query(DbManager::USER_TABLE,["user"],"userId=?",["$userId"]);

  //Request for values in the database
  $userId = $_REQUEST["userId"];
  $firstname = $_REQUEST["firstname"];
  $lastname = $_REQUEST["lastname"];
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $profile_picture = $_REQUEST["profile_picture"];
  $location = $_REQUEST["location"]; 
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
            <a href="login.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Login</a>
        </li>

        <!--Register-->
        <li>
            <a href="register.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Sign Up</a>
        </li>
      </ul>
    </nav>

    <p class="text-green-400 text-xl text-center">ACCOUNT INFORMATION</p>
    <!--Registration Box-->
    <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
        <!--Left with logo-->
        <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
        <label for="profilepicture">Choose your Profile Picture</label>
              <input type="file" id="profilepicture" name="profilepicture" accept="image/*">
        </div>

        <!--Right with dets-->
        <div class="flex flex-col flex-grow items-center p-6">
            <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
                <img src="assets/img/logo.png" alt="logo" class="w-12">
                <span class="text-xs font-bold text-gray-500">Sign Up</span>
            </div>

            <form class="flex justify-around flex-col p-4" action="logic/procedures/profile.procedure.php" id="profileForm" method="GET">
            <div class="flex">
            <!--First Name-->
              <div>
                <label for="firstname" class="text-gray-500 text-xs font-bold mb-2 ml-2">First Name</label>
                <input type="text" name="firstname" id="firstname" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" required value="<?php echo $row['firstname'];?>">
              </div>

              <!--Last Name-->
              <div>
                <label for="lastname" class="text-gray-500 text-xs font-bold mb-2 ml-2">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" required value="<?php echo $row['lastname'];?>">
              </div>
            </div>
            <!--Email-->
            <div class="flex flex-col mb-6">
                <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
                <input type="email" name="email" id="email" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" required autocomplete="email" required value="<?php echo $row['email'];?>">
            </div>

            <!--Location-->
            <div class="flex flex-col mb-6">
                <label for="location" class="text-gray-500 text-xs font-bold mb-2 ml-2">Location</label>
                <input type="text" name="location" id="location" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" required value="<?php echo $row['location'];?>"/>
            </div>

            <!-- Phone number-->
            <div class="flex flex-col mb-6">
              <label for="phone" class="text-gray-500 text-xs font-bold mb-2 ml-2">Phone Number</label>
              <input type="tel" name="phone" id="phone" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" required value="<?php echo $row['phonenumber'];?>"/>
          </div>


            <!--Save changes-->
            <div class="flex flex-col mb-4">
                <button id="register" name= "register" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Update Profile</button>
            </div>

            <!--Password Change-->
            <div class="flex flex-col items-center text-gray-500 text-sm">
                <span class="mb-3">Want to change your password? <a href="login.php" class="text-blue-500 hover:underline">Change Password</a></span>
      
            </div>
        </form> 
        </div>
    </div>
  </body>
</html>
