<?php

include_once 'util.php';
include 'dbconnect.php';
   
class Menu
{
    protected $text;
    protected $sessionId;


    function __construct()
    {
    }


    public function mainMenuRegistered($phoneNumber)
    {
        //shows initial user menu for registered users
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
                 if ($language == 1){
        $response = "Welcome " . $Name . " \n";
        $response .= "1. Book appointment\n";
        $response .= "2. Transfer\n";
        $response .= "3. Credit my wallet\n";
        $response .= "4. Insurance\n";
        $response .= "5. Check Balance \n";
        $response .= "6. Change PIN/language \n";
      
        return $response;
            }else if($language == 2){
                $response = "Barka da zuwa " . $Name . "\n";
        $response .= "1. Kama layi \n";
        $response .= "2. Tura Kudi\n";
        $response .= "3. Sanya kudi a walet\n";
        $response .= "4. Inshora\n";
        $response .= "5. Duba balans \n";
        $response .= "6. Chanza kalmar sirri/yare \n";
        
        return $response;
            }else if($language == 3){
                $response = "Ekaabo " . $Name . "\n";
        $response .= "1. Iwe ipinnu lati pade \n";
        $response .= "2. Fi owo ranṣẹ \n";
        $response .= "3. Kirẹditi mi apamọwọ\n";
        $response .= "4. Insurance\n";
        $response .= "5. Ṣayẹwo Iwontunwonsi \n";
        $response .= "6. Yi Ọrọigbaniwọle/Ede pada \n";
        
        return $response;
            }else if($language == 4){
                $response = "Nnọọ " . $Name . "\n";
        $response .= "1. Nhọpụta akwụkwọ \n";
        $response .= "2. Zipu ego\n";
        $response .= "3. Ebe e si nweta obere akpa m \n";
        $response .= "4. Iṣeduro\n";
        $response .= "5. Lelee nha nha \n";
        $response .= "6. Gbanwee Paswọdu/Asụsụ \n";
       
        return $response;
            }
            } else {
                 echo "CON hello".mainMenuUnRegistered($phoneNumber);
            }
           
    }






//insurance menu






public function insuranceMenu(){
    
    echo "END You can enjoy up to 50% health insurance on Sauki Healthcare \n \n This applies auomatically when you pay with Sauki. \n \n Use Sauki healthcare frequently to  increase your insurance limit.";
    
    
}




