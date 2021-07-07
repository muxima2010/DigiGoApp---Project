<?php
# http://localhost/digiGoApp/application/contactFormDigigo.php
require_once("../php/restrictAccess.php");


require_once("../php/connection.php");
$idUser = $_SESSION['idUser'];
$sql = "SELECT * FROM v_user WHERE id = $idUser";
$query = mysqli_query($conn, $sql)or die($sql);
$fetch = mysqli_fetch_assoc($query);
$firstName = $fetch['first_name'];
$lastName = $fetch['last_name'];
$email = $fetch['email'];


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
            <?php if(isset($_GET['msg23'])){?>
              <div id="response" class="alert alert-success alert-dismissible" style="margin-top:30px">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thank you!</strong> Your massage have been sent.<br>
                We will reply as soon as possible.
              </div>
              <!-- Top Contact Form -->
              <?php require_once("contactFormTopDigigo.php");?>
            <?php } else if(isset($_GET['msg24'])){?>
              <div id="response" class="alert alert-danger alert-dismissible" style="margin-top:30px">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Seems that we have an issue.<br>
                Please try again later.
              </div>
              <!-- Top Image -->
              <?php require_once("contactFormTopDigigo.php");?>
            <?php } else{ ?>
              <!-- Top Image -->
              <?php require_once("contactFormTopDigigo.php");?>
            <?php } ?>

            <!-- Contact Form -->
            <form class="mt-3" method="post" action="../application/php/email/emailFormDigigo.php">
                <input name="firstname" value="<?php echo $firstName;?>" hidden>
                <input name="lastname" value="<?php echo $lastName;?>" hidden>
                <input name="email" value="<?php echo $email;?>" hidden>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Message</label>
                    <textarea type="text" class="form-control" name="message" id="message" required></textarea>
                </div>
                <div class="col pl-0">
                  <div class="col-md-6 pl-0">
                    <a type="submit" class="btn btn-secondary" href="mainMenu.php">BACK</a>
                    <button type="submit" name="sendMessage" class="btn btn-info">SEND</button>
                  </div>
                </div>         
            </form>
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