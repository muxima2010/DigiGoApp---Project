<?php
# http://localhost/digiGoApp/application/teamMembers.php
require_once("../php/restrictAccess.php");

# Get data from DB of user members by team
if($_GET['idTeam']){
    require_once("../php/connection.php");
    $idTeam = $_GET['idTeam'];

    $sqlTeam = "SELECT team_name FROM v_team_members WHERE idTeam = $idTeam";
    $queryTeam = mysqli_query($conn, $sqlTeam) or die($sqlTeam);
    $totalTeam = mysqli_num_rows($queryTeam);

    $sql = "SELECT * FROM v_team_members WHERE idTeam = $idTeam";
    $query = mysqli_query($conn, $sql) or die($sql);
    $total = mysqli_num_rows($query); 
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
          <div class="inner pl-5 pr-5">

                <!-- Header -->
                <?php require_once("headerBar.php");?>

                <!-- Show Result Message to user after Created Team -->
                <?php if(isset($_GET['msg28'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Saved!</strong><br>
                </div>
                <?php } else if(isset($_GET['msg29'])){?>
                <div id="response" class="alert alert-warning alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>It's Done!</strong> You have removed with success team member.<br>
                </div>
                <?php } else if(isset($_GET['msg30'])){?>
                <div id="response" class="alert alert-danger alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Seems that we have an issue.<br>
                   Please try again later.
                </div>
                <?php } else if(isset($_GET['msg31'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Hell yeah!</strong> You have a new team member.<br>
                </div>
                <?php } else if(isset($_GET['msg32'])){?>
                <div id="response" class="alert alert-warning alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ups!</strong> You didn't whant that person as a new team member.<br>
                </div>
                <?php } ?>
                
                <!-- Page Title -->
                <?php require_once("teamMembersPageTitle.php");?>
                
                <!-- Members List -->
                <?php require_once('teamMembersList.php');?>

                <!-- Members Request List -->
                <?php require_once("teamMembersRequestList.php"); ?>
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
