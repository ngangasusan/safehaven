<?php
  session_start();
  require_once 'logic/procedures/login.procedure.php';

  if(!isset($_SESSION['email']))
  {
    header("location: index.php");
  }
  $userId = $_SESSION['email'];

  $select_stmt = $db->prepare ("SELECT * FROM user WHERE email=:email");
  $select_stmt->execute(array("email"=>$email));

  $row = $select_Stmt->fetch(PDO::FETCH_ASSOC);

  if(isset($_SESSION['email'])){
    ?>Welcome,<?php
      echo $row['email'];
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


    <!--Icon-->
    <link rel="icon" href="assets/img/logo.png" sizes="48x48" />
  </head>
  <body>
   <h1>Welcome <?php echo $login_session; ?></h1> 
    <!-- Navbar -->
    <nav
      class="
        flex flex-col
        sm:flex-row sm:justify-between
        p-2
        bg-white
        shadow-sm
        border-b
        items-center
      "
    >
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

        <!--User In Session-->
        
      </ul>
    </nav>

    <!--Body with image and details-->
    <div class="flex flex-col p-6">
        <img src="assets/img/therapySession.jpg" class=".bg-opacity-100" alt="Therapy Session">
    </div>
  </body>
</html>
