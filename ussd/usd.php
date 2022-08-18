<?php

    class Menu{
        protected $text;
        protected $sessionId;

        function __construct(){}

        public function mainMenuRegistered($name){
            //shows initial user menu for registered users
            $response = "Welcome " . $name . " Reply with\n";
            $response .= "1. Create Account\n";
            $response .= "2. Send Money\n";
            $response .= "3. Receive Money\n";
            return $response;
        }

        public function mainMenuUnRegistered(){
            //shows initial user menu for unregistered users
            $response = "CON Welcome to Kudikan Wallet. Reply with\n";
            $response .= "1. Register\n";
            echo $response;
        }

        public function registerMenu($textArray, $phoneNumber){
          //building menu for user registration 
            $level = count($textArray);
           if($level == 1){
                echo "CON Please enter your full name:";
           } else if($level == 2){
                echo "CON Please enter set you PIN:";
           }else if($level == 3){
                echo "CON Please re-enter your PIN:";
           }else if($level == 4){
                $name = $textArray[1];
                $pin = $textArray[2];
                $confirmPin = $textArray[3];
                if($pin != $confirmPin){
                    echo "END Your pins do not match. Please try again";
                }else{
                    //connect to DB and register a user. 
                    echo "END You have been registered";
                }
           }
        }

        public function sendMoneyMenu($textArray, $senderPhoneNumber){
            //building menu for user registration 
            $level = count($textArray);
            $receiver = null;
            $nameOfReceiver = null;
            $response = "";
            if($level == 1){
                echo "CON Enter mobile number of the receiver:";
            }else if($level == 2){
                echo "CON Enter amount:";
            }else if($level == 3){
                echo "CON Enter your PIN:";
            }else if($level == 4){
                $receiverMobile = $textArray[1];
                $receiverMobileWithCountryCode = $this->addCountryCodeToPhoneNumber($receiverMobile);
                
                $response .= "Send " . $textArray[2] . " to <Put a person's name here> - " . $receiverMobile . "\n";
                $response .= "1. Confirm\n";
                $response .= "2. Cancel\n";
                $response .= Util::$GO_BACK . " Back\n";
                $response .= Util::$GO_TO_MAIN_MENU .  " Main menu\n";
                echo "CON " . $response;
            }else if($level == 5 && $textArray[4] == 1){
                //a confirm
                //send the money plus
                //check if PIN correct
                //If you have enough funds including charges etc..
                $pin = $textArray[3];
                $amount = $textArray[2];

                //connect to DB
                //Complete transaction

                echo "END We are processing your request. You will receive an SMS shortly";


            }else if($level == 5 && $textArray[4] == 2){
                //Cancel
                echo "END Canceled. Thank you for using our service";
            }else if($level == 5 && $textArray[4] == Util::$GO_BACK){
                echo "END You have requested to back to one step - re-enter PIN";
            }else if($level == 5 && $textArray[4] == Util::$GO_TO_MAIN_MENU){
                echo "END You have requested to back to main menu - to start all over again";
            }else {
                echo "END Invalid entry"; 
            }
        }

        public function withdrawMoneyMenu($textArray){
            //TODO
            echo "END To be implemented";
        }

        public function checkBalanceMenu($textArray){
            echo "END To be implemented";
        }
?>