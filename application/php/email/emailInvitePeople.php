<?php
# http://localhost/digiGoApp/application/php/email/emailInvitePeople.php

$temp = mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/application/invitePeople.php?msg25#messageSuccess");
	}
	else{
		header("Location:http://localhost/digiGoApp/application/invitePeople.php?msg26#messageNotSuccess");
	}

function mailtoemail($to){
	$to = $_GET['to'];
	$firstName = $_REQUEST['firstName'];
	$lastName = $_REQUEST['lastName'];
	$emailFrom = $_REQUEST['emailFrom'];
	
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
	$mail->Subject = utf8_decode("Invitation to DigiGo App");
	$mail->Body = utf8_decode("You have been invited to start using DigiGo!<br><br>
	Sent by $firstName $lastName<br>
    Email: $emailFrom<br><br>
	<a href='http://localhost/digiGoApp/signin.html'>Sigin here!</a><br><br>
	Feel free to contact us.<br><br>
	Best regards,<br>DigiGo Team");
	$mail->Send();
	return 1;
}
?>
