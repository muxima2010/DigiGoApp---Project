<?php
# http://localhost/digiGoApp/php/forgot-password.php


if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    require_once("../php/connection.php");
    $table = 'user';
    $sql = "SELECT id, email FROM $table WHERE email = '$email'";
    $query = mysqli_query($conn, $sql) or die ($sql);
    $total = mysqli_num_rows($query);

    if($total == 0){
        $path="../passwordRecovery.html?msg8=emailNotValid";
    } else {
        $fetch=mysqli_fetch_assoc($query);
        $email = $fetch['email'];
        $idUser = $fetch['id'];

        $chars = '1234567890abcdefghijklmnopqrstuvxywz_';
        $maxChars = strlen($chars)-1;
        $token = '';
        for ($i = 0; $i < 40; $i++){
            $token .= $chars[mt_rand(0, $maxChars)];
        }
        $sql = "INSERT INTO user_token (idUser, token) VALUES ($idUser, '$token')";
        mysqli_query($conn, $sql) or die ($sql);

        $sqlLog = "INSERT INTO user_logs_request_psw_reset (idUser, operation) VALUES ($idUser, 'REQUEST')";
        mysqli_query($conn, $sqlLog) or die ($sqlLog);

        $path = "../php/email/resetAccountPsw.php?email=$email&token=$token";
    }
} else {
    $path = "login.html?msg6=noLogin";
}
header("location: $path");












?>