public function directHospitalMenu($textArray,$phoneNumber){
    $response='';
      $level = count($textArray);
      
    // level 1
    
    
    
    //   check user language
    
    
        include 'dbconnect.php';
        
            $user = "SELECT * FROM users WHERE phone='".$phoneNumber."'";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
                
            }
                // if language is english
             if($level==1){ 
                 
                 $hid=$textArray[0];
               
                 
                 $getHospitals=mysqli_query($conn, "SELECT * FROM hospitals WHERE hcode='".$hid."'");
                  if(mysqli_num_rows($getHospitals) > 0){
                   
                     while($hospitals=mysqli_fetch_assoc($getHospitals)){
                         $hname=$hospitals['hname'];
                     }
                         
                 
                         
                         
                     $response.="CON ".$hname." is on Sauki Healthcare. Reply \n 
1. Book appointment \n 2. Make Payment \n ";
                    
                 
                    
                
                 }
                 
                 else{
                   
                   
                   
                   echo "END Invalid hospital code.";
                    
                     
                     
                     
                     
                 }
                 
               
                    
                    
                 
                
                
             
                
        }  
        
        
        // level 2 form payment
        
        
        
        elseif($level == 2 AND $textArray[1] == 2){
            
            // get the pending payments fromthe  database
            
            $getPP=mysqli_query($conn, "SELECT * FROM pending_payments WHERE userid='".$phoneNumber."' AND hospitalid='".$textArray[0]."'");
            
            //check if there is ongoing payment
            
            if(mysqli_num_rows($getPP) > 0){
                
                while($pDetails = mysqli_fetch_assoc($getPP)){
                    $feeAmount=$pDetails['amount'];
                    $feeDesc=$pDetails['description'];
                    $fiftyPercent=$feeAmount/100*50;
                }
                
            echo "CON You are about to pay for $feeDesc  \n Actual Fee: {$feeAmount} \n Insurance: 50% ({$fiftyPercent}) \n Amount to Pay {$fiftyPercent} \n Input your PIN to confirm ";
            
            
            }
            else {
              // no unpaid payment  
                
                $response.="END You do not have unpaid fee in {This hospital}"; 
            }
            
            
         
          
          echo $response;
            
        }
        
        
        
        
        //level 3 for payment
        
        
        
        
        elseif($level ==3 AND $textArray[1] == 2){
           
           
           // GET THE PIN
           $pin=md5($textArray[2]);
           
           // check if the pin is correct
           
           $checkPIN=mysqli_query($conn, "SELECT *FROM users WHERE phone='".$phoneNumber."' AND tpin='".$pin."'");
           
           if(mysqli_num_rows($checkPIN) > 0){
               
               // if the password is correct
               
               
               // update the payment status to  1
            
               $update=mysqli_query($conn, "UPDATE pending_payments SET st='1' WHERE userid='".$phoneNumber."' AND hospitalid='".$textArray[0]."'");
               
              // deduct user 
              
              //get the amount to  deduct the user
              
              
               //check if there is ongoing payment
            
              $getPP=mysqli_query($conn, "SELECT * FROM pending_payments WHERE userid='".$phoneNumber."' AND hospitalid='".$textArray[0]."'");
            
            
                while($pDetails = mysqli_fetch_assoc($getPP)){
                  $fAmount=$pDetails['amount'];
                    $feeDesc=$pDetails['description'];
                $fpercent = $fAmount / 100 * 50;
                }
                
                
                // lets deduct the user now
              // but before then, lets get their balance
							$getUserBalance=mysqli_query($conn, "SELECT bal FROM users WHERE phone='".$phoneNumber."'");
							// get the balance
							
							while($userBALANCE=mysqli_fetch_assoc($getUserBalance)){
									$userBal=$userBALANCE['bal'];
							
							}
							$newUserBal=$userBal - $fpercent;
            // update user balance
						
						
						$updateUserBalance=mysqli_query($conn, "UPDATE users SET bal ='".$newUserBal."' WHERE phone='".$phoneNumber."'");
              
              
              
              // credit hospital
               
               // but we have to get the hospital balance first
							 // lets get it
							 
							 $getHBalance=mysqli_query($conn, "SELECT bal FROM hospitals WHERE hcode='".$textArray[0]."'");
							// get the balance
							
							while($hBALANCE=mysqli_fetch_assoc($getHBalance)){
									$hBal=$hBALANCE['bal'];
							
							}
							$newhBal=$hBal + $fpercent;
							 
							 
							 
							 
							 
							 $creditHospital=mysqli_query($conn, "UPDATE hospitals SET bal =".$newhBal." WHERE hcode='".$textArray[0]."'");
              
             
							 
							 
             echo "END  Paid {$fpercent} successfully, your new balance is {$newUserBal}";    
               
           }
           else{
               // if the password is incorrect
                   
              $response.= "END  Incorrect PIN";    
               
               
           }
           
         
            
        }
        
        
        // level 2
        // bayan anyi selecting din hospital kenan
        
        
        elseif($level==2){
            //get the hospital id from user input
            
            
            $hid=$textArray[0];
            
            // get the hospital details
            
            $getHospitalID=mysqli_query($conn, "SELECT * FROM hospitals WHERE  hcode='".$hid."'");
            
            
            
            //cehc if the entered code is valid by checking if the jospital od exists in the database.
            
            if(mysqli_num_rows($getHospitalID) > 0 ){
                
              while($hDetails=mysqli_fetch_assoc($getHospitalID)){
                  $hname=$hDetails['hname'];
                   
              }
               
               
               
            $response.= "CON Are you sure to book an appointment in {$hname} ? \n 1. Yes \n 2. No \n";    
            }
            else{
                
              $response.="END You selected an invalid option.";  
                
            }
            
            
            
            
            
            
            
            
            
            
        }
        
        
        
        
        
        //level 3
        
        
        elseif($level==3){
            $selectedResp=$textArray[2];
            
            
            //if response is 1 yes kenNA
            
            if($selectedResp==1){
            // ayi mai booking
            
            //save the appointment
            
            
            
            $dt=time();
          $save=mysqli_query($conn, "INSERT INTO appointments (userid, hospitalid,datetime) VALUES('".$phoneNumber."',   '".$textArray[0]."', '".$dt."')");
            
            
            // get the postion of the user
            
            
            $getUOnQ=mysqli_query($conn, "SELECT * FROM appointments WHERE userid='".$phoneNumber."' AND hospitalid='".$textArray[0]."' ORDER BY id DESC LIMIT 1");
            
               
            
            
            
            // get the number niow
            
            while($nInQ=mysqli_fetch_assoc($getUOnQ)){
                
                $nInTheQ=$nInQ['id'];
                
                
            }
            
            
            $response.="END Your appointment was sent, you are number {$nInTheQ}  on the queue";
            
            
            
                
            }
            elseif($selectedResp==2){
                
               $response.="END appointment cancelled";   
            }
            else{
                
                $response.= "END Invalid option";
            }
            
            
            
            
            
            
        }
        
        
        
        
        
        
        
       echo $response;    
         
}








