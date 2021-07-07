<?php
# http://localhost/digiGoApp/application/php/teamMemberSave.php
require_once("../php/restrictAccess.php");

if(isset($_GET['acceptMember'])){
    require_once("../php/connection.php");
    $idUser = $_REQUEST['idUser'];
    $idTeam = $_REQUEST['idTeam'];
    $idRequest = $_REQUEST['idRequest'];
    $idLevel = $_REQUEST['userLevel'];

    $sql = "UPDATE team_user_request SET idRequestSatus = 2 WHERE idUser = $idUser AND idTeam = $idTeam AND team_user_request.id = $idRequest";
    $query = mysqli_query($conn, $sql)or die($sql);

    $sqlNew = "INSERT INTO team_user_level (idUser, idTeam, idLevel) VALUES('$idUser', '$idTeam', '$idLevel')";
    $queryNew = mysqli_query($conn, $sqlNew)or die($sqlNew);

    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg31#response";
    
} else if(isset($_GET['denyMember'])){
    require_once("../php/connection.php");
    $idUser = $_REQUEST['idUser'];
    $idTeam = $_REQUEST['idTeam'];
    $idLevel = $_REQUEST['userLevel'];
    $sql = "UPDATE team_user_request SET idRequestSatus = 3 WHERE idUser = $idUser AND idTeam = $idTeam";
    $query = mysqli_query($conn, $sql)or die($sql);

    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg32#response";
} else{
    $idTeam = $_REQUEST['idTeam'];
    $path = "http://localhost/digiGoApp/application/teamMembers.php?idTeam=$idTeam&msg30#response";
}

header("Location: $path");
?>