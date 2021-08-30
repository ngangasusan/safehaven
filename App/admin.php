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
      <!--Analytics-->
      <li class="mb-4 sm:mb-0">
        <a href="../admin.php" class="
              text-green-300
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
              font-bold
            ">Analytics</a>
      </li>

      <!--Patient-->
      <li>
        <a href="./controls/patient.control.php" class="
              text-gray-500
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
            ">Patients</a>
      </li>

      <!--Therapists-->
      <li class="mb-4 sm:mb-0">
        <a href="./controls/therapist.control.php" class="
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
        <a href="./controls/community.control.php" class="
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
                        <a href="editProfile.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                        <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                        <div class="border border-gray-800"></div>
                        <a href="logout.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                    </div>
                </div>
            </li>
      </div>
    </ul>
  </nav>

  <!--Body with image and details-->
  <!--Error message-->
  
  <!-- <h3 class="text-xl text-center p-6">ADMIN IN SESSION: <?php echo "$firstname $lastname"; ?></h3> -->

  <!--Analytics cardview-->
  <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Total Number of Users-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                               <?php
                                $db  = new PDO('mysql:host=localhost;dbname=safehaven_db', 'root', '');
                                $Sql = "SELECT count(*) as `total` FROM user";
                                $stmt = $db->query($Sql);
                                $stmt->execute();
                                $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                //print_r($total);
                                
                              ?>
                                <h5 class="font-bold uppercase text-gray-600">Number of Users</h5>
                                <h3 class="font-bold text-3xl"><?php echo implode(" ",$total);?><span class="text-green-500"><i class="fas fa-users"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/End of number of users card-->
                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Number of therapists-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                            <?php
                                $db  = new PDO('mysql:host=localhost;dbname=safehaven_db', 'root', '');
                                $Sql = "SELECT count(*) as `total` FROM therapist";
                                $stmt = $db->query($Sql);
                                $stmt->execute();
                                $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                //print_r($total);
                                
                              ?>
                                <h5 class="font-bold uppercase text-gray-600">Number of Therapists</h5>
                                <h3 class="font-bold text-3xl"><?php echo implode(" ",$total);?><span class="text-green-500"><i class="fas fa-users"></i></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                 <!--End of number of therapists card-->

                  <!--Number of patients-->
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                            <?php
                                $db  = new PDO('mysql:host=localhost;dbname=safehaven_db', 'root', '');
                                $Sql = "SELECT count(*) as `total` FROM user WHERE userType = 'patient'";
                                $stmt = $db->query($Sql);
                                $stmt->execute();
                                $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                //print_r($total);
                                
                              ?>
                                <h5 class="font-bold uppercase text-gray-600">Number of Therapists</h5>
                                <h3 class="font-bold text-3xl"><?php echo implode(" ",$total);?><span class="text-green-500"><i class="fas fa-users"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--End of number of patients card-->
                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-pencil-alt fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Community Posts</h5>
                                <h3 class="font-bold text-3xl">Unavailable</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
  </div>



</body>
<?php
  include "scripts.php";
  ?>

</html>