<?php
# http://localhost/digiGoApp/application/userSettings.php
require_once("../php/restrictAccess.php");

//-- Select data from User -- 
require_once("../php/connection.php");
$idUser = $_SESSION['idUser'];
$sql = "SELECT * FROM v_user where id = $idUser";
$query = mysqli_query($conn, $sql) or die($sql);
$f = mysqli_fetch_assoc($query);

//-- Select data from avatar --
$sqlAvatar = "SELECT * FROM avatar";
$queryAvatar = mysqli_query($conn, $sqlAvatar)or die($sqlAvatar);
$totalAv = mysqli_num_rows($queryAvatar);

//-- Select id from notification and status from iduser
$sqlId = "SELECT * FROM user_settings WHERE idUser = $idUser";
$queryId = mysqli_query($conn, $sqlId)or die($sql);
$fId = mysqli_fetch_assoc($queryId);

//-- Select data from user_notification --
$sqlNoti = "SELECT * FROM user_notification";
$queryNoti = mysqli_query($conn, $sqlNoti)or die($sqlNoti);
$total = mysqli_num_rows($queryNoti);

//-- Select data from user_display_status -- 
$sqlStatus = "SELECT * FROM user_display_status";
$queryStatus = mysqli_query($conn, $sqlStatus)or die($sqlStatus);
$totalStatus = mysqli_num_rows($queryStatus);


if(isset($_GET['update'])){
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $email = $_GET['email'];
    $username = $_GET['username'];
    $description = $_GET['description'];
    $avatar = $_GET['avatar'];;
    $status = $_GET['status'];
    $notifications = $_GET['notifications'];

    $sql = "CALL p_udpate_user_settings ('$idUser','$firstName','$lastName','$email','$username','$description', '$avatar', '$status','$notifications')";
    $query = mysqli_query($conn, $sql) or die ($sql);
    
    $path="userSettings.php?msg20#perfilUpdated";
} else if(isset($_GET['cancel'])){
    $path="mainMenu.php";
}
header("Location: $path");

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

            <!-- User Settings -->
            <form method="get">
                <div class="container mt-3">
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <img id="img-avatar" class="border rounded-circle img-profile mb-3" src="../application/assets/images/avatars/<?php echo $f['avatar'];?>" alt="User Avatar">
                                        </div>
                                        <div class="form-group">
                                                <select class="w-100 p-0" name="avatar" id="imgPreview" onchange="changeFunc();" class="form-control" style="width: 250px"  >
                                                    <option  selected value="<?php echo $f['avatar'];?>">Change Avatar</option>
                                                   <?php 
                                                        if($totalAv>0){
                                                           while($fAvatar = mysqli_fetch_assoc($queryAvatar)) {?>
                                                            <option  value="<?php echo $fAvatar['avatar'];?>"><?php echo $fAvatar['avatar_name'];?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="about mt-3">
                                        <h5 class="mb-2 text-primary">About</h5>
                                        <p><?php echo $f['description'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-3 text-primary">Personal Details</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" name="firstName" value="<?php echo $f['first_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" name="lastName" value="<?php echo $f['last_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $f['email'];?>">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="name" class="form-control" name="username" value="<?php echo $f['username'];?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option  value="<?php echo $fId['idDisplay_status']?>" selected>Selected: <?php echo $f['display_status'];?></option>
                                                <?php 
                                                    if($total>0){
                                                        while($fStatus = mysqli_fetch_assoc($queryStatus)) {?>
                                                            <option value="<?php echo $fStatus['id'];?>"><?php echo $fStatus['display_status'];?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="notifications">Notifications</label>
                                            <select class="form-control" name="notifications" id="notifications">
                                                <option value="<?php echo $fId['idNotifications_type']?>" selected>Selected: <?php echo $f['notification_type'];?></option>
                                                <?php 
                                                    if($total>0){
                                                        while($f = mysqli_fetch_assoc($queryNoti)) {?>
                                                            <option value="<?php echo $f['id'];?>"><?php echo $f['notification_type'];?></option>
                                                <?php } }?>
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <label for="firstName">About you</label>
                                <textarea type="name" class="form-control" name="description"><?php echo $fId['description'];?></textarea>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right mt-3">
                                            <button type="submit" name="cancel" class="btn btn-secondary">Cancel</button>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </form>
            <!-- Show Result Message to user after Update Profil -->
              <?php if(isset($_GET['msg20'])){?>
                <div id="perfilUpdated" class="alert alert-primary alert-dismissible" style="margin-top:30px">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Updated!</strong> Your profile is ready to rock.
                </div>
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
    <script src="assets/js/userSettings.js"></script>
  </body>
</html>