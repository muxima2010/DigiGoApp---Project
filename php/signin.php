<?php
# http://localhost/digiGoApp/php/signin.php

if(isset($_POST['signEmail'])){
    require_once("../php/connection.php");
    $firstName = ucwords(addslashes($_POST['firstName']));
    $lastName = ucwords(addslashes($_POST['lastName']));
    $email = strtolower(addslashes($_POST['signEmail']));
    $psw = addslashes($_POST['signinPsw']);
    $table = "user";
    $sql = "SELECT id FROM $table WHERE email='$email'";
    $query=mysqli_query($conn, $sql) or die ($sql);
    $total = mysqli_num_rows($query);

    if ($total==0){
        # -- Generate Token -- 
        $chars = '1234567890abcdefghijklmnopqrstuvxywz_';
        $maxChars = strlen($chars)-1;
        $token = '';
        for ($i = 0; $i < 40; $i++){
            $token .= $chars[mt_rand(0, $maxChars)];
        }
        $sql = "CALL p_insert_new_user ('$firstName', '$lastName', '$email', '$psw', '$token')";
        mysqli_query($conn, $sql) or die ($sql);

        
        $path="http://localhost/digiGoApp/php/email/newAccountEmail.php?email=$email&token=$token";
    } else {
        $path="http://localhost/digiGoApp/login.html?msg2=emailAlreadyExist";
    }
}else{
    $path="../signin.html";
}
header("location:$path");

?>