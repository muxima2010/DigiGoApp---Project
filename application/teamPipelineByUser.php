<?php
# http://localhost/digiGoApp/application/teamPipeline.php
require_once("../php/restrictAccess.php");

//-- Get data from Team by team id -- 
if(isset($_GET['idTeam'])){
    require_once("../php/connection.php");
    $idTeam = $_GET['idTeam'];
    $table = "v_teams";
    $sql = "SELECT * FROM $table WHERE id = $idTeam"; 
    $query = mysqli_query($conn, $sql) or die($sql);
    $total = mysqli_num_rows($query);

    //-- Get data from team by Level of User --
    $idUser = $_SESSION['idUser'];
    $sqlLevel = "SELECT * FROM team_user_level WHERE idTeam = $idTeam AND idUser = $idUser";
    $queryLevel = mysqli_query($conn, $sqlLevel) or die($sqlLevel);
    $fetch = mysqli_fetch_assoc($queryLevel);
    $idLevel = $fetch['idLevel'];
    
    //-- Get data from user by level --
    $sqlUserLevel = "SELECT * FROM user_level WHERE id = $idLevel";
    $queryUserLevel = mysqli_query($conn, $sqlUserLevel) or die($sqlUserLevel);
    $fetchUserLevel = mysqli_fetch_assoc($queryUserLevel);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>DigiGo App - Ticket Support for Teams</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/myStyles.css">
    
    

  </head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

      <!-- Main -->
        <div id="main">
          <div class="inner">

            <!-- Header -->
            <?php require_once("headerBar.php");?>

            <!-- Show Result Message to user -->
                <?php if(isset($_GET['msg35'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Saved!</strong><br>
                </div>
                <?php } else if(isset($_GET['msg36'])){?>
                <div id="response" class="alert alert-danger alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Seems that we have an issue.<br>
                   Please try again later.
                </div>
                <?php } else if(isset($_GET['msg37'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ticket Moved!</strong> You move move ticket to BACKLOG!.<br>
                </div>
                <?php } else if(isset($_GET['msg38'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ticket Moved!</strong> You move move ticket to WORKING PROGRESS!.<br>
                </div>
                <?php } else if(isset($_GET['msg39'])){?>
                <div id="response" class="alert alert-warning alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ticket Closed!</strong> You jsut CLOSED your ticket!.<br>
                </div>
                <?php } ?>
              

            <!-- Top Page -->
            <section class="services p-0 m-0 mt-4">
                <div class="container-fluid p-0 m-0">
                <?php if($total>0){
                    $f = mysqli_fetch_assoc($query);?>
                    <h4><?php echo $f['team_name'];?></h4>
                    <p>Level: <?php echo $fetchUserLevel['level'];?></p>
                <?php } ?>
                </div>
                </section>

            <!-- Ticket Pipeline Selector-->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Backlog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teamPipelineWPByUser.php?idTeam=<?php echo $idTeam;?>">Working Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teamPipelineClByUser.php?idTeam=<?php echo $idTeam;?>">Closed</a>
                </li>
            </ul>

            <!-- Show ALL ticket to ADMNIN that are in Backlog-->
            <?php 
                $sqlTicket ="SELECT * FROM ticket, ticket_info_status WHERE idTeam = $idTeam AND idStatus = 1";
                $queryTicket = mysqli_query($conn, $sqlTicket)or die($sqlTicket);
                $fidTicket = mysqli_fetch_assoc($queryTicket);

                $sqlTicketCard = "SELECT * FROM v_ticket_card WHERE status = 'Open' AND idTeam = $idTeam AND idOwner = $idUser ORDER BY idTicket ASC";
                $queryTicketCard = mysqli_query($conn, $sqlTicketCard)or die($sqlTicketCard);
                $totalTi = mysqli_num_rows($queryTicketCard);


                if($totalTi > 0){
                    while($fTicket = mysqli_fetch_assoc($queryTicketCard)){
                      $idOwner = $fTicket['idOwner'];
                      $sqlName = "SELECT * FROM v_team_members WHERE id = $idOwner AND idTeam = $idTeam limit 1";
                      $queryName = mysqli_query($conn, $sqlName)or dir($sqlName);
                      $fetchName = mysqli_fetch_assoc($queryName);
                        require("teamTicket.php");
                 } } ?>
            
          </div>
        </div>

      <!-- Sidebar -->
      <?php require_once("sideBarMenu.php");?>

    </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>
