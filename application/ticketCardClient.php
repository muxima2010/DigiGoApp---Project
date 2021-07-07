<?php
# http://localhost/digiGoApp/application/ticketCard.php
require_once("../php/restrictAccess.php");
require_once("../php/connection.php");

if(isset($_GET['idTicket'])){
    $idTicket = $_GET['idTicket'];
    $sql = "SELECT * FROM v_ticket_card WHERE idTicket = $idTicket";
    $query = mysqli_query($conn, $sql)or die($sql);
    $fTicket = mysqli_fetch_assoc($query);

    $sqlTeam = "SELECT idTeam FROM ticket WHERE id = $idTicket";
    $queryTeam = mysqli_query($conn, $sqlTeam)or die($sqlTeam);
    $fIdTeam = mysqli_fetch_assoc($queryTeam);
    $idTeam = $fIdTeam['idTeam'];

    $table = "v_teams";
    $sqlTeamName = "SELECT * FROM $table WHERE id = $idTeam"; 
    $queryTeamName = mysqli_query($conn, $sqlTeamName) or die($sqlTeamName);
    $totalTeamName = mysqli_num_rows($queryTeamName);
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

            <!-- Top Page -->
            <section class="services p-0 m-0 mt-4">
                <div class="container-fluid p-0 m-0">
                    <?php if($totalTeamName>0){
                        $fTeamName = mysqli_fetch_assoc($queryTeamName);?>
                        <h4><?php echo $fTeamName['team_name'];?></h4>
                        <p>Ticket Details</p>
                    <?php } ?>
                </div>
            </section>

                <!-- TICKET CARD TOTAL INFO -->
                <form method="post" action="php/saveTicket.php">
                <div class="progress mt-4">
                    <div class="pl-1 text-left progress-bar <?php echo $fTicket['priorityClass'];?>" role="progressbar" style="width: 100%; font-size: 16px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Priority: <?php echo $fTicket['priority'];?></div>
                    </div>
                    <div class="container pt-1 mt-2 pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Ticket N.º</label>
                                    <span class="form-control"  readonly><?php echo $fTicket['idTicket'];?></span>
                                    <input name="idTicket" value="<?php echo $fTicket['idTicket'];?>" hidden>
                                    <input name="idTeam" value="<?php echo $idTeam;?>" hidden>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Related Ticket N.º</label>
                                    <span class="form-control"  readonly><?php echo $fTicket['old_idTicket'];?></span>
                                </div>
                            </div>
                            
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Registed at</label>
                                    <span class="form-control" readonly><?php echo $fTicket['dateReg'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Created by</label>
                                    <span class="form-control" readonly><?php echo $fTicket['email'];?></span>
                                </div>
                            </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Subject</label>
                        <span class="form-control " readonly><?php echo $fTicket['subject'];?></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Message</label>
                        <span class="form-control" style="min-height: 150px" readonly><?php echo $fTicket['message'];?></span>
                    </div>
                    <div class="container pt-1 mt-2 pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Category</label>
                                    <span class="form-control" readonly><?php echo $fTicket['category'];?></span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Priority</label>
                                    <span class="form-control" readonly><?php echo $fTicket['priority'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <textarea name="comment" class="form-control" style="min-height: 150px" id="exampleFormControlTextarea1" rows="3"><?php echo $fTicket['comment'];?></textarea>
                    </div>
                    <div class="container pt-1 mt-2 pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Owner</label>
                                    <?php 
                                        $sqlIdOwner = "SELECT * FROM ticket_info_status WHERE idTicket = $idTicket";
                                        $queryIdOwner = mysqli_query($conn, $sqlIdOwner)or die($sqlIdOwner);
                                        $fIdOwner = mysqli_fetch_assoc($queryIdOwner);
                                        
                                        $idOwner = $fIdOwner['idOwner'];
                                        $sqlOwner = "SELECT * FROM v_user WHERE id = $idOwner";
                                        $queryOwner = mysqli_query($conn, $sqlOwner)or die($sqlOwner);
                                        $fOwner = mysqli_fetch_assoc($queryOwner);
                                    ?>
                                    <span class="form-control" readonly><?php echo $fOwner['first_name'];?> <?php echo $fOwner['last_name'];?></span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Contact me</label>
                                    <span class="form-control" readonly><?php echo $fOwner['email'];?></span>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="container pt-1 mt-2 pl-0 pr-0">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Ticket Status</label>
                                    <span class="form-control" readonly><?php echo $fTicket['status'];?></span>
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Date Closed Ticket</label>
                                    <span class="form-control" readonly><?php echo $fTicket['date_closed'];?></span>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="container pt-1 mt-2 pl-0 pr-0">
                        <div class="row">
                            <div class="col">
                                <!-- FUTURE FEATURE <a class="btn btn-dark" href="php/downloadFile.php?FileNo=1">DOWNLOAD FILE</a> -->
                            </div>
                            <div class="col text-right">
                            <?php 
                                $idStatus = $fIdOwner['idStatus'];
                                if($idStatus == 1 || $idStatus == 2 ){?>
                                    <a type="button" class="btn btn-primary" href="myTeamTicketByUser.php?idTeam=<?php echo $idTeam;?>">BACK</a>
                                    <button class="btn btn-danger" name="closeTicketByUser">CLOSE</button>
                                <?php } else if ($idStatus == 3){?>
                                    <a type="button" class="btn btn-primary" href="myTeamTicketByUser.php?idTeam=<?php echo $idTeam;?>">BACK</a>
                                <?php }?>
                            </div>
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