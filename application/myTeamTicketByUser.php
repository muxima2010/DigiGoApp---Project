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
                <?php if(isset($_GET['msg40'])){?>
                <div id="response" class="alert alert-warning alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ticket Close!</strong> You have closed your ticket with success.<br>
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
            <h5 class="mt-4">My Tickets</h5>
            

            <!-- Show ALL ticket to ADMNIN that are in Backlog-->
            <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">N.º</th>
                        <th scope="col">SUBJECT</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">CREATED</th>
                        <th scope="col">DETAIL</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php 
                  $sql = "SELECT * FROM ticket WHERE idUser = $idUser ORDER BY id ASC";
                  $query = mysqli_query($conn, $sql)or die($sql);
                  $total = mysqli_num_rows($query);

                  if($total > 0){
                    while($f = mysqli_fetch_assoc($query)){
                      $idTicket = $f['id'];
                      $sqlData = "SELECT * FROM v_ticket_card WHERE idTicket = $idTicket";
                      $queryData = mysqli_query($conn, $sqlData)or die($sqlData);
                      $fData = mysqli_fetch_assoc($queryData);
                      ?>
                    <tr>
                      <th scope="row"><?php echo $fData['idTicket'];?></th>
                      <td><?php echo $fData['subject'];?></td>
                      <td><?php echo $fData['status'];?></td>
                      <td><?php echo $fData['dateReg'];?></td>
                      <td><a class="btn btn-primary" href="ticketCardClient.php?idTicket=<?php echo $fData['idTicket'];?>">VIEW</a></td>
                    </tr>
                <?php } } ?>
              </tbody>
            </table>
            <div class="container pl-0 mt-5">
                  <div class="col pl-0 ml-0">
                    <div class="col-md-6 pl-0 ">
                      <a type="submit" class="btn btn-secondary" href="myWorkspace.php?idTeam=<?php echo $idTeam;?>">BACK</a>
                    </div>
                  </div>
                </div>
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
