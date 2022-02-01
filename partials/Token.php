<?php
    //CSRF Token class
    class Token
    {
        //CSRF Token Generation & Inclusion function
        public static function generate()
        {
            //Generate token
            // $token = md5(time());

            //Save in session
            // return $_SESSION["token"] = $token;
            
            //Creating hidden field
            // echo '<input type="hidden" name="token" value="$token" />';

            return $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
        }
        //CSRF Token Validation function
        public static function check($token)
        {
            //Validate token
            return isset($_SESSION["token"]) && $_SESSION["token"] == $token;
            
            // if(isset($_SESSION['token']) && $token === $_SESSION['token'])
            // {
            //     unset($_SESSION['token']);
            //     return true;
            // }
            // return false;
        }
    }
?>