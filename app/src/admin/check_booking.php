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
    .table_wrap {
      width: 100%;
      margin: 0px auto 0;
    }

    .table_wrap ul li .item {
      display: flex;
      align-items: center;
      background: #fff;
      padding: 15px 0;
      height: 50px;
    }

    .table_wrap ul li .item .name,
    .table_wrap ul li .item .phone {
      width: 20%;
      padding: 0 15px;
    }

    .table_wrap ul li .item .status {
      width: 15%;
      padding: 0 15px;
    }

    .table_wrap ul li .item .issue {
      width: 45%;
      padding: 0 15px;
    }

    .table_wrap ul li .item .issue span,
    .table_wrap ul li .item .name span {
      width: 90%;
      display: inline-block;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .table_header ul li .item {
      border-bottom: 2px solid #eaeaea;
      font-weight: 600;
    }

    .table_body {
      height: 300px;
      overflow: auto;
    }

    .table_body ul li .item {
      border-bottom: 1px solid #efefef;
    }

    .table_body ul li .item .status span {
      padding: 5px 20px;
      border-radius: 25px;
      max-width: 115px;
      display: inline-block;
    }

    .table_body ul li .item .open {
      background: #e5edfa;
      color: #5a8ee4;
    }

    .table_body ul li .item .fixed {
      background: #cff1f0;
      color: #0dbeb6;
    }

    .table_body ul li .item .closed {
      background: #fedfe5;
      color: #ff89a0;
    }

    .table_body ul li .item .hold {
      background: #fff0db;
      color: #f59d39;
    }

    .table_body ul li .item .reopened {
      background: #d6f2ff;
      color: #29a5d8;
    }

    .table_body ul li .item .canceled {
      background: #ffdbd6;
      color: #e87060;
    }

    @media (max-width: 800px) {
      .wrapper {
        display: block;
      }

      .table_wrap .table_header .table_body ul .table_body li {
        display: block;
      }

      .table_wrap ul li {
        display: block;
        align-items: center;
        border-radius: 15px;
        opacity: 1;
        pointer-events: none;
        transition: all 0.3s ease;
        --tw-space-y-reverse: 0;
        margin-top: calc(0.75rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(0.75rem * var(--tw-space-y-reverse));
      }

      .table_wrap ul li .item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        --tw-space-x-reverse: 0;
        margin-right: calc(0.5rem * var(--tw-space-x-reverse));
        margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
        padding: 15px;

        /* width: 100%;
    border-radius: 15px;
    opacity: 1;
    pointer-events: none;
    transition: all 0.3s ease; */
      }

      .table_header {
        display: none;
      }

      .table_wrap ul li .item .name {
        width: 53%;
        padding: 0 15px;
      }

      .table_wrap ul li .item .phone {
        width: 39%;
        padding: 0 15px;
      }

      .table_wrap ul li .item .status {
        width: 39%;
        padding: 0 15px;
      }

      .table_wrap ul li .item .issue {
        width: 60%;
        padding: 0 15px;
      }

    }

    li {
      list-style: none;
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

  <div>
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
      <p class="text-center font-bold text-2xl text-white mt-7">Check Booking</p>
    </div>
    <div
      class="bg-white rounded-lg p-3 px-5 space-y-1 flex text-sm flex-col mr-20 ml-5 absolute top-14 toggleMenu hidden"
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



    <div class="my-0 mx-10 md:mx-20 relative py-0">
      <div class="grid-cols-2 gap-x-4 relative -top-10">
        <div
          class="flex gap-2 bg-white rounded-3xl text-primary shadow-xl text-center font-semibold py-0 px-4 space-y-3 text-xs">
          <div class="flex justify-between">
            <button onclick="filer_act()"><svg class="my-2" width="15" height="32" fill="none" xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512">
              <path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 
                  1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236
                    144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 
                    208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z 
                    " fill="#189BCC" />
            </svg>
            Search
      </button>
          </div>
          <input class="input" type="text" id="search_input" placeholder="Fliter Table Using phone number">
        </div>
      </div>
    </div>
    <div class="table_wrap mx-5 ">
      <div class="table_header">
        <ul>
          <li>
            <div class="item">
              <div class="name">
                <span>NAME</span>
              </div>
              <div class="phone">
                <span>PHONE</span>
              </div>
              <div class="issue">
                <span>ISSUE</span>
              </div>
              <div class="status">
                <span>STATUS</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="table_body" id="result">
    <?php
        $hid=$_SESSION['admin_id'];
       $select = "SELECT * FROM appointments WHERE hospitalid = '$hid'";
       $selected = mysqli_query($conn,$select);
       while($data = mysqli_fetch_array($selected)){
           $phone = $data['userid'];
           $date = $data['datetime'];
   
           $get = "SELECT * FROM users WHERE phone = '".$phone."'";
           $got = mysqli_query($conn,$get);
           $data1 = mysqli_fetch_array($got);
            $name = $data1['fullname'];
           echo '
           <ul>
           <li>
             <div class="item">
               <div class="name">
                 <span>'.$name.'</span>
               </div>
               <div class="phone">
                 <span>'.$phone.'</span>
               </div>

               <div class="date">
               <span>'.$date.'</span>
             </div>
             </div>
              
           ';
       }
    ?>
     </div>
      <!-- <div>
    <div class="overflow-auto mx-10 rounded-lg shadow flex justify-center items-center hidden md:block">
      <table class="table_wrap items-center w-full relative justify-center">
          <thead class="table_header bg-gray-50 border-b-2 border-gray-200">
              <tr class="item">
                    <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left">ID</th>
                    <th class="w-30 p-3 text-sm font-semibold tracking-wide text-left name"><span>Name</span></th>
                    <th class="w-30 p-3 text-sm font-semibold tracking-wide text-left">Time</th>
                    <th class="w-30 p-3 text-sm font-semibold tracking-wide text-left">Date</th>
              </tr>
          </thead>
          <tbody class="table_body divide-y divide-gray-100">
              <tr class="item bg-white">
                <td class="font-bold text-primary hover:underline text-center number"><a href="#">08146809277</a></td>
                <td class="name p-3 text-sm text-gray-700 whitespace-nowrap"><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-yellow-200 rounded-lg bg-opacity-50">Isaac</span></td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">3:00pm</td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">07/07/2022</td>
              </tr>
              <tr class="item bg-white">
                <td class="font-bold text-primary hover:underline text-center number"><a href="#">08146809277</a></td>
                <td class="name p-3 text-sm text-gray-700 whitespace-nowrap"><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-yellow-200 rounded-lg bg-opacity-50">Mayo</span></td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">3:00pm</td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">07/07/2022</td>
              </tr>
              <tr class="item bg-white">
                <td class="font-bold text-primary hover:underline text-center number"><a href="#">08146809277</a></td>
                <td class="name p-3 text-sm text-gray-700 whitespace-nowrap"><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-yellow-200 rounded-lg bg-opacity-50"> Ola</span></td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">3:00pm</td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">07/07/2022</td>
              </tr>
              <tr class="item bg-white">
                <td class="font-bold text-primary hover:underline text-center number"><a href="#">08146809277</a></td>
                <td class="name p-3 text-sm text-gray-700 whitespace-nowrap"><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-yellow-200 rounded-lg bg-opacity-50">Sam</span></td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">3:00pm</td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">07/07/2022</td>
              </tr>
              <tr class="item bg-white">
                <td class="font-bold text-primary hover:underline text-center number"><a href="#">08146809277</a></td>
                <td class="name p-3 text-sm text-gray-700 whitespace-nowrap"><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-yellow-200 rounded-lg bg-opacity-50">Okomayin</span></td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">3:00pm</td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">07/07/2022</td>
              </tr>
          </tbody>
      </table>
     </div>
     <div class="grid grid-cols-auto gap-3 mx-5 md:hidden py-5 overflow-scroll" data-fliter-control="true" data-show-search-clear-button="true">
      <div  id="content" class="bg-white p-4 space-y-3 shadow rounded-lg">
          <div class="flex items-center space-x-2 text-medium">
              <div><a href="" class="text-blue-500 font-bold hover:underline number">08146908277</a></div>
              <div><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-green-300 rounded-lg bg-opacity-50">Okomayin Onaivi</span></div>
          </div>
         <div class="flex space-x-2 text-bold">
          <div class="text-gray-500 font-bold">07/07/2022</div>
          <div class="text-sm text-gray-700 time">3:00pm</div>
         </div>
      </div>
      <div id="content" class="bg-white p-4 space-y-3 shadow rounded-lg">
          <div class="flex items-center space-x-2 text-sm">
            <div><a href="" class="text-blue-500 font-bold hover:underline number">08946908277</a></div>
              <div><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-green-300 rounded-lg bg-opacity-50">mayowa sunisi</span></div>
          </div>
          <div class="flex space-x-2 text-bold">
            <div class="text-gray-500 font-bold">07/07/2022</div>
            <div class="text-sm text-gray-700 time">3:00pm</div>
           </div>
      </div>
      <div id="content" class="bg-white p-4 space-y-3 shadow rounded-lg">
          <div class="flex items-center space-x-2 text-sm">
              <div><a href="" class="text-blue-500 font-bold hover:underline number">09046908277</a></div>
              
              <div><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-green-300 rounded-lg bg-opacity-50">samuel agbo</span></div>
          </div>
          <div class="flex space-x-2 text-bold">
            <div class="text-gray-500 font-bold">07/07/2022</div>
            <div class="text-sm text-gray-700 time">3:00pm</div>
           </div>
      </div>
      <div id="content" class="bg-white p-4 space-y-3 shadow rounded-lg">
          <div class="flex items-center space-x-2 text-sm">
            <div><a href="" class="text-blue-500 font-bold hover:underline number">07046908277</a></div>
              
              <div><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-green-300 rounded-lg bg-opacity-50">john agbo</span></div>
          </div>
          <div class="flex space-x-2 text-bold">
            <div class="text-gray-500 font-bold">07/07/2022</div>
            <div class="text-sm text-gray-700 time">3:00pm</div>
           </div>
      </div>
      <div id="content" class="bg-white p-4 space-y-3 shadow rounded-lg">
          <div class="flex items-center space-x-2 text-sm">
            <div><a href="" class="text-blue-500 font-bold hover:underline number">08046908277</a></div>
            
              <div><span class="p-1.5 text-xs font-medium uppercase tracking-wide bg-green-300 rounded-lg bg-opacity-50">phillip john</span></div>
          </div>
          <div class="flex space-x-2 text-bold">
            <div class="text-gray-500 font-bold">07/07/2022</div>
            <div class="text-sm text-gray-700 time">3:00pm</div>
           </div>
      </div>
     </div>
   </div> -->
    </div>

    <div class="table_wrap mx-5 overflow-x-auto md:mx-20 md:block hidden">
      <div class="mx-0 md:mx-20 overflow-x-auto">
        <div class="table_header">
          <ul>
            <li>
              <div class="item">
                <div class="name">
                  <span>NAME</span>
                </div>
                <div class="phone">
                  <span>PHONE</span>
                </div>
                <div class="issue">
                  <span>ISSUE</span>
                </div>
                <div class="status">
                  <span>Time</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="table_body">
          <ul>
            <li>
              <div class="item">
                <div class="name">
                  <span>Alex</span>
                </div>
                <div class="phone">
                  <span>091625484744</span>
                </div>


                <div class="issue">
                  <span>Lorem ipsum dolor sit amet.</span>
                </div>
                <div class="status">
                  <span class="open">04:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Max Johnson</span>
                </div>
                <div class="phone">
                  <span>09467956848</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum dolor sit amet consectetur adipisicing.</span>
                </div>
                <div class="status">
                  <span class="reopened">06:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Rosey</span>
                </div>
                <div class="phone">
                  <span>08146908277</span>
                </div>

                <div class="issue">
                  <span>Lorem ipsum dolor sit amet consectetur.</span>
                </div>
                <div class="status">
                  <span class="closed">05:25pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>John</span>
                </div>
                <div class="phone">
                  <span>07058484379</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum.</span>
                </div>
                <div class="status">
                  <span class="hold">12:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Max Johnson</span>
                </div>
                <div class="phone">
                  <span>09061858947</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum dolor sit amet consectetur adipisicing.</span>
                </div>
                <div class="status">
                  <span class="open">11:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Sarah Glenn</span>
                </div>
                <div class="phone">
                  <span>+1 111 222 333</span>
                </div>

                <div class="issue">
                  <span>Lorem ipsum dolor sit amet.</span>
                </div>
                <div class="status">
                  <span class="open">10:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Hayley Matthews</span>
                </div>
                <div class="phone">
                  <span>+1 331 442 436</span>
                </div>

                <div class="issue">
                  <span>Lorem ipsum dolor sit.</span>
                </div>
                <div class="status">
                  <span class="canceled">09:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Sarah Glenn</span>
                </div>
                <div class="phone">
                  <span>+1 111 222 333</span>
                </div>

                <div class="issue">
                  <span>Lorem ipsum dolor sit amet.</span>
                </div>
                <div class="status">
                  <span class="open">08:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>John</span>
                </div>
                <div class="phone">
                  <span>+1 331 442 436</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum.</span>
                </div>
                <div class="status">
                  <span class="hold">07:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Kate Cross</span>
                </div>
                <div class="phone">
                  <span>+1 341 242 336</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum dolor.</span>
                </div>
                <div class="status">
                  <span class="fixed">06:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Jake Lehmann</span>
                </div>
                <div class="phone">
                  <span>+1 331 442 436</span>
                </div>

                <div class="issue">
                  <span>Lorem ipsum dolor sit amet consectetur.</span>
                </div>
                <div class="status">
                  <span class="closed">01:45pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Richard Gleeson</span>
                </div>
                <div class="phone">
                  <span>+1 331 442 436</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum.</span>
                </div>
                <div class="status">
                  <span class="hold">05:25pm</span>
                </div>
              </div>
            </li>
            <li>
              <div class="item">
                <div class="name">
                  <span>Oliver Robinson</span>
                </div>
                <div class="phone">
                  <span>+1 331 442 436</span>
                </div>

                <div class="issue">
                  <span>Lorem, ipsum dolor sit amet consectetur adipisicing.</span>
                </div>
                <div class="status">
                  <span class="reopened">02:45pm</span>
                </div>
              </div>
            </li>
          </ul>
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
      var search_input = document.querySelector("#search_input");

      search_input.addEventListener("keyup", function (e) {
        var span_items = document.querySelectorAll(".table_body .phone span");
        var table_body = document.querySelector(".table_body ul");
        var search_item = e.target.value.toLowerCase();

        span_items.forEach(function (item) {
          if (item.textContent.toLowerCase().indexOf(search_item) != -1) {
            item.closest("li").style.display = "block";
          }
          else {
            item.closest("li").style.display = "none";
          }
        })

      });

      function filer_act(){
      var num = document.getElementById('search_input').value;
        var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("result").innerHTML =
      this.responseText;
     }
   };
   xhttp.open("POST", "get_booking.php?phone="+num, true);
   xhttp.send();
      }
    </script>


</body>

</html>