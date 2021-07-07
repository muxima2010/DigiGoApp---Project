<?php
# http://localhost/digiGoApp/php/login.php

if(isset($_POST['email'])){
    require_once("../php/connection.php");
    $email = addslashes($_POST['email']);
    $psw = sha1(addslashes($_POST['psw']));
    # Colect data from DBO
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$psw'";
    $query = mysqli_query($conn, $sql) or die ($sql);
    $total = mysqli_num_rows($query);
    $fetch = mysqli_fetch_assoc($query);
    $idStatus = $fetch['idStatus'];

    if($total==0){
        $path="../login.html?msg1=loginNotValid";   
    } else if($idStatus == 1){
        $path="../emailNotVerified.html?msg2=emailNotVerified";
    }else {
        #-----------------LOGIN----------------------------
        session_start();
        $_SESSION['idUser'] = $fetch['id'];
        $_SESSION['email'] = $fetch['email'];
        #---------------------------------------------------
        #-----------------REGISTER LOG---------------------
        $idUser =  $_SESSION['idUser'];
        $sqlLog = "INSERT INTO user_logs_session (idUser, operation) VALUES ($idUser, 'LOGIN')";
        mysqli_query($conn, $sqlLog) or die($sqlLog);
        
        #---------------PRIVILEGIOS-------------------------
        /*$idUser = $_SESSION['idUser'];
        $view = "v1_user_privilegio";
        $sql = "SELECT idPrivilegio, privilegio FROM $view WHERE idUser = $idUser";
        $query = mysqli_query($conn, $sql) or die ($sql);
        $fecth = mysqli_fetch_assoc($query);
        $_SESSION['idPrivilegio'] = $fecth['idPrivilegio'];
        $_SESSION['privilegio'] = $fecth['privilegio'];*/
        #---------------------------------------------------

        $path="../application/mainMenu.php";
    }

   
} else {

    $path="login.html?msg6=noLogin";
}

header("location: $path");

?>