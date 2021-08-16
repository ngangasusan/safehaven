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
              text-green-200
              px-6
              py-3
              hover:bg-green-200
              rounded-md
              text-sm
              font-bold
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
    
<div class="flex flex-row items-center font-sans w-full sm:w-8/12 px-12 py-4 mx-auto m-1 justify-end">
        <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
            <img src="storage/images/larry.jpeg" alt="" class="h-full w-full object-cover">
        </div>
        <div class="flex flex-col text-xs text-gray-500">
            <span class="font-semibold">Susan Ng'ang'a</span>
            <span class="">August 5, 2020</span>
        </div>
    </div>
    <div class="w-full sm:w-7/12 p-6 text-lg prose lg:prose-2xl font-serif mx-auto m-1">
        <h2>My Story</h2>
        <div id="output">
        </div>
    </div>
    
    <div class="flex flex-row items-center justify-evenly sm:flex-col sm:fixed sm:top-2/4 sm:left-10">
        <div class="flex flex-row items-center text-red-500 mb-2 sm:mb-4">
           
        </div>

        <div class="flex flex-row items-center mb-2">
            <span class="trigger w-12 border rounded-full p-2 inline-flex items-center justify-center mr-2">
                <img src="assets/img/conversation.svg" class="w-10" alt="">
            </span>
            
            <span class="text-gray-500 text-sm" id="num-comments"></span>
        </div>
    </div>

    <input type="text" name="article-id" id="article-id"  hidden/>
    <input type="text" name="firstname" id="firstname"  hidden/>
    <input type="text" name="lastname" id="lastname" hidden/>


    <!-- Modal -->
    <div class="modal overflow-hidden">
            <div
                class="modal-content flex flex-col sm:flex bg-gray-50 rounded-md w-10/12 sm:w-6/12 sm:mx-auto sm:mt-6 shadow mb-10 p-1 overflow-hidden"
            >
                 <!--Header-->
                 <div class="flex flex-col">
                    <div class="flex justify-between p-2 items-center">
                        <div class="mx-2 my-1 py-1 px-2 text-gray-500 text-lg">Comments</div>
                        <div class="flex justify-center items-center rounded-full hover:bg-gray-200 mx-2 my-1 px-2 py-2">
                            <span class="text-gray-500 close-button flex justify-center items-center my-auto">&times;</span>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col">
                        <div class="mb-1 flex flex-row justify-end">
                            <button class="rounded text-white bg-blue-500 py-2 px-4 text-xs font-bold" id="post-btn">Post</button>
                        </div>
                        <textarea name="comment-input" id="comment-input" class="border focus:outline-none resize-none rounded p-4 h-15 w-full text-gray-500 text-sm" placeholder="Write comment here.."></textarea>
                    </div>
                 </div>

                <!--Body-->
                <div class="overflow-y-scroll w-full flex flex-col h-80" id="comments">

                    <div class="flex flex-row text-gray-500 p-4 w-full justify-center">
                        <div class="mx-2">
                            <div class="w-10 h-10 rounded-full overflow-hidden">
                                <img src="../App/assets/img/tempusers/therapist1.jpg" alt="" class="h-full w-full object-cover">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col sm:flex-row sm:items-center text-sm mb-1">
                                <span class="pr-1">Sophie Grace</span>
                                <span class="mr-1 w-1 h-1 bg-gray-500 rounded-full hidden sm:inline"></span>
                                <span class="text-xs">9 April, 2020 2:22</span>
                            </div>
                            <div class="text-xs ml-2"> I have come to realise that, more often than not lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus ultricies tristique nulla aliquet. Maecenas volutpat blandit aliquam etiam erat velit scelerisque in dictum.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php
  include "scripts.php";
  ?>

</html>