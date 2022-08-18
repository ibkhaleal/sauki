<?php
include_once('../config.php');

if(isset($_POST['verify'])){
  $phone = $_POST['phoneno'];

  $select = "SELECT * FROM users WHERE phone = '".$phone."'";
  $selected = mysqli_query($link,$select);
  $data = mysqli_fetch_array($selected);
  $name = $data['fullname'];
  $phone = $data['phone'];
  $id = $data['phone'];
  echo '
  <!-- Main modal -->
  <div style="z-index: 5;" id="defaultModal" tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true bg-blue" role="dialog">
      <div class="relative p-4 w-full max-w-2xl h-full md:h-auto style="background:white!important;"">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" style="    box-shadow: 0px 0px 5px white;
          width: 49%;
          margin: -10px auto;">
              <!-- Modal header -->
              <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      User Profile
                  </h3>
                 
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-6">
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400" style="margin: 0px 15px;">
                  Name: '.$name.'
                  </p>

                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"  style="margin: 0px 15px;">
                  Phone number: '.$phone.'
                  </p>

                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"  style="margin: 0px 15px;">
                 Id: '.$id.'
                  </p>
              </div>

          </div>
      </div>
  </div>
  ';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../../assets/sauki.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">


  <!-- Varela Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">





  <title>Sauki Healthcare</title>

  <link rel="stylesheet" href="../../dist/output.css">


  <style>
    .container {
      position: absolute;
      top: -100%;
      left: 50%;
      transform: translate(-50%, -65%);
      background: #fff;
      padding: 25px;
      width: 100%;
      border-radius: 15px;
      max-width: 380px;
      opacity: 0;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    .container .menu {
      display: flex;
      justify-content: space-between;
    }

    .menu .text {
      font-size: 22px;
      font-weight: 600;
    }

    .menu .close {
      width: 30px;
      height: 30px;
      background: #ecf0f1;
      text-align: center;
      line-height: 30px;
      border-radius: 50px;
      color: #95a5a6;
      cursor: pointer;
    }

    #pop:checked~.container {
      top: 50%;
      opacity: 1;
      pointer-events: auto;
    }

    #pop:checked~.modalbtn {
      opacity: 0;
    }

    input[type="checkbox"] {
      display: none;
    }

    .message {
      opacity: 0;
      transition: 0.5s;
    }

    .message.active {
      opacity: 1;
    }

    .link {
      margin: 20px 0;
    }

    .link span {
      font-size: 18px;
    }

    .hide {
      display: none;
    }

    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-track {
      box-shadow: inset 20px 4px 10px #f3eee7;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
      background: #189BCC;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #fff;
    }
  </style>
</head>

<body class="bg-[#e0e0e0] font-raleway">
  <div class="h-48 bg-primary rounded-b-[30%] px-7">
    <div class="flex items-center py-5 mb-5 justify-between">
      <div onclick="toggle()" class="toggleBtn">
        <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.75 16H24V13.3333H17.75V16ZM0 0V2.66667H7.75V0H0ZM0 9.33333H24V6.66667H0V9.33333Z" fill="white" />
        </svg>
      </div>
      <img src="../../assets/user.png" alt="" class="w-10 h-10 rounded-full">
    </div>
    <p class="text-center font-bold text-2xl text-white mt-7">Profile Verification</p>
  </div>
  <div class="bg-white rounded-lg p-3 px-5 space-y-1 flex text-sm flex-col mr-20 ml-5 absolute top-14 toggleMenu hidden"
    data-aos="zoom-in">
    <a class="" href="./admin_dashboard.php">Admin Dashboard</a>
    <a class="" href="./check_booking.php">Check Booking</a>
    <a class="" href="./pay.php">Payments</a>
    <a class="" href="./profile_verification.php">Verify Profile</a>
  </div>

  <div class="bg-white text-primary py-3 px-5 fixed bottom-0 inset-x-0 justify-between flex text-xs z-[44] md:hidden">
    <a href="./admin_dashboard.php" class="text-center space-y-1">
      <i class="fa-solid fa-house-chimney-user"></i>
      <p>Home</p>
    </a>
    <a href="./check_booking.php" class="text-center space-y-1">
      <i class="fa-solid fa-boxes-stacked"></i>
      <p>Booking</p>
    </a>
    <a href="./pay.php" class="text-center space-y-1">
      <i class="fa-solid fa-money-bill"></i>
      <p>Payments</p>
    </a>
    <a href="./profile_verification.php" class="text-center space-y-1">
      <i class="fa-solid fa-id-badge"></i>
      <p>Profile</p>
    </a>
  </div>

  <div class="my-8 mx-10 md:mx-96 relative py-12">
    <div class="grid-cols-2 gap-x-4 relative -top-10">
      <div
        class="flex gap-2 bg-white rounded text-primary shadow-xl text-center font-semibold py-0 px-4 space-y-3 text-xs">
        <div class="flex justify-between">
          <svg class="my-2" width="20" height="32" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path d="M336 0h-288C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48v-416C384 21.49 362.5 0 336 0zM192 160c35.35
                     0 64 28.65 64 64s-28.65 64-64 64S128 259.3 128 224S156.7 160 192 160zM288 416H96c-8.836 0-16-7.164-16-16C80 355.8 115.8 320 160 320h64c44.18
                      0 80 35.82 80 80C304 408.8 296.8 416 288 416zM240 96h-96C135.2 96 128 88.84 128 80S135.2 64 144 64h96C248.8 64 256 71.16 256 80S248.8 96 
                      240 96z" fill="#189BCC" />
          </svg>
        </div>
        <form action="" method="POST">
        <input  id="inputVerifing" required name="phoneno" class="input" type="search" placeholder="Enter Phone number"/>
      </div>
    </div>

    <input type="submit" style="cursor:pointer!important;" name="verify" class="button text-center font-bold" value="verify"/>
  </form>
    <div id="show"></div>
   

  </div>








  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


  <script src="../../script.js"></script>


  <script>

    AOS.init({
      duration: 800,
      delay: 400
    });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
  <script>
    var popoverTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new Popover(popoverTriggerEl);
    });
  </script>

  <script>
    new Splide('.splide').mount();
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var splide = new Splide('.splide');
      splide.mount();
    });
  </script>
  <script>
    function myFunction() {
      var copyText = document.getElementById("myInput");
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }


  </script>

</body>

</html>