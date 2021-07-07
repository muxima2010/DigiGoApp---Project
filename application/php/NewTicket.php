<?php
# http://localhost/digiGoApp/application/php/NewTicket.php
require_once("../php/restrictAccess.php");

if(isset($_POST['newTicket'])){
    require_once("../php/connection.php");
    $idUser = $_SESSION['idUser'];
    $idTeam = $_POST['team'];
    $idCategory = $_POST['category'];
    $idPriority = $_POST['priority'];
    $oldTicket = $_POST['oldTicket'];
    $subject = addslashes(strtoupper($_POST['subject']));
    $message = $_POST['message'];
    $file = $_POST['fileToUpload'];

    if($idTeam != 0){
        $sql ="CALL p_insert_new_ticket ($idUser, $idTeam, $idCategory, $idPriority, '$oldTicket', '$subject', '$message', '$file')";
        $query = mysqli_query($conn, $sql)or die($sql);
        # Possibility to send a email notification
        $path="http://localhost/digiGoApp/application/createNewTicket.php?msg32#response";
    }else {
        $path="http://localhost/digiGoApp/application/createNewTicket.php?msg34#response";
    }
}else{
    $path="http://localhost/digiGoApp/application/createNewTicket.php?msg33#response";
}
header("Location: $path");
?>