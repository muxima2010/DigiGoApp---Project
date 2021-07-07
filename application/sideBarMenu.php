<?php
# http://localhost/digiGoApp/application/sibeBarMenu.php
require_once("../php/restrictAccess.php");
require_once("../php/connection.php");
$idUser = $_SESSION['idUser'];
$sql = "SELECT team_name, idTeam FROM team, team_user_level WHERE team_user_level.idTeam = team.id 
AND team_user_level.idUser = $idUser";
$query = mysqli_query($conn, $sql) or die($sql);
$total = mysqli_num_rows($query);

//-- Select data from User -- 
require_once("../php/connection.php");
$idUser = $_SESSION['idUser'];
$sql = "SELECT * FROM v_user where id = $idUser";
$queryUser = mysqli_query($conn, $sql) or die($sql);
$fUser = mysqli_fetch_assoc($queryUser);

?>
<!-- Sidebar -->
        <div id="sidebar">

          <div class="inner">

            <!-- User Settings Box -->
            <section id="search" class="alt">
              <div class="container-fluid m-4">
                <a href="userSettings.php">
                <h4 class="my-a"><?php echo $fUser['first_name'];?> <?php echo $fUser['last_name'];?></h4>
                <p><?php echo $fUser['display_status'];?></p>
              </a>
              </div>
            </section>
              
            <!-- Menu -->
            <nav id="menu">
              <ul>
                <li><a href="mainMenu.php">Main Menu</a></li>
                <li><a href="createNewTicket.php">Create New Ticket</a></li>
                <li>
                  <span class="opener">My Workspaces</span>
                  <ul>
                  <?php if($total>0){
                    while($fteam = mysqli_fetch_assoc($query)) {?>
                    <li><a onclick="this.href='myWorkspace.php?idTeam=<?php echo $fteam['idTeam'];?>'"><?php echo $fteam['team_name'];?></a></li>
                    <?php } }?>
                  </ul>
                </li>
                <li><a id="logout" href="logoutPage.php">Log out</a></li>
              </ul>
            </nav>
            
            <!-- Footer -->
            <footer id="footer">
              <p class="p-small pt-4">Copyright &copy; 2021 <a href="">DigiGo</a> - All rights reserved
            </footer>

          </div>
        </div>
        <script src="../application/assets/js/logout.js"></script>