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

         <?php if (!isset($_SESSION['userId'])) {?>
        <!--Login-->
        <li>
            <a href="login.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Login</a>
        </li>

        <!--Register-->
        <li>
            <a href="register.php" class="text-gray-500 px-6 py-3 hover:bg-green-200 rounded-md text-sm">Sign Up</a>
        </li>
        <?php }?>

      </ul>
    </nav>