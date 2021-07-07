<?php
# http://localhost/digiGoApp/application/createNewTicket.php
require_once("../php/restrictAccess.php");

# Fetch Team Available from DB to user
if(!isset($_GET['idTeam'])){
  require_once("../php/connection.php");
  $idUser = $_SESSION['idUser'];
  $sql = "SELECT team_name, idTeam FROM team, team_user_level WHERE team_user_level.idTeam = team.id 
  AND team_user_level.idUser = $idUser";
  $query = mysqli_query($conn, $sql) or die($sql);
  $total = mysqli_num_rows($query);

  # Fetch Ticket Category from DB
  $sqlCat = "SELECT * FROM ticket_category";
  $queryCat = mysqli_query($conn, $sqlCat) or die($sqlCat);
  $totalCat = mysqli_num_rows($queryCat);
  
}else{
  # Fetch Team Available from DB to user by idTeam
  require_once("../php/connection.php");
  $idTeam = $_GET['idTeam'];
  $sql = "SELECT * FROM v_teams WHERE id = $idTeam";
  $query = mysqli_query($conn, $sql) or die($sql);
  $total = mysqli_num_rows($query);

  # Fetch Ticket Category from DB
  $sqlCat = "SELECT * FROM ticket_category";
  $queryCat = mysqli_query($conn, $sqlCat) or die($sqlCat);
  $totalCat = mysqli_num_rows($queryCat);
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

            <!-- Show Result Message to user after Created Team -->
                <?php if(isset($_GET['msg32'])){?>
                <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thank you!</strong> Your ticket was successfully submited!<br>
                </div>
                <?php } else if(isset($_GET['msg33'])){?>
                <div id="response" class="alert alert-danger alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong> Seems that we have an issue.<br>
                   Please try again later.
                </div>
                <?php } else if(isset($_GET['msg34'])){?>
                <div id="response" class="alert alert-warning alert-dismissible" style="margin-top:30px">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Ups!</strong> You must select a team.<br>
                   Please try again.
                </div>
                <?php } ?>
                

            <!-- Form Create New Ticket -->
            <section class="forms">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Create New Ticket</h2>
                    </div>
                    <form id="contact" action="php/newTicket.php" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <fieldset>
                            <input name="subject" type="text" class="form-control" id="name" placeholder="Subject..." required="">
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset>
                            <input name="oldTicket" type="text" class="form-control" id="old-ticket" placeholder="Ticket Related">
                          </fieldset>
                        </div>
                        <div class="col-md-12">
                          <select name="category" id="category">
                            <option value="1" selected>Select Category</option>
                            <?php 
                            if($totalCat > 0){
                                    while($fCat = mysqli_fetch_assoc($queryCat)) { ?>
                                      <option value="<?php echo $fCat['id'];?>"><?php echo $fCat['category'];?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <select name="team" id="team">
                            <?php
                            if(!isset($_GET['idTeam'])){?>
                              <option value="0" selected>Select Team</option>
                              <?php 
                              if($total>0){
                                while($f = mysqli_fetch_assoc($query)) {?>
                                <option value="<?php echo $f['idTeam'];?>"><?php echo $f['team_name'];?></option>
                            <?php } } } else{
                              $f = mysqli_fetch_assoc($query)
                              ?>
                              <option value="<?php echo $f['id'];?>" selected><?php echo $f['team_name'];?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="priority" type="radio" id="demo-small" value="1" checked>
                            <label for="demo-small">Low Priority</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="priority" type="radio" id="demo-medium" value="2">
                            <label for="demo-medium">Normal Priority</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                          <div class="circle-item">
                            <input name="priority" type="radio" id="demo-old" value="3">
                            <label for="demo-old">High Priority</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <textarea name="message" id="demo-message" placeholder="Description - be as specific as possible..." rows="6" required></textarea>
                        </div>
                    <!-- FUTURE FEATUR -- <div class="col-md-12 col-sm-4">
                          <div class="circle-item">
                            <input class="input-file" style="padding: 0;height: 60px; margin-bottom: 20px;" type="file" name="fileToUpload" id="fileToUpload">
                          </div>
                        </div>-->
                        <div class="container pl-0">
                          <div class="row">
                            <div class="col">
                              <div class="col-md-6">
                                <a type="submit" class="btn btn-secondary" href="mainMenu.php">BACK</a>
                                <button type="submit" id="form-submit" name="newTicket" class="btn btn-info">SUBMIT</button>
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
