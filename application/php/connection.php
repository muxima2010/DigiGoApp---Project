<?php
# http://localhost/digiGoApp/php/connection.php
# Connection to dbo.digigoapp

define("host","localhost");
define("username","root");
define("psw", "");
define("db", "dbo.digigoapp");
define("msg", "Connection to DB fail!");
$conn = mysqli_connect(host, username, psw, db) or die (msg);

?>
