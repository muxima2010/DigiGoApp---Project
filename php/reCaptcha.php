<?php
    if($_POST['submit']){
        $secretkey = "6LegcUkbAAAAAFOdq1Q-JpzbPfuCLY6ZI5s66EXP";
        $responseKey = $_POST['g-recaptcha-response'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$responseKey";
        
        $response = file_get_contents($url);
        $response = json_decode($response);

        if($response->success){
            $responseBack = "success";
        }else{
            $responseBack = "Invalid Captcha, please try again!";
        }
        echo $responseBack;
        exit();
    }
?>