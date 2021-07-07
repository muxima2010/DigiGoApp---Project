<?php
# http://localhost/digiGoApp/application/MyWorkspacesServices.php
require_once("../php/restrictAccess.php");

//-- Get data from Team by team id -- 
if(isset($_GET['idTeam'])){
  require_once("../php/connection.php");
  $idTeam = $_GET['idTeam'];
  $table = "v_teams";
  $sql = "SELECT * FROM $table WHERE id = $idTeam"; 
  $query = mysqli_query($conn, $sql) or die($sql);
  $total = mysqli_num_rows($query);
}

//-- Get data from team by Level of User -->
$idUser = $_SESSION['idUser'];
$sqlLevel = "SELECT * FROM team_user_level WHERE idTeam = $idTeam AND idUser =  $idUser";
$queryLevel = mysqli_query($conn, $sqlLevel) or die($sqlLevel);
$fetch = mysqli_fetch_assoc($queryLevel);
$idLevel = $fetch['idLevel'];

$sqlUserLevel = "SELECT * FROM user_level WHERE id = $idLevel";
$queryUserLevel = mysqli_query($conn, $sqlUserLevel) or die($sqlUserLevel);
$fetchUserLevel = mysqli_fetch_assoc($queryUserLevel);

?>
<section class="services p-0 m-0 mt-4">
<div class="container-fluid p-0 m-0">
<?php if($total>0){
    $f = mysqli_fetch_assoc($query);?>
    <h4><?php echo $f['team_name'];?></h4>
    <p>Level: <?php echo $fetchUserLevel['level'];?></p>
  <?php } ?>
  </div>
</section>
<section class="services mt-3">
  
  <?php 
  // Request PHP services by user lever
  if($idLevel == 1){
    require('userLevelOne.php');
  }else if($idLevel == 2){
    require('userLevelTwo.php');
  }else if($idLevel == 3){
    require('userLevelThree.php');
  }
  ?>
  </section>

