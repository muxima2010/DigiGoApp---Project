<?php
# http://localhost/digiGoApp/application/php/email/newTeamEmailActivate.php
require_once("../php/restrictAccess.php");

if(isset($_GET['token'])){
    $email=$_GET['email'];
    $token=$_GET['token'];
    require_once("../php/connection.php");

    $sql = "SELECT idTeam, team_email_token.id FROM team, team_email_token WHERE team_email_token.idTeam = team.id and team.email = '$email' AND team_email_token.token = '$token'";
    $query = mysqli_query($conn, $sql) or die ($sql);
    $total = mysqli_num_rows($query);

    if($total == 1){
        $fetch = mysqli_fetch_assoc($query);
        $idTeam = $fetch['idTeam'];
        $idToken = $fetch['id'];
        $idUser = $_SESSION['idUser'];

        $sql = "CALL p_validate_team_email ('$idTeam', '$idToken', '$idUser')";
        mysqli_query($conn, $sql) or die($sql);
        
        $path = "http://localhost/digiGoApp/application/mainMenu.php?msg13=newTeamEmailActivated";
    }else {
        $path = "http://localhost/digiGoApp/application/mainMenu.php?msg14=emailAlreadyActivated";
    }

}else{

    $path="http://localhost/digiGoApp/application/mainMenu.php";
}
header("location:$path");
?>