public function bookAppointment($textArray,$phoneNumber){
    $response='';
      $level = count($textArray);
      
    // level 1
    
    
    
    //   check user language
    
    
        include 'dbconnect.php';
        
            $user = "SELECT * FROM users WHERE phone='".$phoneNumber."'";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
                
            }
                // if language is english
             if($level==1){ 
                 
                 
                 // cehck if there is nearest hospital in the user area
                 //get user state
                 
                 $userState=mysqli_query($conn, "SELECT * FROM users WHERE phone='".$phoneNumber."'");
                 
                 while($userS=mysqli_fetch_assoc($userState)){
                     $uState=$userS['state'];
                     
                 }
                 
                 $getHospitals=mysqli_query($conn, "SELECT * FROM hospitals WHERE hstate='".$uState."'");
                  if(mysqli_num_rows($getHospitals) > 0){
                      $sn=0;
                    $response.="CON This are the nearest hospitals found in your area. \n Reply to book appoinment \n"; 
                     while($hospitals=mysqli_fetch_assoc($getHospitals)){
                         $sn++;
                         $hname=$hospitals['hname'];
                         $nHospitals="$sn>  $hname \n";
                         
                         
                    $response.="$nHospitals";
                    
                    
                    
                
                 
                         
                         
                         
                         
                     }
                     
                     
                      
                
                        
                     
                 }
                 
                 else{
                   
                   
                   
                   echo "END No hospital found near you.";
                    
                     
                     
                     
                     
                 }
                 
               
                    
                    
                 
                
                
             
                
        }  
        
        
        
        // level 2
        // bayan anyi selecting din hospital kenan
        
        
        elseif($level==2){
            //get the hospital id from user input
            
            
            $hid=$textArray[1];
            
            // get the hospital details
            
            $getHospitalID=mysqli_query($conn, "SELECT * FROM hospitals WHERE  id='".$hid."'");
            
            
            
            //cehc if the entered code is valid by checking if the jospital od exists in the database.
            
            if(mysqli_num_rows($getHospitalID) > 0 ){
                
              while($hDetails=mysqli_fetch_assoc($getHospitalID)){
                  $hname=$hDetails['hname'];
                   
              }
               
               
               
            $response.= "CON Are you sure to book an appointment in {$hname} ? \n 1. Yes \n 2. No \n";    
            }
            else{
                
              $response.="END You selected an invalid option.";  
                
            }
            
            
            
            
            
            
            
            
            
            
        }
        
        
        
        
        
        //level 3
        
        
        elseif($level==3){
            $selectedResp=$textArray[2];
            
            
            //if response is 1 yes kenNA
            
            if($selectedResp==1){
            // ayi mai booking
            $dt=time();
            //save the appointment
            
            $save=mysqli_query($conn, "INSERT INTO appointments (userid, hospitalid,datetime) VALUES('".$phoneNumber."',   '".$textArray[1]."', '".$dt."')");
            
            
            
            
            // get the postion of the user
            
            
            $getUOnQ=mysqli_query($conn, "SELECT * FROM appointments WHERE userid='".$phoneNumber."' AND hospitalid='".$textArray[1]."'");
            
            
            // get the number niow
            
            while($nInQ=mysqli_fetch_assoc($getUOnQ)){
                
                $nInTheQ=$nInQ['id'];
                
                
            }
            
            
            $response.="END Your appointment was sent, you are number {$nInTheQ}  on the queue";
            
                
            }
            elseif($selectedResp==2){
                
               $response.="END appointment cancelled";   
            }
            else{
                
                $response.= "END Invalid option";
            }
            
            
            
            
            
            
        }
        
        
        
        
        
        
        
       echo $response;    
         
}
       



    public function mainMenuUnRegistered($phoneNumber)
    {
        //shows initial user menu for unregistered users
        $response = "CON Welcome to Sauki Healthcare.\n";
        $response .= "1. Register\n";
        echo $response;
    }





    public function registerMenu($textArray, $phoneNumber)
    {
        //building menu for user registration 
        $level = count($textArray);
        $response="";
        if ($level == 1) {
           
          echo "CON Please enter your Full name:";
                
        } 
     
          
                
       else if ($level == 2) {
            echo "CON Enter your state name:";
        } else if ($level == 3) {
            echo "CON Please your address \n";
        } else if ($level == 4) {
            $response .="CON Please select language: \n";
            $response .="1. English language \n";
            $response .="2. Hausa language \n";
             $response .="3. Yoruba language \n";
              $response .="4. Igbo language \n";
            echo $response;
        } else if ($level == 5) {
            $name = $textArray[1];
            $state = $textArray[2];
            $address = $textArray[3];
            $lang = $textArray[4];
            $dt=time();
                // save to database
                
                include "dbconnect.php";
              $insert=mysqli_query($conn, "INSERT INTO users (fullname,phone,email,state,lga,address,gender,picture,nin,language,bal,st,dt) VALUES ('".$name."','".$phoneNumber."','','".$state."', '', '".$address."', '', '', '', '".$lang."','0.00', '1', '".$dt."')");
                if ($insert === TRUE) {
                    echo "END You have been registered successfully. \n Your default PIN is 0000, kindly change it to peform transactions on Sauki.";
                } else {
                    echo "END Network problem, please try again later";
                }
            
        }
    
    
    
  
    
         
         
         
        
       
    }
    
    
    
    
  
  
  
  
    
        //building menu for user registration 
       
    
    

    public function sendMoneyMenu($textArray, $phoneNumber)
    {
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
        //building menu for user registration 
        $level = count($textArray);
        $receiverName = "";
        $receiverMobileWithCountryCode = "";
        $response = "";
        if ($level == 1 AND $language == 1) {
                include 'dbconnect.php';
                $query1 = "SELECT * FROM users WHERE phone='$phoneNumber'";
                $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                $count1 = mysqli_num_rows($result1);
                if ($count1 == 0) {
                echo "END This number has not been registered";
                } else
            echo "CON Enter mobile number of the receiver:";
        } else if ($level == 1 AND $language == 2) {
            echo "CON Saka Lambar Wayar Mai Karba:";
        }else if ($level == 1 AND $language == 3) {
            echo "CON Tẹ nọmba olugba sii:";
        }else if ($level == 1 AND $language == 4) {
            echo "CON Tinye nọmba ekwentị mkpanaaka nke nnata:";
        }else if ($level == 2 AND $language == 1) {
            echo "CON Enter amount:";
        }else if ($level == 2 AND $language == 2) {
            echo "CON Nawa Zaha Tura:";
        }else if ($level == 2 AND $language == 3) {
            echo "CON Tẹ iye sii:";
        }else if ($level == 2 AND $language == 4) {
            echo "CON Tinye ego:";
        }else if ($level == 3 AND $language == 1) {
            $response .="CON Select Bank:\n";
            $response .="1. Sauki\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 2) {
            $response .="CON Zabi banki:\n";
            $response .="1. Sauki\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 3) {
            $response .="CON Yan Bank:\n";
            $response .="1. Sauki\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        }else if ($level == 3 AND $language == 4) {
            $response .="CON Họrọ ụlọ akụ:\n";
            $response .="1. Sauki\n";
            $response .="2. First Bank\n";
            $response .="3. Access Bank\n";
            $response .="4. UBA Bank\n";
            $response .="5. Zenith Bank \n";
            echo $response;
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 1 ) {
            echo "CON Enter your PIN:";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 2 ) {
            echo "CON Saka Mukulin Sirrin Ka:";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 3 ) {
            echo "CON Te pinni re :";
        } else if ($level == 4 && $textArray[3] == 1 AND $language == 4 ) {
            echo "CON Tinye ntụtụ gị :";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 1) {
            echo "END Inter Bank transfer is yet to be implimented:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 2) {
            echo "END Muna Aiki Akan Wannan Tsarin:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 3) {
            echo "END A n ṣiṣẹ lori rẹ:";
        } else if ($level == 4 && $textArray[3] != 1 AND $language == 4) {
            echo "END Anyị na-arụ ọrụ na ya:";
        } else if ($level == 5) {
            $receiverMobile = $textArray[1];
            $receiverMobileWithCountryCode = $this->addCountryCodeToPhoneNumber($receiverMobile);
            
            include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$receiverMobileWithCountryCode' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $recieverName = $row2["fullname"];
                    $balance = $row2["bal"];
                    
                }
           if  ($language == 1){
            $response .= "You are about to send " . $textArray[2] . " to " . $recieverName . "\n";
            $response .= "1. Confirm\n";
            $response .= "2. Cancel\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response;
           } else if ($language == 2){
              $response .= "Zaha Tura " . $textArray[2] . " Zuwa " . $recieverName . "\n";
            $response .= "1. Tabbatar\n";
            $response .= "2. Soke\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           } else if ($language == 3){
              $response .= "O ti fẹ fi " . $textArray[2] . " ranṣẹ si " . $recieverName . "\n";
            $response .= "1. Jẹrisi\n";
            $response .= "2. fagilee\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           } else if ($language == 4){
              $response .= "Ị na-achọ iziga " . $textArray[2] . " Iji " . $recieverName . "\n";
            $response .= "1. Gosi\n";
            $response .= "2. Kagbuo\n";
            $response .= Util::$GO_BACK . " Back\n";
            $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
            echo "CON " . $response; 
           }
            }else{
                echo "END The Reciever's phone Number is not Registered";
            }
            
        } else if ($level == 6 && $textArray[5] == 1) {
            //a confirm
            //send the money plus
            //check if PIN correct
            //If you have enough funds including charges etc..
            $pin = md5($textArray[4]);
            $amount = $textArray[2];
            // echo "END proceed";
            //connect to DB
            include 'dbconnect.php';
            $sender = "SELECT * FROM users WHERE phone='$phoneNumber' AND tpin='$pin' ";
            $result2 = $conn->query($sender);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $MyBalance = $row2["bal"];
                }
            }else{
                $amount = 0;
                echo "END incorrect pin ";
            }
                if($amount > $MyBalance AND $language == 1 ){
                    echo "END Insufficient Fund";
                }else if($amount > $MyBalance AND $language == 2 ){
                    echo "END Kudin Ka Basu Kai Ba";
                }else if($amount > $MyBalance AND $language == 3 ){
                    echo "END ko si owo to";
                }else if($amount > $MyBalance AND $language == 4 ){
                    echo "END ego ezughi oke";
                }else{
                    $receiverMobile = $textArray[1];
                    $receiverMobileWithCountryCode = $this->addCountryCodeToPhoneNumber($receiverMobile);
            
            include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$receiverMobileWithCountryCode' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $recieverName = $row2["fullname"];
                    $balance = $row2["bal"];
                    
                }
            }
                    $newSenderBalance = $MyBalance - $amount;
                    $newRecieverBalance = $balance + $amount;
                    $Reciever = $_SESSION['RecieverNumber'];
                    
                $update = $conn->query("UPDATE users SET bal='$newSenderBalance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE users SET bal='$newRecieverBalance' WHERE phone='$receiverMobileWithCountryCode' ");
                $save = $conn->query("INSERT INTO transaction (sender,reciever,amount) VALUES ('" . $phoneNumber . "','" . $receiverMobileWithCountryCode . "','" . $amount . "')");
                
                
                
                if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 1) {
                    echo "END ".money_format("You have successfully sent NGN %i", $amount)." to ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 2) {
                    echo "END ".money_format("Ka Tura NGN %i", $amount)." Zuwa ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 3) {
                    echo "END ".money_format("O ti fi NGN %i", $amount)." ranṣẹ si ".$recieverName;
                }else if ($update === TRUE AND $update2 === TRUE && $save === TRUE AND $language == 4) {
                    echo "END ".money_format("Ị ezipụla NGN %i", $amount)." ka ".$recieverName;
                } else {
                    echo "END Network problem, please try again \n later Error 504";
                }
                }
            
        }
            
        }else if ($level == 6 && $textArray[5] == 2) {
            //Cancel
            echo "END Canceled. Thank you for using our service";
        } else if ($level == 6 && $textArray[5] == Util::$GO_BACK) {
            echo "END You have requested to back to one step - re-enter PIN";
        } else if ($level == 6 && $textArray[5] == Util::$GO_TO_MAIN_MENU) {
            echo "END You have requested to back to main menu - to start all over again";
        } else if ($language == 1) {
            echo "END Invalid entry";
        }else if ($language == 2) {
            echo "END Baka Saka Dai Dai Ba";
        }else if ($language == 3) {
            echo "END Akọsilẹ ti ko tọ";
        }else if ($language == 4) {
            echo "END Ntinye na ezighi ezi";
        }else{
        echo "END Invalid language";
    }
        
    }
    
      







