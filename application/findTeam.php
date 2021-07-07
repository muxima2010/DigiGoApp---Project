<?php
# http://localhost/digiGoApp/application/findNewTeam.php
require_once("../php/restrictAccess.php");


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
              <?php if(isset($_GET['msg16'])){?>
                <div id="messageSuccess" class="alert alert-success alert-dismissible" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Thank you!</strong> Your request has been successfully sent.
                </div>
                <?php require("findTeamTopImage.php"); ?>
              <?php } else if(isset($_GET['msg15'])){?>
                <div id="messageNotSuccess" class="alert alert-warning" role="alert" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>You already have access to Team!</strong>
                </div>
                <?php require("findTeamTopImage.php"); ?>
              <?php } else if(isset($_GET['msg17'])){ ?>
                <div id="messageNotSuccess" class="alert alert-info" role="alert" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>You already sended a request to this Team!</strong>
                </div>
              <?php } else if(!isset($_POST['email'])){
                require("findTeamTopImage.php");
               } ?>       
                   

            <!-- Forms -->
            <section class="forms mt-5">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    if(!isset($_POST['email'])){?>
                    <div class="section-heading">
                      <h2>Search</h2>
                    </div>
                      <?php require("formSearchTeam.php");?>
                    <?php } else if(isset($_POST['email'])){
                      require_once("../php/connection.php");
                      $email = $_POST['email'];
                      $sql = "SELECT * FROM v_teams WHERE email = '$email'";
                      $query = mysqli_query($conn, $sql) or die ($sql);
                      $total = mysqli_num_rows($query);

                      if($total > 0){?>
                      <div class="section-heading">
                        <h2>Search Result by <span style="font-size: 18px;color: blue;"><?php echo $email ;?></span></h2>
                      </div>
                      <table class="table table-sm">
                      <thead>
                            <tr>
                              <th scope="col">n.º</th>
                              <th scope="col">Name</th>
                              <th scope="col">description</th>
                              <th scope="col">Category</th>
                              <th scope="col">Created</th>
                              <th scope="col">Request</th>
                            </tr>
                          </thead>
                        <?php while ($f = mysqli_fetch_assoc($query)){?>
                          <tbody>
                            <tr>
                              <th scope="row"><?php echo $f['id'];?></th>
                              <td><?php echo $f['team_name'];?></td>
                              <td><?php echo $f['description'];?></td>
                              <td><?php echo $f['type'];?></td>
                              <td><?php echo date("Y-m", strtotime($f['dataReg']));?></td>
                              <td><a class="btn btn-light" onclick="this.href='php/requestAccessToTeam.php?idTeam=<?php echo $f['id'];?>'">SEND</a></td>
                            </tr>
                          </tbody>   
                     <?php } ?>
                    </table>
                    <div class="section-heading">
                        <h4>Search Again!</h4>
                        </div>
                          <?php require("formSearchTeam.php");?>
                    <?php } else if($total == 0) {?>
                        <div class="section-heading">
                          <h2>Sorry there is no result for <span style="font-size: 18px;color: blue;"><?php echo $email ;?></span></h2>
                          <h4>Please try again!</h4>
                        </div>
                        <?php require("formSearchTeam.php");?>
                    <?php } } ?>
                    
                    
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
</html>
