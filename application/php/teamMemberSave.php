<?php
# http://localhost/digiGoApp/application/php/teamMemberSave.php
require_once("../php/restrictAccess.php");

if(isset($_GET['saveTeamMember'])){
    require_once("../php/connection.php");
    $idUser = $_REQUEST['idUser'];
    $idTeam = $_REQUEST['idTeam'];
    $idLevel = $_REQUEST['userLevel'];
    $sql = "UPDATE team_user_level SET idLevel = $idLevel WHERE idUser = $idUser AND idTeam = $idTeam";
    $query = mysqli_query($conn, $sql)or die($sql);


    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg28#response";
} else if(isset($_GET['deleteMember'])){
    require_once("../php/connection.php");
    $idUser = $_REQUEST['idUser'];
    $idTeam = $_REQUEST['idTeam'];

    $sql = "DELETE FROM team_user_level WHERE idUser = $idUser AND idTeam = $idTeam";
    $query = mysqli_query($conn, $sql)or die($sql);

    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg29#response";
} else{
    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg30#response";
}

header("Location: $path");
?>