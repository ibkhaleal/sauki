<?php
    include_once('../config.php');

    $userid = $_GET['phone'];
    $select = "SELECT * FROM appointments WHERE userid = '".$userid."'";
    $selected = mysqli_query($link,$select);
    while($data = mysqli_fetch_array($selected)){
        $phone = $data['userid'];
        $date = $data['datetime'];

        $get = "SELECT * FROM users WHERE phone = '".$userid."'";
        $got = mysqli_query($link,$get);
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