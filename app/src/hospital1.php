<?php
include_once('config.php');
session_start();
$phoneid =  $_SESSION["idno"];
$hcode = $_GET['hcode'];

if(isset($_POST['book'])){
   $appDate = $_POST['app-date'];
   $insert = "INSERT INTO appointments(userid,hospitalid,datetime)VALUES('$phoneid','$hcode','$appDate')";
   $inserted = mysqli_query($link,$insert);

   if($inserted){
     $no = rand(1,100); 
     $booked = '<div class="suc bg-green-100 text-green-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10">Your appointment has been placed!
      you are number <span style="color:red;font-size:50px;">'.$no.'</span> on the list</div>';
   }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../assets/sauki.png" />
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

  <!-- splide -->
  <link rel="stylesheet" href="../splide-4.0.7/dist/css/splide.min.css">


  <title>Sauki Healthcare</title>

  <link rel="stylesheet" href="../dist/output.css">


  <style>
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
    <div class="h-44 bg-primary rounded-b-[30%] px-7">
      <div class="flex items-center py-5 mb-5 justify-between">
        <div onclick="toggle()" class="toggleBtn">
          <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.75 16H24V13.3333H17.75V16ZM0 0V2.66667H7.75V0H0ZM0 9.33333H24V6.66667H0V9.33333Z"
              fill="white" />
          </svg>
        </div>
        <img src="../assets/user.png" alt="" class="w-10 h-10 rounded-full">
      </div>
      <p class="text-center font-bold text-xl text-white mt-7">Schedule an Appointment</p>
    </div>
    <div
      class="bg-white rounded-lg p-3 px-5 space-y-3 flex text-sm flex-col mr-20 ml-5 absolute top-14 toggleMenu hidden"
      data-aos="zoom-in">
      <a href="./dashboard.php">Appointment</a>
      <a href="./payments.php">Payments</a>
      <a href="./insurance.php">Insurance</a>
    </div>

    <!-- Buttom Navigation -->
    <div class="bg-white text-primary py-3 px-5 fixed bottom-0 inset-x-0 justify-between flex text-xs z-[44]">
      <a href="./appointment.php" class="text-center space-y-1">
        <i class="fa-regular fa-calendar fa-xl"></i>
        <p>Appointment</p>
      </a>
      <a href="./payments.php" class="text-center space-y-1">
        <i class="fa-solid fa-money-bill fa-xl"></i>
        <p>Payments</p>
      </a>
      <a href="./insurance.php" class="text-center space-y-1">
        <i class="fa-solid fa-house-medical-circle-check fa-xl"></i>
        <p>Insurance</p>
      </a>
    </div>

    <div class="my-5 mx-5 relative pb-12">
      <div class="grid grid-cols-2 gap-x-4 relative -top-10">
        <a href="./appointment.php">
          <div class="bg-white rounded text-primary shadow-xl text-center font-semibold py-2 px-4 space-y-3 text-xs">
            <div class="flex justify-center">
              <svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M13.02 11.985C13.077 11.275 13.262 10.601 13.551 9.98499H6V12.466L10 15.496V42.016H38V15.531L42.5 12.501V9.98399H24.449C24.739 10.6 24.923 11.274 24.981 11.984H39.687L36 14.468V40.015H12V14.503L8.676 11.985H13.019H13.02Z"
                  fill="#189BCC" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M20 26H16V30H20V26ZM14 24V32H22V24H14ZM32 26H26V40H32V26ZM24 24V42H34V24H24Z" fill="#189BCC" />
                <path
                  d="M6 41C6 41.2652 6.10536 41.5196 6.29289 41.7071C6.48043 41.8946 6.73478 42 7 42H41C41.2652 42 41.5196 41.8946 41.7071 41.7071C41.8946 41.5196 42 41.2652 42 41C42 40.7348 41.8946 40.4804 41.7071 40.2929C41.5196 40.1054 41.2652 40 41 40H7C6.73478 40 6.48043 40.1054 6.29289 40.2929C6.10536 40.4804 6 40.7348 6 41Z"
                  fill="#189BCC" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 16H10V14H15V16ZM37.5 16H23V14H37.5V16Z"
                  fill="#189BCC" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M25 12C25 12.7879 24.8448 13.5681 24.5433 14.2961C24.2417 15.0241 23.7998 15.6855 23.2426 16.2426C22.6855 16.7998 22.0241 17.2417 21.2961 17.5433C20.5681 17.8448 19.7879 18 19 18C18.2121 18 17.4319 17.8448 16.7039 17.5433C15.9759 17.2417 15.3145 16.7998 14.7574 16.2426C14.2002 15.6855 13.7583 15.0241 13.4567 14.2961C13.1552 13.5681 13 12.7879 13 12C13 10.4087 13.6321 8.88258 14.7574 7.75736C15.8826 6.63214 17.4087 6 19 6C20.5913 6 22.1174 6.63214 23.2426 7.75736C24.3679 8.88258 25 10.4087 25 12ZM20 9V11H22V13H20V15H18V13H16V11H18V9H20Z"
                  fill="#189BCC" />
              </svg>


            </div>
            <p>New Appointment</p>
          </div>
        </a>
        <a href="./appointment-history.php">
          <div class="bg-white rounded text-primary text-center font-semibold py-2 px-4 space-y-3 text-xs">
            <div class="flex justify-center">
              <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M20.9413 10.6641H19.0624C18.8905 10.6641 18.7499 10.8047 18.7499 10.9766V21.7305C18.7499 21.832 18.7968 21.9258 18.8788 21.9844L25.3358 26.6992C25.4764 26.8008 25.6718 26.7734 25.7733 26.6328L26.8905 25.1094C26.996 24.9648 26.9647 24.7695 26.8241 24.6719L21.2538 20.6445V10.9766C21.2538 10.8047 21.1132 10.6641 20.9413 10.6641ZM29.5272 13.6016L35.6522 15.0977C35.8475 15.1445 36.0389 14.9961 36.0389 14.7969L36.0702 8.48829C36.0702 8.22657 35.7694 8.07813 35.5663 8.24219L29.41 13.0508C29.3635 13.0868 29.3281 13.1352 29.3078 13.1904C29.2876 13.2456 29.2834 13.3055 29.2956 13.363C29.3078 13.4205 29.3361 13.4734 29.377 13.5156C29.418 13.5579 29.4701 13.5876 29.5272 13.6016ZM36.078 25.3633L33.8632 24.6016C33.7859 24.5751 33.7014 24.5799 33.6277 24.6149C33.554 24.65 33.4969 24.7125 33.4686 24.7891C33.3944 24.9883 33.3163 25.1836 33.2343 25.3789C32.5389 27.0234 31.5429 28.5039 30.2694 29.7734C29.0101 31.0367 27.5177 32.0435 25.8749 32.7383C24.173 33.4578 22.3437 33.8271 20.496 33.8242C18.6288 33.8242 16.8202 33.4609 15.1171 32.7383C13.4743 32.0435 11.9818 31.0367 10.7225 29.7734C9.45302 28.5039 8.45692 27.0234 7.7577 25.3789C7.04214 23.6761 6.67553 21.847 6.67958 20C6.67958 18.1328 7.04286 16.3203 7.76552 14.6172C8.46083 12.9727 9.45692 11.4922 10.7304 10.2227C11.9897 8.95946 13.4821 7.95257 15.1249 7.25782C16.8202 6.53516 18.6327 6.17188 20.4999 6.17188C22.3671 6.17188 24.1757 6.53516 25.8788 7.25782C27.5216 7.95257 29.014 8.95946 30.2733 10.2227C30.6718 10.625 31.0468 11.043 31.3905 11.4844L33.7265 9.65626C30.6522 5.72657 25.8671 3.19922 20.4921 3.20313C11.1327 3.20704 3.61708 10.8086 3.71083 20.1719C3.80458 29.3711 11.285 36.7969 20.4999 36.7969C27.746 36.7969 33.9179 32.2031 36.2694 25.7695C36.328 25.6055 36.2421 25.4219 36.078 25.3633Z"
                  fill="#189BCC" />
              </svg>
            </div>
            <p>Appointment History</p>
          </div>
        </a>
      </div>
      <?php
        $details="SELECT * FROM hospitals WHERE hcode = '$hcode'";
        $result2 = $link->query($details);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $hname = $row2["hname"];
                }
        }
        ?>
      <p class="text-center font-semibold text-sm pb-4"><?php echo $hname ?></p>
<div><?php if(isset($booked)){ echo $booked;}?></div>
      <div class="mb-10">
        <p style="color:blue;text-align:center;">please select the date you want your appointment!</p>
        <form action="" method="POST" class="space-y-5">
          <div>
            <label for="date" class="font-semibold">Date</label>
            <input type="date" name="app-date" class="input">
          </div>
        
      </div>
        <button type="submit" class="button" name="book">Continue</button>
    </div>
    </form>

  </div>









  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="../splide-4.0.7/dist/js/splide.min.js"></script>

  <script src="../script.js"></script>


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

</body>

</html>