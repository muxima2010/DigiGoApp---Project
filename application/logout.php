<?php

if(!isset($_SESSION)){
    session_start();
}
require_once("../php/connection.php");
$idUser = $_SESSION['idUser'];
$sql = "CALL p_logout_user ('$idUser')";
mysqli_query($conn, $sql) or die ($sql);

session_destroy();
header("location:../login.html?msg=lougOut");

?>