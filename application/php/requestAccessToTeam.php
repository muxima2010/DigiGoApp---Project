<?php
# http://localhost/digiGoApp/application/php/requestAccessToTeam.php
require_once("../php/restrictAccess.php");


#-- Check if user already have access to team -- 
if(isset($_GET['idTeam'])){
  require_once("../php/connection.php");
  $idTeam = $_GET['idTeam'];
  $idUser = $_SESSION['idUser'];
  $sql = "SELECT * FROM team_user_level WHERE idTeam = $idTeam AND idUser =  $idUser";
  $query = mysqli_query($conn, $sql) or die($sql);
  $total = mysqli_num_rows($query);

  if($total > 0){
    $path ="../findTeam.php?msg15=alreadyHaveAccessToTeam";
  } else {
    # Check if user as a request in status 'requested'
    $sqlReq = "SELECT * FROM team_user_request WHERE idUSer = $idUser AND idTeam = $idTeam 
    AND idRequestSatus = 1 LIMIT 1";
    $queryReq = mysqli_query($conn, $sqlReq) or die($sqlReq);
    $totalReq = mysqli_num_rows($queryReq);

    if($totalReq > 0){
      # If user as requested pending
      $path = "../findTeam.php?msg17=youAlreadyRequested";
    } else {
      # If user Doen's have have a pending request
      $sqlReg = "INSERT INTO team_user_request (idUser, idTeam, idRequestSatus) VALUES ('$idUser', '$idTeam', 1)";
      $queryReg = mysqli_query($conn, $sqlReg) or die($sqlReg);
      

      # Send email notify to team
      $sql = "SELECT * from v_user WHERE id = $idUser";
      $query = mysqli_query($conn, $sql) or die($sql);
      $fUser = mysqli_fetch_assoc($query);

      $sqlTeam = "SELECT * FROM v_teams WHERE id = $idTeam";
      $queryTeam = mysqli_query($conn, $sqlTeam) or die($sqlTeam);
      $fTeam = mysqli_fetch_assoc($queryTeam);

      $to = $fTeam['email'];
	    $teamName = $fTeam['team_name'];
	    $firstName = $fUser['first_name'];
      $lastName = $fUser['last_name'];
      $userEmail = $fUser['email'];

      $path = "../php/email/emailTeamRequest.php?to=$to&teamName=$teamName&firstName=$firstName&lastName=$lastName&userEmail=$userEmail";
    }
  }
  header("Location: $path");
}

?>