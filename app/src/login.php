<?php
    include_once('config.php');
    
    // Initialize the session
    session_start();
     
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: dashboard.php");
        exit;
    }


    if(isset($_POST['otpget'])){
        $phone = $_POST['phone'];
        $phone=$phone;
        $phone=ltrim($phone, "+2340");
        $phone="+234".$phone;
        if(empty($phone)){
            echo '<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> Phone number field is empty</div>';
        }else{
        $checkuser = "SELECT COUNT(phone) FROM users WHERE phone = $phone";
        $checkeduser = mysqli_query($link,$checkuser);
        $data = mysqli_fetch_array($checkeduser);
        
        if($data[0] == 0){
            echo '<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> sorry you are not registered with sauki health care, please register</div>';
        }else{
               $_SESSION["phone"] = $phone;
            echo '<div class="suc bg-green-100 text-green-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> Your otp is 1234</div>';
        }
     }
    }
    
    if(isset($_POST['login'])){
        $otp1 = $_POST['otp1'];
        $otp2 = $_POST['otp2'];
        $otp3 = $_POST['otp3'];
        $otp4 = $_POST['otp4'];
        
        if(empty($otp1) || empty($otp2) || empty($otp3) || empty($otp4)){
            echo '<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> otp field is empty</div>';
        }else{
            if($otp1 != 1){
                echo'<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> incorrect otp</div>';
            }else{
                if($otp2 != 2){
                echo'<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> incorrect otp</div>';
            }else{
                if($otp3 != 3){
                echo'<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> incorrect otp</div>';
            }else{
                if($otp4 != 4){
                echo'<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> incorrect otp</div>';
                }else{
                    
                            // Store data in session variables
                            $phone = $_SESSION["phone"];
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idno"] = $phone;
                            echo'<div class="suc bg-green-100 text-green-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10">Access granted! redirecting to dashboard..</div>';
                            // header('refresh:2 url=dashboard.php');
                             ?>
            <script>window.location.replace('dashboard.php')</script>
            <?php
                }
               }
             }
            }
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">


  <!-- Varela Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
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

<body class="bg-white font-raleway">
  <div class="md:grid grid-cols-2">
    <div class="md:mx-32 mx-7 md:my-24 py-7">
      <h1 class="text-left text-gray-900 font-bold text-2xl pb-3">Sign In</h1>
      <p class="text-sm">If you don't have an account registered, you can <a href="./signup.php"
          class="text-primary underline decoration-primary">Sign Up here!</a></p>

      <div class="my-5">
        <form action="" method="POST" class="space-y-5">
          <div>
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
            <button class="button" type="submit" name="otpget">get otp</button>
          </div>
          <div>
            <label for="password">OTP</label>
            <div class="grid grid-cols-4 gap-x-5 my-3">
              <input type="text" class="otp-input" name="otp1">
              <input type="text" class="otp-input" name="otp2">
              <input type="text" class="otp-input" name="otp3">
              <input type="text" class="otp-input" name="otp4">
            </div>
          </div>
          <button class="button" type="submit" name="login">Login</button>
        </form>

      </div>
    </div>
    <div class='bg-[#189BCC] rounded-lg m-5 md:flex flex-col justify-center p-10 text-white hidden'>

      <img src="../assets/nurse.svg" alt="" class="w-[70%] mx-auto">
      <h3 class="font-bold font-varela text-2xl">Sign up to Sauki</h3>
      <p class="font-light"></p>

    </div>


  </div>









  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

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

</body>

</html>