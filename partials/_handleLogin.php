<?php
    $showError = "false";
    require_once '_header.php';
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // Token Verification - line #7 - #24 & #107
        if(!isset($_POST['token']))
        {
            //Token Not Found
            header('Location: /forum/index.php?error=CSRF Token Missing');
            echo "<script>alert('CSRF Token Missing')</script>";
            $_SESSION['loggedin'] = false;
            $showError = "CSRF Token Missing";
        }
        else if(!empty($_POST['token']) && $_SESSION['token'] != $_POST['token'])
        {
            //Token Invalid
            header('Location: /forum/index.php?error=Authentication Failed');
            echo "<script>alert('CSRF Token Authentication FAILED!!')</script>";
            $_SESSION['loggedin'] = false;
            $showError = "CSRF Token Mismatch";
        }
        else
        {
            include "_dbconnect.php";
            $email = $_POST['loginEmail'];
            $pass = $_POST['loginPass'];
            $token = $_POST['token'];
            
                //SQL Injection prevention
                // $username = stripslashes($username);
                // $username = mysqli_real_escape_string($conn, $username);
            $pass = stripslashes($pass);
            $pass = mysqli_real_escape_string($conn, $pass);
            
            //  SQL Injection vulnerable code
            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE  user_email = '$email' and user_pass = '$pass'");
            $numRows = mysqli_num_rows($result);
            //SELECT * FROM `users` WHERE  user_email = '$email' and user_pass = '' or '1 ' = '1'
            //' or '1 ' = '1
            // if($numRows == 1)
            
                if($numRows)
                {
                    $row = mysqli_fetch_assoc($result);
                    
                    // if(password_verify($pass, $row['user_pass']))   //used when password is hash
                    
                    session_start();    //starts new session after authentication
                    $_SESSION['loggedin'] = true;
                    $_SESSION['useremail'] = $email;
                    
                    //To perform Session Fixation,
                    // Step 1: Declare SessionID variable and input session_id in it.
                    // Step 2: POST SessionID value into the redirected URL as soon as the user logs in.
                    // [Assuming victim needs to share this URL and attacker gets it somehow]
                    // Step 3: Get the SessionID from the URL and edit his own SessionID in "Inspect Element -> Application -> PHPSESSID"
                    // Step 4: Attacker makes use of the same session and directly gets logged in to victim's account
                    
                    
                    $sessionID = session_id();
                    echo "logged in ".$email;
                    header("Location: /forum/index.php?session=$sessionID&token=$token");
                    // header("Location: /forum/index.php");
                    
                    // To prevent Session Fixation attack
                    session_regenerate_id(true);    // To change session ID after login
                    
                    exit();
                }
                else
                {
                    echo "Incorrect email or password";
                    $showError = "Incorrect email or password";
                }
                
                
                // SQL Injection PROTECTIVE code
            // $sql = "SELECT * FROM `users` WHERE user_email='$email'";
            // $result = mysqli_query($conn, $sql);
            // $numRows = mysqli_num_rows($result);
            // if($numRows == 1)   //Exactly 1 email must be there in order to login
            // {
            //     $row = mysqli_fetch_assoc($result);
            //     // if(password_verify($pass, $row['user_pass']))   //used when password is hash
            //     if($pass == $row['user_pass'])
            //     {
            //         session_start();    //starts new session after authentication
            //         $_SESSION['loggedin'] = true;
            //         $_SESSION['useremail'] = $email;
            //         // $sessionID = session_id();
            //         echo "logged in ".$email;
            //         // header("Location: /forum/index.php?session=$sessionID");
            //         header("Location: /forum/index.php");

            //         // To prevent Session Fixation attack
            //         // session_regenerate_id(true);    // To change session ID after login
                    
            //         exit();
            //     }
            //     else
            //     {
            //         echo "Incorrect email or password";
            //         $showError = "Incorrect email or password";
            //     }
            // }
        }
    }
?>