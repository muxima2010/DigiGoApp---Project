<?php
# http://localhost/digiGoApp/application/php/email/emailTeamRequest.php

$temp = mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/application/findTeam.php?msg16=requestHaveBeenSended");
	}
	else{
		echo "mail not sent.";
	}

function mailtoemail($to){
	$to = $_GET['to'];
	$teamName = $_GET['teamName'];
	$firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $userEmail = $_GET['userEmail'];
	

	require("class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->Username = "freewebdev2021@gmail.com";
	$mail->Password = "#Qwerty2021";
	$mail->From = "freewebdev2021@gmail.com";
	$mail->FromName = "DigiGo App";
	$mail->AddAddress($to);
	$mail->IsHTML(true);
	$mail->Subject = utf8_decode("Team Access Request");
	$mail->Body = utf8_decode("You have a new access request for $teamName!<br><br>
	Sent by $firstName $lastName.<br>
    Email: $userEmail<br><br>
	Please check the TEAM MEMBER space to accpet or denie accesss.<br><br>
	Best regards,<br>DigiGo Team");
	$mail->Send();
	return 1;
}
?>
