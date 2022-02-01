<?php
    $showError = "false";   //as a string value, not as boolean
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include '_dbconnect.php';
        $user_email = $_POST['signupEmail'];
        $pass = $_POST['signupPassword'];
        $cpass = $_POST['signupcPassword'];

        //Check whether email already exists
        $existSql = "SELECT * FROM `users` WHERE user_emal = '$user_email'";
        $result = mysqli_query($conn, $existSql);
        // $numRows = mysqli_num_rows($result);
        if($result !== false)
        {
            $showError = "e-mail already in use";
        }
        else
        {
            if($pass == $cpass)
            {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                //password_hash -> function to generate hash of password using PASSWORD_DEFAULT policy

                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$pass', current_timestamp());";
                // This will store password as text format only -> needed for SQL Injection attack

                //To protectfrom SQL Injection, replace $pass -> $hash

                $result = mysqli_query($conn, $sql);
                // if ( false===$result ) {
                //     printf("error: %s\n", mysqli_error($conn));
                //   }
                if($result)
                {
                    $showAlert = true;
                    //To redirect to Home Page,
                    header("Location: /forum/index.php?signupsuccess=true");
                    exit(); // To exit Code [used to debug URL]
                }
            }
            else
            {
                $showError = "Passwords DO NOT match";
            }
        }
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");
        echo 'alert('.$showError.')';
    }
?>