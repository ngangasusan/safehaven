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
  <link rel="icon" href="assets/img/logo.png" sizes="16x16" />
</head>

<body>
  <!--Navbar-->
  <?php
  include "./classloader.inc.php";
  include "./components/header.cmp.php";
  $firstname = "";
  $lastname = "";
  $email = "";

  $action = "r";
  $id = 0;

  if (isset($_GET['edit']) && (int)$_GET['edit'] > 1) {
    $id = (int)$_GET['edit'];

    $dbmanager = new DbManager();
    $userinfo = $dbmanager->query(DbManager::USER_TABLE, ["*"], "userId = ?", [$id]);

    if ($userinfo !== false) {
      $firstname = $userinfo['firstname'];
      $lastname = $userinfo['lastname'];
      $email = $userinfo['email'];
      $phonenumber = $userinfo['phonenumber'];
      $buttonText = "Update";
      $action = "u";
      $labelText = "Edit Details";
      //$userType = $userinfo['userType'];
    }
  }
  ?>

  <!--Registration Box-->

  <div class="flex flex-col sm:flex sm:flex-row-reverse bg-gray-50 rounded-md w-full sm:w-8/12 sm:mx-auto sm:mt-20 shadow overflow-hidden mb-10">
    <!--Left with logo-->
    <div class="flex flex-col justify-center items-center bg-white p-6 m-0 sm:w-6/12 w-full">
      <img src="assets/img/logo.png" alt="logo" class="w-32 sm:w-64">
      <span class="text-green-300 text-3xl">Safe Haven</span>
      <p class="my-4 text-gray-500">A step away from clarity</p>
    </div>

    <!--Right with dets-->
    <div class="flex flex-col flex-grow items-center p-6">
      <!--Displaying errors-->
      <div id="error" class="opacity-100 transition-all text-red-600 py-2 px-4 rounded-3xl"></div>
      <div id="success-display" class="opacity-100 transition-all text-green-500 py-2 px-4 rounded-3xl"></div>

      <div class="w-full p-4 flex flex-row justify-start items-center mb-6">
        <img src="assets/img/logo.png" alt="logo" class="w-12">
        <span class="text-xs font-bold text-gray-500">Add User</span>
      </div>

      <form class="flex justify-around flex-col p-4" id="registerForm" method="GET" enctype="multipart/form-data">
        <div class="flex">
          <!--First Name-->
          <div>
            <label for="firstname" class="text-gray-500 text-xs font-bold mb-2 ml-2">First Name</label>
            <input type="text" name="firstname" id="firstname" onkeyup="nameInputVerify(this)" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Patient first name">
          </div>

          <!--Last Name-->
          <div>
            <label for="lastname" class="text-gray-500 text-xs font-bold mb-2 ml-2">Last Name</label>
            <input type="text" name="lastname" id="lastname" onkeyup="nameInputVerify(this)" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Patient last name">
          </div>
        </div>
        <!--Email-->
        <div class="flex flex-col mb-6">
          <label for="email" class="text-gray-500 text-xs font-bold mb-2 ml-2">Email address</label>
          <input type="email" name="email" id="email" onkeyup="emailInputVerify(this)" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Patient email address">
        </div>

        
        <!--Phone number-->
        <!-- <div class="flex flex-col mb-6">
        <label for="phone" class="text-gray-500 text-xs font-bold mb-2 ml-2">Mobile Number</label>
        <input type="tel" name="phone" id="phone" onkeyup="phoneInputVerify(this)" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Patient mobile number">
        </div> -->

        <!--Adding profile picture-->
        <!-- <div class="flex flex-col mb-6">
        <label for="profile_picture" class="text-gray-500 text-xs font-bold mb-2 ml-2">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="text-gray-500 text-xs font-bold mb-2 ml-2">
        </div> -->

        

        <!--Hidden input field-->
        <input type="hidden" id="action" name="action" value="<?php echo $action ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">

        <!--Password-->
        <div class="flex flex-col mb-6">
          <label for="password" class="text-gray-500 text-xs font-bold mb-2 ml-2">Password</label>
          <input type="password" name="password" id="password" onkeyup="checkPassword(this)" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Enter your password" />
        </div>

        <!-- Confirm Password-->
        <div class="flex flex-col mb-6">
          <label for="password" class="text-gray-500 text-xs font-bold mb-2 ml-2">Confirm Password</label>
          <input type="password" name="cpassword" id="cpassword" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="Confirm your password" />
        </div>


        <!--Registration Button-->
        <div class="flex flex-col mb-4">
          <button type="button" id="register-btn" name="register-btn" class="rounded-md text-white bg-green-300 w-full py-2 px-4 text-xs font-bold">Register</button>
        </div>

        <?php if (!isset($_SESSION['userId'])) { ?>
          <!--Recovery-->
          <div class="flex flex-col items-center text-gray-500 text-sm">
            <span class="mb-3">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login</a></span>
          <?php } ?>
          </div>
      </form>
    </div>
  </div>
  <?php
  include "scripts.php";
  ?>
 
</body>

</html>