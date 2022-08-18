<?php 

	include ("dbconnect.php");

    include_once 'menu.php';
    //set isUserRegistered flag to true
    $isUserRegistered = true;
    //Read the data sent via POST from our AT API
    $sessionId   = $_POST["sessionId"];
    $serviceCode = $_POST["serviceCode"];
    $phoneNumber = $_POST["phoneNumber"];
    $text        = $_POST["text"];

	 $menu = new Menu();
    if($text == "" ){
         //user is registered and string is is empty
          include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                $isUserRegistered  = 0;
        echo "CON ". $menu->mainMenuRegistered($phoneNumber);
    }else {
        $isUserRegistered  = 1;
        $menu->mainMenuUnRegistered($phoneNumber);
    }
    
    
    }else {
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows == 0) {
            $isUserRegistered  = 1;
        //user is unregistered and string is not empty
        $textArray = explode("*", $text);
        switch($textArray[0]){
            case 1: 
                $menu->registerMenu($textArray, $phoneNumber);
            break;
            default:
                echo "END Invalid choice. Please try again";
        }
    }else {
        //user is registered and string is not empty
        $textArray = explode("*", $text);
        switch($textArray[0]){
            case 1: 
                $menu->bookAppointment($textArray,$phoneNumber);
            break;
            case 2: 
                $menu->sendMoneyMenu($textArray,$phoneNumber);
            break;
            case 3:
                $menu->loadVoucher($textArray,$phoneNumber);
            break;
			 case 4:
                $menu->insuranceMenu($textArray,$phoneNumber);
            break;
            case 5:
                $menu->checkBalanceMenu($textArray,$phoneNumber);
            break;
            case 6:
                $menu->setting($textArray,$phoneNumber);
            break;
            case (strlen((string)$textArray[0]) == 12):
                $menu->directVoucher($textArray, $phoneNumber);
            break;
            
            
              case (strlen((string)$textArray[0]) == 3):
                $menu->directHospitalMenu($textArray, $phoneNumber);
            break;
            default:
                echo "END Inavalid menu\n";
        }
    }
    
    }
    
?>