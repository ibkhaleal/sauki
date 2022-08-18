<?php
include_once('config.php');

if(isset($_POST['regbtn'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    
    $phone=$phone;
    $phone=ltrim($phone, "+2340");
    $phone="+234".$phone;
    
    if(empty($name) || empty($phone) || empty($state)){
        echo '<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> fill in the fields properly!</div>';
    }else{ 

       $select = "SELECT COUNT(phone) FROM users WHERE phone = '".$phone."'";
       $selected = mysqli_query($link,$select);
       $data = mysqli_fetch_array($selected);
       if($data[0] == 1){
         echo '<div class="err bg-red-100 text-red-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10">Phonenumber already exists with another account</div>';
       }else{
        $insert = "INSERT INTO users(fullname,phone,state)VALUES('$name','$phone','$state')";
        $inserted = mysqli_query($link,$insert);
        
        if($inserted){
            echo '<div class="err bg-green-100 text-green-500 rounded-md border-l-4 border-red-500 py-1 px-5 mt-5 mx-10"> Account created successfully! redirecting to login page..</div>';
            // header('refresh:2 URL=login.php');
            ?>
            <script>window.location.replace('login.php')</script>
            <?php
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
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">


  <!-- Varela Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <title>Sauki Healthcare | Sign Up</title>

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
    <div class="md:mx-32 mx-7 md:py-10 py-7">
      <h1 class="text-left text-gray-900 font-bold text-2xl pb-3">Sign Up</h1>
      <p class="text-sm">If you already have an account registered, you can <a href="./login.php"
          class="text-primary underline decoration-primary">Login here!</a></p>

      <div class="my-5 space-y-5">
        <form action="" method="POST" class="space-y-5" id="form">
          <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your full name" class="input">
          </div>
          <div>
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
          </div>
          <div>
            <label for="password">State</label>
            <input type="tel" name="state" id="phone" placeholder="Enter your State of Residence" class="input">
          </div>
          <button class="button" type="submit" name="regbtn">Register</button>
        </form>
        <form action="#!" class="space-y-5 hidden" id="nin">
          <div>
            <label for="nin">NIN Number</label>
            <input type="number" name="nin" id="nin" placeholder="Enter NIN number" class="input">
          </div>
          <button class="button" type="submit">Register</button>
        </form>
        <p class="text-center py-3">Or sign up with</p>
        <div class="nimc"><button class="button" onclick="nimcc()">NIMC</button></div>
        <div class="hidden email-phone"><button class="button email-phone" onclick="phoneEmail()">Email & Phone</button>
        </div>

      </div>
    </div>
    <div class='bg-[#189BCC] rounded-lg m-5 md:flex flex-col justify-center p-10 text-white hidden'>

      <img src="../assets/nurse.svg" alt="" class="w-[70%] mx-auto">
      <h3 class="font-bold font-varela text-2xl">Sign up to Sauki</h3>
      <p class="font-light"></p>

    </div>


  </div>









  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
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

</body>

</html>

<?php
mysqli_close($link);
?>