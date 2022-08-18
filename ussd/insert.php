 <?php
 include 'dbconnect.php';
                $insert=mysqli_query($conn, "INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `state`, `lga`, `address`, `gender`, `picture`, `nin`, `language`, `bal`, `st`, `dt`) VALUES (NULL, 'qqq', 'rerf', 'ttt', 't', 'ttt', 'ttt', 'ttt', 'ttt', 'tt', 'tt', 'ttt', '10', 'tfff'");
               if ($insert === TRUE) {
                    echo "END You have been registered";
                } else {
                    echo "Error: ". $insert->error;
                    echo "END Network problem, please try again later";
                }
                ?>
                