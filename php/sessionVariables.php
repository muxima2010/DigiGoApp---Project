<?php
# http://localhost/digiGoApp/php/sessionVariables.php

require_once("../php/restrictAccess.php");

echo "idUser = {$_SESSION['idUser']} <br>";
echo "email = {$_SESSION['email']} <br>";


?>