public function directVoucher($textArray, $phoneNumber)
    {
     $level = count($textArray);
        $response = "";
        if ($level == 1) {
             $voucher = $textArray[0];
            // echo "END voucher: ".$voucher.$phoneNumber;
            
        //     //Complete transaction
            include 'dbconnect.php';

            $load = "SELECT * FROM voucher WHERE code='$voucher' AND status=0 ";
            $result = $conn->query($load);
            if ($result->num_rows > 0) {
                // echo "END hello";
                
                while($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
                
            // echo "END voucher: ".$phoneNumber;    
                
            include 'dbconnect.php';
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                //echo "END user found";
                while($row2 = $result2->fetch_assoc()) {
                    $balance = $row2["bal"];
                }
                $balance += $amount;
                //echo "END voucher: ".$balance;
                $update = $conn->query("UPDATE users SET bal='$balance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE voucher SET status='1' WHERE code='$voucher' ");
                if ($update === TRUE AND $update2 === TRUE) {
                    echo "END ".money_format("You have successfully loaded NGN %i", $amount)." into your Sauki Healthcare account";
                } else {
                    echo "END Network problem, please try again later ";
                }
                
            } else {
                echo "END Hello, Your Number is not Registered";
            }


        }else{
            echo "END incorrect pin, please check and try again";
        }
        // }
        
        }}







