<?php
# http://localhost/digiGoApp/application/invitePeople.php
require_once("../php/restrictAccess.php");

# Fetch Team Available from DB to user by user lever
if(!isset($_GET['idTeam'])){
  require_once("../php/connection.php");
  $idUser = $_SESSION['idUser'];
  $sql = "SELECT team_name, idTeam  FROM team, team_user_level WHERE team_user_level.idTeam = team.id 
  AND team_user_level.idUser = $idUser AND team_user_level.idLevel = 1";
  $query = mysqli_query($conn, $sql) or die($sql);
  $total = mysqli_num_rows($query);
}else{
  # Fetch Team Available from DB to user by idTeam
  require_once("../php/connection.php");
  $idTeam = $_GET['idTeam'];
  $sql = "SELECT * FROM v_teams WHERE id = $idTeam";
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
          <div class="inner">

            <!-- Header -->
            <?php require_once("headerBar.php");?>


            <!-- Show Result Message to user after Request -->
              <?php if(isset($_GET['msg25'])){?>
                <div id="messageSuccess" class="alert alert-success alert-dismissible" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Thank you!</strong> Your invitation has been successfully sent.
                </div>
              <?php } else if(isset($_GET['msg26'])){?>
                <div id="messageNotSuccess" class="alert alert-danger" role="alert" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Sorry!</strong> Seems that we have an issue.<br>
                   Please try again later.
                </div>
              <?php } else if(isset($_GET['msg27'])){ ?>
                <div id="messageNotSuccess" class="alert alert-info" role="alert" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>This email </strong>already have an account!
                </div>
              <?php } ?>     



            <!-- Form Create New Ticket -->
            <section class="forms">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2 class="mb-2">Invite People to DigiGo App!</h2>
                      <p class="mb-4">Invite people to join DigiGo App!</p> 
                    </div>
                    <form id="contact" action="php/invitePeopleEmailCheck.php" method="post">
                      <div class="row">
                        <div class="col-md-12">
                          <fieldset>
                            <input name="email" type="email" class="form-control" id="name" placeholder="Email to..." required>
                          </fieldset>
                        </div>
                        <div class="container pl-0">
                          <div class="row">
                              <div class="col">
                                  <div class="col-md-6">
                                      <a type="submit" class="btn btn-secondary" href="mainMenu.php">BACK</a>
                                      <button type="submit" id="form-submit" name="invite-people" class="btn btn-info">SUBMIT</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </section>
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


  </body>

</html>
