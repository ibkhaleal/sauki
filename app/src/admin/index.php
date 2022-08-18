<?php
include 'config.php';
session_start();
$err="";

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $state=$_POST['state'];
    $lga=$_POST['lga'];
    $address=$_POST['address'];
    $pwd1=md5($_POST['pwd1']);
    $pwd2=md5($_POST['pwd2']);
    $dt=time();
    $code=rand(000,999);
    
    if($pwd1 !== $pwd2){
        $err='
        <div role="alert">
          <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Error
          </div>
          <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>Password do not match.</p>
          </div>
        </div>
        ';
    }else{
    
    $file1_name = $_FILES['image']['name'];
    $file1_tmp =$_FILES['image']['tmp_name'];
    if($file1_name != ''){
       move_uploaded_file($file1_tmp,"images/".$file1_name);
       $insert=mysqli_query($conn,"INSERT INTO hospitals(hname,hstate,hlg,haddress,hpic,hpwd,hcode,dt,bal) VALUES ('$name','$state','$lga','$address','$file1_name','$pwd1','$code','$dt','0')");
       if($insert == true){
           $_SESSION['admin_id']=$code;
           header("location:admin_dashboard.php");
       }
    }

}
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
  <title>Sauki Healthcare | Sign Up</title>

  <link rel="stylesheet" href="../../dist/output.css">


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
      <h1 class="text-left text-gray-900 font-bold text-2xl pb-3">Hospital Sign Up</h1>
      <p class="text-sm">If you already have an account registered, you can <a href="./login.php"
          class="text-primary underline decoration-primary">Login here!</a></p>

      <div class="my-5 space-y-5">
        <form action="index.php" method="POST" class="space-y-5" enctype="multipart/form-data" id="form">
          <div>
            <label for="name">Hospital Name</label>
            <input type="text" name="name" id="name" placeholder="Hospital Name" class="input" required>
          </div>
          <div>
            <label for="phone">State</label>
            <input type="text" name="state" placeholder="Hospital State" class="input" required>
          </div>
          <div>
            <label for="password">Local Government</label>
            <input type="text" name="lga" placeholder="Hospital Local Government" class="input" required>
          </div>
          <div>
            <label for="password">Addess</label>
            <input type="text" name="address" placeholder="Hospital Address" class="input" required>
          </div>
          <div>
            <label for="password">Picture</label>
            <input type="file" name="image" placeholder="Uplaod picture" class="input" required>
          </div>
          <div>
            <label for="password">Create Password</label>
            <input type="password" name="pwd1" placeholder="Create Password" class="input" required>
          </div>
          <div>
            <label for="password">Confirm Password</label>
            <input type="password" name="pwd2" placeholder="Confirm Password" class="input" required>
          </div>
          <button class="button" type="submit" name="submit">Register</button>
        </form>
        <div class="hidden email-phone"><button class="button email-phone" onclick="phoneEmail()">Email & Phone</button>
        </div>

      </div>
    </div>
    <div class='bg-[#189BCC] rounded-lg m-5 md:flex flex-col justify-center p-10 text-white hidden'>

      <img src="../assets/nurse.svg" alt="" class="w-[70%] mx-auto">
      <h3 class="font-bold font-varela text-2xl">Sign up to Sauki</h3>
      <p class="font-light">Lorem ipsum dolor sit amet consectetur.</p>

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