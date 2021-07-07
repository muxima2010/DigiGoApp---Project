<?php
# http://localhost/digiGoApp/application/moveCard.php
require_once("../php/restrictAccess.php");

if(isset($_GET['idTicket'])){
    require_once("../php/connection.php");
    $idTicket = $_REQUEST['idTicket'];
    $idTeam = $_REQUEST['idTeam'];

    if(isset($_GET['moveToBC'])){
        $sql = "UPDATE ticket_info_status SET idStatus = 1 WHERE idTicket = $idTicket";
        $query = mysqli_query($conn, $sql)or die($sql);

        $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg37#response";
    } else if(isset($_GET['moveToWP'])){
        $sql = "UPDATE ticket_info_status SET idStatus = 2 WHERE idTicket = $idTicket";
        $query = mysqli_query($conn, $sql)or die($sql);

        $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg38#response";

    } else if(isset($_GET['closeTicket'])){
        $date = time();
        $sql = "CALL p_update_closed_ticket ($idTicket)";
        $query = mysqli_query($conn, $sql)or die($sql);

        

        $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg39#response";

    } else{
        $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg36#response";
    }
    header("Location: $path");
}
?>