public function loadVoucher($textArray, $phoneNumber)
    {
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
        //building menu for user loading voucher 
        $level = count($textArray);
        $response = "";
        if ($level == 1 AND $language == 1) {
                include 'dbconnect.php';
                $query1 = "SELECT * FROM users WHERE phone='$phoneNumber'";
                $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                $count1 = mysqli_num_rows($result1);
                if ($count1 == 0) {
                echo "END This number has not been registered";
                } else 
            echo "CON Enter 12 digit Numbers:";
        } else if ($level == 1 AND $language == 2) {
        echo "CON Shigar da lambobi shabiyu:";
        } else if ($level == 1 AND $language == 3) {
        echo "CON Tẹ nọmba mejila na sii:";
        }else if ($level == 1 AND $language == 4) {
        echo "CON Tinye ọnụọgụ ọnụọgụ iri na abụọ:";
        } else if ($level == 2 AND $language == 1) {
            $voucher = $textArray[1];

            //  echo "END the code is ".$voucher;

            //Complete transaction
            include 'dbconnect.php';

            $load = "SELECT * FROM voucher WHERE code='$voucher' AND status=0 ";
            $result = $conn->query($load);
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $balance = $row2["bal"];
                }
                $balance += $amount;
                $update = $conn->query("UPDATE users SET bal='$balance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE voucher SET status='1' WHERE code='$voucher' ");
                if ($update === TRUE AND $update2 === TRUE) {
                    echo "END ".money_format("You have successfully loaded NGN %i", $amount)." into your Sauki account";
                } else {
                    echo "END Network problem, please try again later ";
                }
                
            } else {
                echo "END Unidentified User";
            }


        }else{
            echo "END incorrect or used voucher, please check and try again";
        }
    } else if ($level == 2 AND $language == 2) {
            $voucher = $textArray[1];

            //  echo "END the code is ".$voucher;

            //Complete transaction
            include 'dbconnect.php';

            $load = "SELECT * FROM voucher WHERE code='$voucher' AND status=0 ";
            $result = $conn->query($load);
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $balance = $row2["bal"];
                }
                $balance += $amount;
                $update = $conn->query("UPDATE users SET bal='$balance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE voucher SET status='1' WHERE code='$voucher' ");
                if ($update === TRUE AND $update2 === TRUE) {
                    echo "END ".money_format("An yi nasarar loda NGN %i", $amount)." cikin Sauki account";
                } else {
                    echo "END Network problem, please try again later ";
                }
                
            } else {
                echo "END Unidentified User";
            }


        }else{
            echo "END ba daidai ba ko amfani da baucan, Da fatan za a duba kuma a sake gwadawa";
        }
    } else if ($level == 2 AND $language == 3) {
            $voucher = $textArray[1];

            //  echo "END the code is ".$voucher;

            //Complete transaction
            include 'dbconnect.php';

            $load = "SELECT * FROM voucher WHERE code='$voucher' AND status=0 ";
            $result = $conn->query($load);
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $balance = $row2["bal"];
                }
                $balance += $amount;
                $update = $conn->query("UPDATE users SET bal='$balance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE voucher SET status='1' WHERE code='$voucher' ");
                if ($update === TRUE AND $update2 === TRUE) {
                    echo "END ".money_format("O ti fi NGN %i", $amount)." sinu Sauki account rẹ";
                } else {
                    echo "END Network problem, please try again later ";
                }
                
            } else {
                echo "END Unidentified User";
            }


        }else{
            echo "END Ti ko tọ tabi iwe-ẹri ti a lo, Jọwọ ṣayẹwo ki o tun gbiyanju lẹẹkansi";
        }
    }else if ($level == 2 AND $language == 4) {
            $voucher = $textArray[1];

            //  echo "END the code is ".$voucher;

            //Complete transaction
            include 'dbconnect.php';

            $load = "SELECT * FROM voucher WHERE code='$voucher' AND status=0 ";
            $result = $conn->query($load);
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $balance = $row2["bal"];
                }
                $balance += $amount;
                $update = $conn->query("UPDATE users SET bal='$balance' WHERE phone='$phoneNumber' ");
                $update2 = $conn->query("UPDATE voucher SET status='1' WHERE code='$voucher' ");
                if ($update === TRUE AND $update2 === TRUE) {
                    echo "END ".money_format("Ị ezipụla NGN %i", $amount)." Maka gị Sauki account";
                } else {
                    echo "END Network problem, please try again later ";
                }
                
            } else {
                echo "END Unidentified User";
            }


        }else{
            echo "END Ezighi ezi ma ọ bụ akwụkwọ ikike eji eme ihe, Biko lelee ma nwaa ọzọ";
        }
    }
        }
    }  
    
    
    
    
    
    
    
    public function withdrawMoneyMenu($textArray)
    {
        //TODO
        echo "CON To be implemented";
    }







 public function checkBalanceMenu($textArray, $phoneNumber)
    {
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
        $level = count($textArray);
        $response = "";
        if ($level == 1 AND $language == 1) {
                include 'dbconnect.php';
                $query1 = "SELECT * FROM users WHERE phone='$phoneNumber'";
                $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                $count1 = mysqli_num_rows($result1);
                if ($count1 == 0) {
                echo "END This number has not been registered";
                } 
                echo "CON Enter your pin:";
                }else if ($level == 1 AND $language == 2){
                echo "CON Saka Mukulin Sirin Ka:";
                }else if ($level == 1 AND $language == 3){
                echo "CON tẹ pinni rẹ sii:";
                }else if ($level == 1 AND $language == 4){
                echo "CON Tinye ntụtụ gị:";
                } else if ($level == 2 AND $language == 1) {
            $pin = md5($textArray[1]);
            
        include 'dbconnect.php';
            $bal = "SELECT * FROM users WHERE phone='$phoneNumber' AND tpin='$pin'";
            $result = $conn->query($bal);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $balance = $row["bal"];
                }
                $formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                echo "END your balance is: ",$formatter->formatCurrency($balance, 'NGN'), PHP_EOL;
        // echo "END".money_format("Your account balance is: %i", $balance);
    }else{
        echo "END Incorrect Pin";
    }
                
            }  else if ($level == 2 AND $language == 2) {
            $pin = md5($textArray[1]);
            
        include 'dbconnect.php';
            $bal = "SELECT * FROM users WHERE phone='$phoneNumber' AND tpin='$pin'";
            $result = $conn->query($bal);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $balance = $row["bal"];
                }
                $formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                echo "END Ragowar kudin asusun ku Shine: ",$formatter->formatCurrency($balance, 'NGN'), PHP_EOL;
        // echo "END".money_format("Your account balance is: %i", $balance);
    }else{
        echo "END Mukulin Sirri Ba Dai Dai Ba";
    }
                
            }  else if ($level == 2 AND $language == 3) {
            $pin = md5($textArray[1]);
            
        include 'dbconnect.php';
            $bal = "SELECT * FROM users WHERE phone='$phoneNumber' AND tpin='$pin'";
            $result = $conn->query($bal);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $balance = $row["bal"];
                }
                $formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                echo "END Iwontunwonsi àkọọlẹ rẹ ni: ",$formatter->formatCurrency($balance, 'NGN'), PHP_EOL;
        // echo "END".money_format("Your account balance is: %i", $balance);
    }else{
        echo "END pinni ti ko tọ";
    }
                
            }  else if ($level == 2 AND $language == 4) {
            $pin = md5($textArray[1]);
            
        include 'dbconnect.php';
            $bal = "SELECT * FROM users WHERE phone='$phoneNumber' AND tpin='$pin'";
            $result = $conn->query($bal);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $balance = $row["bal"];
                }
                $formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                echo "END Ọnụ ego akaụntụ gị bụ: ",$formatter->formatCurrency($balance, 'NGN'), PHP_EOL;
        // echo "END".money_format("Your account balance is: %i", $balance);
    }else{
        echo "END pin ezighi ezi";
    }
                
            }
    } else{
        echo"END Invalid language";
    }
        
    }
    
    
    
