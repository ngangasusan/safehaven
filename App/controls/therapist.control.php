<?php
 session_start();
 
    require_once "../classloader.inc.php";
    $dbmanager = New DbManager();
    include "../delete.php";

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
  <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> 


  <!--Icon-->
  <!--<link rel="icon" href="assets/img/logo.png" sizes="48x48" />-->
  <link rel="icon" href="../assets/img/logo.png" sizes="48x48" />
</head>

<body>
  <?php
  $firstname = "";
  $lastname = "";
  $email = "";
  $phoneNumber = "";
  $hospital = "";
  $specialty = "";

  //dependent on who is logged in
  $labelText = "Therapist Details";
  $buttonText = "Book Appointment";

  //actions that can be performed
  $action = "v";
  
  //set Id to the therapist one wants to see the profile
  //$id = ;

  //fetch the therapists profile
  $therapistInfo = $dbmanager->query(DbManager::USER_TABLE,["*"],"userId = ?", [$id]);

  ?>
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
          <img src="../assets/img/logo.png" alt="logo" class="w-10 sm:w-20 mr-6" />
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
              text-gray-500
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
            ">Analytics</a>
      </li>

      <!--Patient-->
      <li>
        <a href="./patient.control.php" class="
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
        <a href="therapist.control.php" class="
              text-green-300
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
        <a href="community.control.php" class="
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

  <!--Button for adding users-->
  <div>
    <a href="../therapistProfile.php"><i class="fas fa-user-plus p-6"><span><button>Add User</button></span></i></a>
      
      <!--<button>Add User</button>-->
  </div>
  
  <!--Table with user details-->
  <div class="container flex justify-center mx-auto">
    <div class="flex flex-col">
        <div class="w-full">
            <div class="border-b border-gray-200 shadow p-6">
                <table>
                <thead class="bg-gray-50">
                  <tr>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          User ID
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          First Name
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          Last Name
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          Email Address
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          Field
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                          Hospital
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Phone Number
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Type
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Edit
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Delete
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Disable
                      </th>
                  </tr>
                    <tbody class="bg-white">
                    <?php
                        foreach($tabledata as $row){?>
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <?php echo $row['userId']?>
                            </td>
                            <td class="px-6 py-4">
                              <div class="text-sm text-gray-900">
                                <?php echo $row['firstname']?>
                              </div>
                            </td>
                            <td class="px-6 py-4">
                              <div class="text-sm text-gray-900">
                                <?php echo $row['lastname']?>
                              </div>
                            </td>
                            <td class="px-6 py-4">
                              <?php echo $row['email']?>
                            </td>
                            <!--Field-->
                            <td class="px-6 py-4">                       
                            </td>
                            <!--Hospital-->
                            <td class="px-6 py-4">
                            </td>
                            <!--phone number-->
                            <td class="px-6 py-4">
                              <?php echo $row['phonenumber']?>
                            </td>
                            <!--UserType-->
                            <td class="px-6 py-4">
                              <?php echo $row['userType']?>
                            </td>
                            <td class="px-6 py-4">
                              <a href='<?PHP echo "../register.php?edit=" . $row['userId']; ?>'><i class="fas fa-edit"></i></a>
                            </td>
                            <td class="px-6 py-4">
                              <a href='<?PHP echo $_SERVER['PHP_SELF'] . "?delete=" . $row['userId']; ?>'><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <!--Disable user-->
                            <td>
                              <a href=""><i class="fas fa-user-slash"></i></a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>
</body>

</html>