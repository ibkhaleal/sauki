<?php
include_once 'config.php';
session_start();
$err="";
/*** this is the hospital code for each hospital** */
$hcode = $_SESSION['admin_id'];

if(isset($_POST['pay'])){
  $id = $_POST['id'];
  $amount = $_POST['amount'];
  $desc = $_POST['desc'];
  $dt=time();
  
    $id=$id;
    $id=ltrim($id, "+2340");
    $id="+234".$id;
    
    $insert=mysqli_query($conn,"INSERT INTO pending_payments (userid,hospitalid,amount,description,st,dt) VALUES ('$id','$hcode','$amount','$desc','0','$dt')");
  if($insert == true){
      $err="
      <div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert'>
            <span class='font-medium'>Success:</span> Dial *384*44844*.$hcode.# and select 2 to make payment.
        </div>
      ";
  }else{
      echo "error";
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
  <title>Sauki Healthcare</title>

  <link rel="stylesheet" href="../../dist/output.css">


  <style>
    .card {
      border: 1px solid rgb(255, 255, 255);
      border-radius: 1rem;
      padding: .5rem;
      max-width: 300px;
      margin: 0 auto;
      animation: fade 250ms ease-in-out forwards;
    }

    /* .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: .5rem;
    gap: .25em;
  } */

    .form-group:last-child {
      margin: 0;
    }

    .form-group>label {
      font-weight: bold;
      font-size: .8em;
      color: #333;
    }

    /* .form-group > input {
    border: 1px solid #333;
    border-radius: .25em;
    font-size: 1rem;
    padding: .25em;
  } */

    .step-title {
      margin: 0;
      margin-bottom: 1rem;
      text-align: center;
    }

    .card.active {
      animation: slide 250ms 125ms ease-in-out both;
    }

    .multi-step-form {
      overflow: hidden;
      position: relative;
    }

    .hide {
      display: none;
    }

    @keyframes slide {
      0% {
        transform: translateX(200%);
        opacity: 0;
      }

      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes fade {
      0% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(.75);
        opacity: 0;
      }

      100% {
        opacity: 0;
        transform: scale(0);
      }
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

<body class="bg-white font-raleway">
  <div class="h-48 bg-primary rounded-b-[30%] px-7">
    <div class="flex items-center py-5 mb-5 justify-between">
      <div onclick="toggle()" class="toggleBtn">
        <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.75 16H24V13.3333H17.75V16ZM0 0V2.66667H7.75V0H0ZM0 9.33333H24V6.66667H0V9.33333Z" fill="white" />
        </svg>
      </div>
      <img src="../../assets/user.png" alt="" class="w-10 h-10 rounded-full">
    </div>
    <p class="text-center font-bold text-2xl text-white mt-7">Generate payment code</p>
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


  <div class="">
    <div class="">
      <div class="my-5">
          <?php echo $err ?>
        <form action="" data-multi-step method="POST">
          <div class="card" data-step>
            <div>
              <label for="identification">Patient Phone Number</label>
              <input type="input" name="id" id="identification" placeholder="Enter patient phone number" class="input" style="color:black">
            </div>
            <div>
              <label for="description">Description</label>
              <input type="text" name="desc" id="phone" placeholder="Enter Description" class="input" style="color:black">
            </div>
            <div>
              <label for="amount">Amount</label>
              <input type="text" name="amount" id="amount" placeholder="Enter Amount" class="input" style="color:black">
            </div>
            <div class="mx-5">
              <button type="submit" class="button" name="pay">Generate</button>
            </div>
          </div>

  </form>
  <form>
          <!-- <div class="card" data-step>
            <div class="link space-y-5 mx-2" id="myInput" type="text">
              <div class="flex text-primary text-sm font-semibold justify-between">
                <div class="font-bold">ID:</div>
                <div class="text-right">Okomayin Onaivi</div>
              </div>
              <div class="flex text-primary text-sm font-semibold justify-between">
                <div class="font-bold">Description:</div>
                <div class="text-right">+234 08146908277</div>
              </div>
              <div class="flex text-primary text-sm font-bold justify-between">
                <div>ID:</div>
                <div>63537</div>
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label for="identification">ID</label>
              <input type="input" name="identification" id="identification" placeholder="Enter your ID" class="input">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" name="phone" id="phone" placeholder="Enter Description" class="input">
            </div>
            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="text" name="amount" id="amount" placeholder="Enter Amount" class="input">
            </div> -->
            <!-- <div class="flex my-5 space-x-2 mx-1 gap-1">
              <button type="button" class="button" data-previous>Previous</button>
              <button type="button" class="button" data-next>Pay Now</button>
            </div>
          </div>
          <div class="card" data-step>
            <div class="box">
              <div>
                <label for="password">OTP</label>
                <div class="grid grid-cols-4 gap-x-5 my-3">
                  <input type="text" class="otp-input" min="0" max="9" required>
                  <input type="text" class="otp-input" min="0" max="9" required>
                  <input type="text" class="otp-input" min="0" max="9" required>
                  <input type="text" class="otp-input" min="0" max="9" required>
                </div>
              </div>
              <button class="button" type="submit">Debit</button>
            </div> -->
            <!-- <div class="card" data-step>
            <h3 class="step-title">3</h3>
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input class="input" type="text" name="firstName" id="firstName">
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input class="input" type="text" name="lastName" id="lastName">
            </div>
           <div class="flex space-x-3 mx-4 gap-10">
            <button type="button" class="button" data-previous>Previous</button>
            <button type="submit" class="button">Submit</button>
           </div>
          </div> -->
            <!-- <div>
            <label for="phone">Name</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
          </div>
          <div>
            <label for="phone">ID</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
          </div>
          <div>
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
          </div>
          <div>
            <label for="phone">Amount</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" class="input">
          </div>
         
          <input type="checkbox" name="" id="pop">
          <label for="pop" class="button text-center font-bold" type="sumbit">Next</label>
        <div class="container">
          <div class="modal">
            <div class="menu">
              <span class="font-bold">OTP Validation</span>
              <label for="pop" class="close"><i class="fa fa-close text-red-700"></i></label>
            </div>
            <div class="box">
                <div>
                    <label for="password">OTP</label>
                    <div class="grid grid-cols-4 gap-x-5 my-3">
                      <input type="number" class="otp-input" placeholder="0" min="0" max="9" required>
                      <input type="number" class="otp-input" placeholder="0" min="0" max="9" required>
                      <input type="number" class="otp-input" placeholder="0" min="0" max="9" required>
                      <input type="number" class="otp-input" placeholder="0" min="0" max="9" required>
                    </div>
                  </div>
              <button class="button" type="submit">Debit</button>
            </div>
          </div>
          </div>
        </div> -->
            <!-- <button class="button" type="submit">Debit</button> -->
        </form>

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

    const codes = document.querySelectorAll('.otp-input')

    codes[0].focus()

    codes.forEach((code, idx) => {
      code.addEventListener('keydown', (e) => {
        if (e.key >= 0 && e.key <= 9) {
          codes[idx].value = ''
          setTimeout(() => codes[idx + 1].focus(), 10)
        } else if (e.key === 'Backspace') {
          setTimeout(() => codes[idx - 1].focus(), 10)
        }
      })
    })
  </script>
  <script>
    const multiStepForm = document.querySelector("[data-multi-step]")
    const formSteps = [...multiStepForm.querySelectorAll("[data-step]")]
    let currentStep = formSteps.findIndex(step => {
      return step.classList.contains("active")
    })

    if (currentStep < 0) {
      currentStep = 0
      showCurrentStep()
    }

    multiStepForm.addEventListener("click", e => {
      let incrementor
      if (e.target.matches("[data-next]")) {
        incrementor = 1
      } else if (e.target.matches("[data-previous]")) {
        incrementor = -1
      }

      if (incrementor == null) return

      const inputs = [...formSteps[currentStep].querySelectorAll("input")]
      const allValid = inputs.every(input => input.reportValidity())
      if (allValid) {
        currentStep += incrementor
        showCurrentStep()
      }
    })

    formSteps.forEach(step => {
      step.addEventListener("animationend", e => {
        formSteps[currentStep].classList.remove("hide")
        e.target.classList.toggle("hide", !e.target.classList.contains("active"))
      })
    })

    function showCurrentStep() {
      formSteps.forEach((step, index) => {
        step.classList.toggle("active", index === currentStep)
      })
    }

  </script>

</body>

</html>

  <!--if(empty($id) || empty($amount)){-->

  <!--}else{-->
  <!--  $select = "SELECT bal FROM users WHERE phone ='".$id."'";-->
  <!--  $selected = mysqli_query($link,$select);-->
  <!--  $data = mysqli_fetch_array($selected);-->
  <!--  $userbal = $data['bal'];-->

  <!--  $debitAmt = $userbal - $amount;-->

  <!--  if($debitAmt == 0 || $debitAmt < 0){-->
  <!--    echo 'insufficient balance';-->
  <!--  }else{-->
  <!--    $update1 = "UPDATE users SET bal = bal - '$amount' WHERE phone = '".$id."'";-->
  <!--    $updated1 = mysqli_query($link,$update1);-->

  <!--    if($updated1){-->
  <!--      $update2 = "UPDATE hospitals SET bal = bal + '$amount' WHERE hcode = '".$hcode."'";-->
  <!--      $updated2 = mysqli_query($link,$update2);-->

  <!--      if($updated2){-->
  <!--        echo 'transaction successful!!';-->
  <!--        header('refresh:2 URL=pay.php');-->
  <!--      }-->
  <!--    }-->
  <!--  }-->
    
  <!--}-->