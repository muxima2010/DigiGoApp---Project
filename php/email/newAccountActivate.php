<?php
# http://localhost/digiGoApp/php/email/newAccountActivate.php

if(isset($_GET['token'])){
    $token=$_GET['token'];
    $email=$_GET['email'];
    require_once("../connection.php");
    $tableUser="user";
    $tableToken="user_token";
    $sql = "SELECT idUser, $tableToken.id FROM $tableUser, $tableToken WHERE $tableToken.idUser = $tableUser.id and $tableUser.email = '$email' AND $tableToken.token = '$token'";
    $query=mysqli_query($conn, $sql) or die ($sql);
    $total=mysqli_num_rows($query);

    if($total == 1){
        $fetch = mysqli_fetch_assoc($query);
        $idUser=$fetch['idUser'];
        $idToken = $fetch['id'];
        $sql = "CALL p_validate_user ('$idUser', '$idToken')";
        mysqli_query($conn, $sql) or die($sql);
        
        $path = "http://localhost/digiGoApp/login.html?msg4=newAccountActivated";
    }else {
        $path = "http://localhost/digiGoApp/login.html?msg5=accountAlreadyActivated";
    }

}else{

    $path="http://localhost/digiGoApp/index.html";
}

header("location:$path");

?>