<?php
# http://localhost/digiGoApp/application/php/invitePeopleEmailCheck.php
require_once("../php/restrictAccess.php");



if(isset($_POST['invite-people'])){
    $userEmail = $_POST['email'];
    require_once("../php/connection.php");
    $sql = "SELECT * FROM v_user WHERE email = '$userEmail'";
    $query = mysqli_query($conn, $sql)or die($sql);
    $total = mysqli_num_rows($query);

    if($total > 0){
        $path = ("http://localhost/digiGoApp/application/invitePeople.php?msg27#messageNotSuccess");
    } else {
        $idUser = $_SESSION['idUser'];
        $sql = "SELECT * FROM v_user WHERE id = $idUser";
        $query = mysqli_query($conn, $sql)or die($sql);
        $f = mysqli_fetch_assoc($query);
        $firstName = $f['first_name'];
        $lastName = $f['last_name'];
        $emailFrom = $_SESSION['email'];
        $path = ("http://localhost/digiGoApp/application/php/email/emailInvitePeople.php?to=$userEmail&firstName=$firstName&lastName=$lastName&emailFrom=$emailFrom");
    }
    header("Location: $path");
}
?>