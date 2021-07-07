<?php
# http://localhost/digiGoApp/application/php/saveTicket.php

if(isset($_POST['saveTicket'])){
   require_once("../php/connection.php");
   $idTeam = $_REQUEST['idTeam'];
   $idTicket = $_REQUEST['idTicket'];
   $idCategory = $_REQUEST['category'];
   $idPriority = $_REQUEST['priority'];
   $idOwner = $_REQUEST['owner'];
   $comment = $_REQUEST['comment'];
   

   $sql = "UPDATE ticket_info_Status SET idOwner = $idOwner, comment = '$comment'  WHERE idTicket = $idTicket";
   $query = mysqli_query($conn, $sql)or die($sql);
   

   $sqlTicket = "UPDATE ticket SET idCategory = $idCategory, idPriority = $idPriority WHERE id = $idTicket";
   $queryTicket = mysqli_query($conn, $sqlTicket)or die($sqlTicket);
   

   
      $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg35#response";
   } else if(isset($_POST['closeTicket'])){
      require_once("../php/connection.php");
      $idTeam = $_REQUEST['idTeam'];
      $idTicket = $_REQUEST['idTicket'];
      $idCategory = $_REQUEST['category'];
      $idPriority = $_REQUEST['priority'];
      $idOwner = $_REQUEST['owner'];
      $comment = $_REQUEST['comment'];

      $sql = "UPDATE ticket_info_Status SET idOwner = $idOwner, comment = '$comment'  WHERE idTicket = $idTicket";
      $query = mysqli_query($conn, $sql)or die($sql);
      

      $sqlTicket = "UPDATE ticket SET idCategory = $idCategory, idPriority = $idPriority WHERE id = $idTicket";
      $queryTicket = mysqli_query($conn, $sqlTicket)or die($sqlTicket);
      
      
      $sqlClose = "CALL p_update_closed_ticket ($idTicket)";
      $queryClose = mysqli_query($conn, $sqlClose)or die($sqlClose);
   
      $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg39#response";

   }else if(isset($_POST['closeTicketByUser'])){
      require_once("../php/connection.php");
      $idTeam = $_REQUEST['idTeam'];
      $idTicket = $_REQUEST['idTicket'];
      $idOwner = $_REQUES['owner'];
      $comment = $_REQUEST['comment'];
      

      $sql = "UPDATE ticket_info_Status SET comment = '$comment'  WHERE idTicket = $idTicket";
      $query = mysqli_query($conn, $sql)or die($sql);
      
      $sqlClose = "CALL p_update_closed_ticket ($idTicket)";
      $queryClose = mysqli_query($conn, $sqlClose)or die($sqlClose);
   
      $path = "http://localhost/digiGoApp/application/myTeamTicketByUser.php?idTeam=$idTeam&msg40#response";
   }else{
      $path = "http://localhost/digiGoApp/application/teamPipeline.php?idTeam=$idTeam&msg36#response";
   }
   header("Location: $path");
   
   


?>