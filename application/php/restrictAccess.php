<?php
# http://localhost/digiGoApp/php/restrictAccess.php

if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['idUser'])){
    header("location:../login.html");
}

?>