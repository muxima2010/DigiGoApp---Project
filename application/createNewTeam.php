<?php
# http://localhost/digiGoApp/application/createNewTeam.php

require_once("../php/restrictAccess.php");

# Fetch Team Category from DB
require_once("../php/connection.php");
$table = "team_type";
$sql="SELECT * FROM $table ORDER BY id";
$query=mysqli_query($conn, $sql) or die($sql);
$total=mysqli_num_rows($query);

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


            <!-- Show Result Message to user after Created Team -->
            <?php if(isset($_GET['msg12'])){?>
              <div id="messageSuccess" class="alert alert-success alert-dismissible" style="margin-top:30px">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Great Job!</strong> You created New Team with success.<br>
                Please check team email account to activate nofitications by email.
              </div>
              <!-- Top Image -->
              <?php require("createTeamTopImage.php");?>
              <!-- Forms -->
              <?php require("createNewTeamForm.php"); ?>
            <?php } else if(isset($_GET['msg11'])){?>
              <div id="messageSuccess" class="alert alert-danger alert-dismissible" style="margin-top:30px">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Seems that we have an issue.<br>
                Please try again later.
              </div>
              <!-- Top Image -->
              <?php require("createTeamTopImage.php");?>
              <!-- Forms -->
              <?php require("createNewTeamForm.php"); ?>
            <?php } else { ?> 
              <!-- Top Image -->
              <?php require("createTeamTopImage.php");?>
              <!-- Forms -->
              <?php require("createNewTeamForm.php"); ?>
            <?php } ?>
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
