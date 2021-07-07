<?php
# http://localhost/digiGoApp/application/php/createNewTeam.php
require_once("../php/restrictAccess.php");

if(isset($_POST['teamSubmit'])){
    require_once("../php/connection.php");
    $teamName = strtoupper(addslashes($_POST['teamName']));
    $teamEmail = strtolower(addslashes($_POST['teamEmail']));
    $teamDescription = addslashes($_POST['teamDescription']);
    $idType = addslashes($_POST['category']);
    $idUser = $_SESSION['idUser'];
    # -- Generate Token -- 
    $chars = '1234567890abcdefghijklmnopqrstuvxywz_';
    $maxChars = strlen($chars)-1;
    $token = '';
    for ($i = 0; $i < 40; $i++){
        $token .= $chars[mt_rand(0, $maxChars)];
    }
    $sql = "CALL p_insert_new_team ('$teamName', '$teamEmail', '$teamDescription', '$idType', '$idUser', '$token')";
    $query = mysqli_query($conn, $sql) or die ($sql);
    $total = mysqli_num_rows($query);
    
    $path="../php/email/newTeamEmail.php?email=$teamEmail&teamName=$teamName&token=$token";
}else{
    $path="..application/registerNewTeam.php?msg11=teamNotCreated";
}
header("location: $path");

?>