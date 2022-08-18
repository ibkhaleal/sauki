<?php
include 'config.php';
session_start();

if(empty($_SESSION['admin_id'])){
    header("location:login.php");
    ?>
    <script type="text/javascript">
        window.location.href="login.php";
    </script>
    <?php
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
    .container{
  position: absolute;
  top: -100%;
  left: 50%;
  transform: translate(-50%,-100%);
  background: #fff;
  padding: 20px;
  width: 100%;
  border-radius: 15px;
  max-width: 380px;
  opacity: 0;
  box-shadow: 0px 15px 25px rgba(51, 51, 51, 0.16);
  pointer-events: none;
  transition: all 0.3s ease;
}
.container .menu{
  display: flex;
  justify-content: space-between;
}
.menu .close{
  width: 30px;
  height: 30px;
  background: #ecf0f1;
  text-align: center;
  line-height: 30px;
  border-radius: 50px;
  color: #95a5a6;
  cursor: pointer;
}
.link{
  margin: 20px 0;
}
.link span{
  font-size: 18px;
}
.link .links{
  margin: 20px 0;
}
.box p{
  margin-bottom: 10px;
}
.box i.fa-link{
  color: #4267B2;
  padding-right: 10px;
}
.box input{
  max-width: 220px;
  width: 100%;
  height: 32px;
  border: 1px solid #ddd;
  padding: 0 10px;
  outline: none;
  color: #444;
  margin-right: 5px;
}
#pop:checked ~ .container{
  top: 50%;
  opacity: 1;
  pointer-events: auto;
}
#pop:checked ~ .modalbtn{
  opacity: 0;
}
.modalbtn{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  font-size: 18px;
  background: #fff;
  padding: 10px 20px;
  color: #4267B2;
  border-radius: 8px;
  transition: 0.3s ease;
  cursor: pointer;
  opacity: 1;
}
.modalbtn:hover{
  color: #0077B5;
}
input[type="checkbox"]{
  display: none;
}
.message {
  opacity: 0;
  transition: 0.5s;
}

.message.active {
  opacity: 1;
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
              <path d="M17.75 16H24V13.3333H17.75V16ZM0 0V2.66667H7.75V0H0ZM0 9.33333H24V6.66667H0V9.33333Z"
                fill="white" />
            </svg>
          </div>
          <img src="../../assets/user.png" alt="" class="w-10 h-10 rounded-full">
        </div>
        <p class="text-center font-bold text-2xl text-white mt-7">Generate Code</p>
      </div>
      <!-- <div
      class="bg-white rounded-lg p-3 px-5 space-y-1 flex text-sm flex-col mr-20 ml-5 absolute top-14 toggleMenu hidden"
      data-aos="zoom-in">
      <a class="font-bold" href="./check_booking.html">Check Booking</a>
      <a class="font-bold" href="./pay.html">Payments</a>
      <a class="font-bold" href="./profile_verification.html">Verify Profile</a>
      <a class="font-bold" href="./generate_code">Generate Code</a>
    </div> -->
    
    <div class="bg-white text-primary py-3 px-5 fixed bottom-0 inset-x-0 justify-between flex text-xs z-[44]">
      <a href="./admin_dashboard.html" class="text-center space-y-1">
          <i class="fa-solid fa-house-chimney-user"></i>
        <p>Home</p>
      </a>
      <a href="./check_booking.html" class="text-center space-y-1">
        <i class="fa-solid fa-boxes-stacked"></i>
        <p>Booking</p>
      </a>
      <a href="./pay.html" class="text-center space-y-1">
        <i class="fa-solid fa-money-bill"></i>
        <p>Payments</p>
      </a>
      <a href="./profile_verification.html" class="text-center space-y-1">
        <i class="fa-solid fa-id-badge"></i>
         <p>Profile</p>
       </a>
    </div>


    <div class="my-8 mx-10 relative py-12">
        <div class="grid-cols-2 gap-x-4 space-y-3 relative -top-10">
            <div class="flex gap-2 bg-white rounded text-primary shadow-xl text-center font-semibold py-0 px-4 space-y-3 text-xs">
            <div class="flex justify-between">
              <svg class="my-2" width="20" height="32" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path d="M512 64C547.3 64 576 92.65 576 128V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V128C0 92.65 28.65 64 64 64H512zM128 
                384C128 348.7 99.35 320 64 320V384H128zM64 192C99.35 192 128 163.3 128 128H64V192zM512 384V320C476.7 320 448 348.7 448 384H512zM512 
                128H448C448 163.3 476.7 192 512 192V128zM288 352C341 352 384 309 384 256C384 202.1 341 160 288 160C234.1 160 192 202.1 192 256C192 309 234.1
                 352 288 352z" fill="#189BCC"/>
              </svg>
            </div>
            <input id="inputVerifing" required class="input" type="search" placeholder="Enter Amount">
            </div>
            <div class="flex gap-2 bg-white rounded text-primary shadow-xl text-center font-semibold py-0 px-4 space-y-3 text-xs">
                <div class="flex justify-between">
                    <svg class="my-2" width="20" height="32" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M336 0h-288C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48v-416C384 21.49 362.5 0 336 0zM192 160c35.35
                         0 64 28.65 64 64s-28.65 64-64 64S128 259.3 128 224S156.7 160 192 160zM288 416H96c-8.836 0-16-7.164-16-16C80 355.8 115.8 320 160 320h64c44.18
                          0 80 35.82 80 80C304 408.8 296.8 416 288 416zM240 96h-96C135.2 96 128 88.84 128 80S135.2 64 144 64h96C248.8 64 256 71.16 256 80S248.8 96 
                          240 96z"fill="#189BCC"/>
                    </svg>
                   
                </div>
                <input id="inputVerifing" required class="input" type="search" placeholder="Enter ID">
            </div>
        </div>
    <input type="checkbox" name="" id="pop">
    <label for="pop" class="button text-center font-bold" type="sumbit">Generate</label>
  <div class="container">
    <div class="modal">
      <div class="menu">
        <span class="font-bold">Generate Code</span>
        <label for="pop" class="close"><i class="fa fa-close text-red-700"></i></label>
      </div>
      <div class="box">
        <div class="flex"><i class="fa fa-link"></i><input type="text" class="text" value="123*{}*{}" id="myInput"></div>
        <button type="button" class="button" onclick="myFunction()">Copy</button>
      </div>
    </div>
    </div>
  </div>
    </div>
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
    }
  </script>

</body>

</html>