public function setting($textArray, $phoneNumber)
    {
        $level = count($textArray);
        $response = "";
        include 'dbconnect.php';            
            $user = "SELECT * FROM users WHERE phone='$phoneNumber' ";
            $result2 = $conn->query($user);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $Name = $row2["fullname"];
                    $language = $row2['language'];
                }
        if ($level == 1 AND $language == 1){
        $response .= "CON Select Option\n";
        $response .= "1. Change Pin\n";
        $response .= "2. Change language\n";
        echo "$response";
        }else if ($level == 1 AND $language == 2){
        $response .= "CON Zaɓi Zaɓi\n";
        $response .= "1. Canja Mukullin Sirri\n";
        $response .= "2. Canja Harshe\n";
        echo "$response";
        }else if ($level == 1 AND $language == 3){
        $response .= "CON Yan Aṣayan\n";
        $response .= "1. Parro Pinni re\n";
        $response .= "2. Yi ede pada\n";
        echo "$response";
        }else if ($level == 1 AND $language == 4){
        $response .= "CON Họrọ Nhọrọ\n";
        $response .= "1. Gbanwee pin\n";
        $response .= "2. Gbanwee Asụsụ\n";
        echo "$response";
        }else if ($level == 2 && $textArray[1] == 1 AND $language == 1 ) {
            echo "CON Enter current pin:";
        }else if ($level == 2 && $textArray[1] == 1 AND $language == 2 ) {
            echo "CON Shigar da mukullin sirri na yanzu:";
        }else if ($level == 2 && $textArray[1] == 1 AND $language == 3 ) {
            echo "CON Tẹ pinni ti isiyi sii:";
        }else if ($level == 2 && $textArray[1] == 1 AND $language == 4 ) {
            echo "CON Tinye ntụtụ ugbu a:";
        }else if ($level == 2 && $textArray[1] == 2 AND $language == 1 ) {
        $response .= "CON Select language\n";
        $response .= "1. English language\n";
        $response .= "2. Hausa language\n";
        $response .= "3. Yoruba language\n";
        $response .= "4. Igbo language\n";
        echo "$response";
        }else if ($level == 2 && $textArray[1] == 2 AND $language == 2 ) {
        $response .= "CON Zaɓi Harshe\n";
        $response .= "1. English language\n";
        $response .= "2. Hausa language\n";
        $response .= "3. Yoruba language\n";
        $response .= "4. Igbo language\n";
        echo "$response";
        }else if ($level == 2 && $textArray[1] == 2 AND $language == 3 ) {
        $response .= "CON Yan Ede\n";
        $response .= "1. English language\n";
        $response .= "2. Hausa language\n";
        $response .= "3. Yoruba language\n";
        $response .= "4. Igbo language\n";
        echo "$response";
        }else if ($level == 2 && $textArray[1] == 2 AND $language == 4 ) {
        $response .= "CON Họrọ Asụsụ\n";
        $response .= "1. English language\n";
        $response .= "2. Hausa language\n";
        $response .= "3. Yoruba language\n";
        $response .= "4. Igbo language\n";
        echo "$response";
        }else if ($level == 3 && $textArray[1] == 1 AND $language == 1 ) {
            echo "CON Enter your new pin:";
        }else if ($level == 3 && $textArray[1] == 1 AND $language == 2 ) {
            echo "CON Shigar da sabon mukullin sirri:";
        }else if ($level == 3 && $textArray[1] == 1 AND $language == 3 ) {
            echo "CON Tẹ pinni titun sii:";
        }else if ($level == 3 && $textArray[1] == 1 AND $language == 4 ) {
            echo "CON Tinye ntụtụ ọhụrụ:";
        }else if ($level == 3 && $textArray[1] == 2 AND $language == 1 ) {
            $langs = $textArray[2];
            $update = $conn->query("UPDATE users SET language='$langs' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 1) {
                    echo "END You have successfully changed your language";
                } else {
                 echo "END Network Problem, Try Again Later";   
                }
        }else if ($level == 3 && $textArray[1] == 2 AND $language == 2 ) {
            $langs = $textArray[2];
            $update = $conn->query("UPDATE users SET language='$langs' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 2) {
                    echo "END Kun yi nasarar canza yaren ku";
                } else {
                 echo "END Network Problem, Try Again Later";   
                }
        }else if ($level == 3 && $textArray[1] == 2 AND $language == 3 ) {
            $langs = $textArray[2];
            $update = $conn->query("UPDATE users SET language='$langs' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 3) {
                    echo "END O ti yi ede rẹ pada ni aṣeyọri";
                } else {
                 echo "END Network Problem, Try Again Later";   
                }
        }else if ($level == 3 && $textArray[1] == 2 AND $language == 4 ) {
            $langs = $textArray[2];
            $update = $conn->query("UPDATE users SET language='$langs' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 4) {
                    echo "END Ịgbanwela asụsụ gị nke ọma";
                } else {
                 echo "END Network Problem, Try Again Later";   
                }
        }
        
        
        
        
        else if ($level == 4 && $textArray[1] == 1 AND $language == 1 ) {
            echo "CON Confirm your new pin:";
        }else if ($level == 4 && $textArray[1] == 1 AND $language == 2 ) {
            echo "CON Sake shigar da sabon mukullin sirrin:";
        }else if ($level == 4 && $textArray[1] == 1 AND $language == 3 ) {
            echo "CON Tun tẹ pinni tuntun rẹ sii:";
        }else if ($level == 4 && $textArray[1] == 1 AND $language == 4 ) {
            echo "CON tinyekwa ntụtụ ọhụrụ gị:";
        }else if ($level == 5 && $textArray[1] == 1 AND $language == 1 ) {
            $oldpin = md5($textArray[2]);
            $pin = $textArray[3];
            $confirmPin = $textArray[4];
            if ($pin != $confirmPin AND $language == 1) {
                echo "END Your pins do not match. Please try again";  
    } else {
    include 'dbconnect.php';
    
    // check if old pin is correct

    $checkpin = $conn->query("SELECT * from users WHERE phone='$phoneNumber' AND tpin='$oldpin' ");
    if ($checkpin->num_rows > 0) {
    $hashPin = md5($pin);
    $update = $conn->query("UPDATE users SET tpin='$hashPin' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 1) {
                    echo "END You have successfully changed your pin";
                }
    } else{
                echo "END Old pin is incorrect ";
            }
        }
    }else if ($level == 5 && $textArray[1] == 1 AND $language == 2 ) {
            $oldpin = md5($textArray[2]);
            $pin = $textArray[3];
            $confirmPin = $textArray[4];
            if ($pin != $confirmPin AND $language == 2) {
                echo "END Mukullan sirrin ku ba su dace ba. Da fatan za a sake gwadawa";  
    } else {
    include 'dbconnect.php';
    
    // check if old pin is correct

    $checkpin = $conn->query("SELECT * from users WHERE phone='$phoneNumber' AND tpin='$oldpin' ");
    if ($checkpin->num_rows > 0) {
    $hashPin = md5($pin);
    $update = $conn->query("UPDATE users SET tpin='$hashPin' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 2) {
                    echo "END Kun yi nasarar canza mukullin sirrin ku";
                }
    } else{
                echo "END Tsohon mukullin sirrin ba daidai ba ne ";
            }
        }
    }else if ($level == 5 && $textArray[1] == 1 AND $language == 3 ) {
            $oldpin = md5($textArray[2]);
            $pin = $textArray[3];
            $confirmPin = $textArray[4];
            if ($pin != $confirmPin AND $language == 3) {
                echo "END Awọn pinni rẹ ko baramu. Jọwọ gbiyanju lẹẹkansi";  
    } else {
    include 'dbconnect.php';
    
    // check if old pin is correct

    $checkpin = $conn->query("SELECT * from users WHERE phone='$phoneNumber' AND tpin='$oldpin' ");
    if ($checkpin->num_rows > 0) {
    $hashPin = md5($pin);
    $update = $conn->query("UPDATE users SET tpin='$hashPin' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 3) {
                    echo "END O ti yi pinni rẹ pada ni aṣeyọri";
                }
    } else{
                echo "END Pinni atijọ ko tọ ";
            }
        }
    }else if ($level == 5 && $textArray[1] == 1 AND $language == 4 ) {
            $oldpin = md5($textArray[2]);
            $pin = $textArray[3];
            $confirmPin = $textArray[4];
            if ($pin != $confirmPin AND $language == 4) {
                echo "END Ntụtụ gị adabaghị, Biko nwaa ọzọ";  
    } else {
    include 'dbconnect.php';
    
    // check if old pin is correct

    $checkpin = $conn->query("SELECT * from users WHERE phone='$phoneNumber' AND tpin='$oldpin' ");
    if ($checkpin->num_rows > 0) {
    $hashPin = md5($pin);
    $update = $conn->query("UPDATE users SET tpin='$hashPin' WHERE phone='$phoneNumber'");
            if ($update === TRUE AND $language == 4) {
                    echo "END Ịgbanwela pin gị nke ọma";
                }
    } else{
                echo "END Ntụtụ ochie ezighi ezi ";
            }
        }
    }
}
}

    
    public function addCountryCodeToPhoneNumber($phone)
    {
        return Util::$COUNTRY_CODE . substr($phone, 1);
    }}
?>