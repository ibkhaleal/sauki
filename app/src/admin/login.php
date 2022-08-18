<?php
    include 'config.php';
    session_start();
$err="";
if(isset($_SESSION['admin_id'])){
    header("location:admin_dashboard.php");
    ?>
    <script type="text/javascript">
        window.location.href="admin_dashboard.php";
    </script>
    <?php
}
if(isset($_POST['submit'])){
    $code=$_POST['code'];
    $pwd=md5($_POST['pwd']);

if (empty($code)) {
    $err="
        <div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800' role='alert'>
            <span class='font-medium'>Error</span> Hospital code is required
        </div>
    ";
    }else if(empty($pwd)){
        $err="
        <div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800' role='alert'>
            <span class='font-medium'>Error</span> Password is required
        </div>
    ";
    }else{
        
        $check = "SELECT * FROM hospitals WHERE hcode ='$code' AND hpwd='$pwd'";
        $checked = mysqli_query($conn,$check);
        if($checked == true){
            $_SESSION['admin_id'] = $code;
            header("location:admin_dashboard.php");
        }else{
                $err="<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800' role='alert'>
                <span class='font-medium'>Error</span> not checking
              </div>";
        
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
    <div class="md:mx-32 mx-7 md:my-24 py-7">
      <h1 class="text-left text-gray-900 font-bold text-2xl pb-3">Sign In</h1>
      <p class="text-sm">If you don't have an account registered, you can <a href="./signup.php"
          class="text-primary underline decoration-primary">Sign Up here!</a></p>

      <div class="my-5">
        <form action="login.php" method="POST" class="space-y-5">
            <?php echo $err ?>
          <div>
            <label for="phone">Hospital Code</label>
            <input type="tel" name="code" placeholder="Enter your phone number" class="input" required>
          </div>
          <div>
            <label for="phone">Password</label>
            <input type="password" name="pwd" placeholder="Enter your password" class="input" required>
          </div>
          <div>
            <div class="grid grid-cols-4 gap-x-5 my-3">
            </div>
          </div>
          <button class="button" type="submit" name="submit">Login</button>
        </form>

      </div>
    </div>
    <div class='bg-[#189BCC] rounded-lg m-5 md:flex flex-col justify-center p-10 text-white hidden'>

      <img src="../assets/nurse.svg" alt="" class="w-[70%] mx-auto">
      <h3 class="font-bold font-varela text-2xl">Sign up to Sauki</h3>
      <p class="font-light">Lorem ipsum dolor sit amet consectetur.</p>

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