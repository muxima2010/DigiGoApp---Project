<?php
require_once("../php/connection.php");

if($_GET['signinPsw']){
    $token = $_REQUEST['token'];
    $email = $_REQUEST['email'];
    $psw = sha1(addslashes($_REQUEST['signinPsw']));
    
    $tableUser="user";
    $tableToken="user_token";
    $sql = "SELECT idUser, $tableToken.id FROM $tableUser, $tableToken WHERE $tableToken.idUser = $tableUser.id and $tableUser.email = '$email' AND $tableToken.token = '$token'";
    $query=mysqli_query($conn, $sql) or die ($sql);
    $total=mysqli_num_rows($query);
    $fetch = mysqli_fetch_assoc($query);
    $idUser = $fetch['idUser'];

    if($total > 0){
        $sql = "CALL p_reset_password ('$psw', $idUser, '$token')";
        mysqli_query($conn, $sql) or die($sql);

        $path = "http://localhost/digiGoApp/login.html?msg8=newPasswordSet";
    } else{
        $path = "http://localhost/digiGoApp/login.html?msg9=PasswordAlreadySet";
    }
    header("Location: $path");
    }


?>