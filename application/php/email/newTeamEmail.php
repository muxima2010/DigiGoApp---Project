<?php
# http://localhost/digiGoApp/php/application/php/email/newTeamEmail.php
$temp=mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/application/createNewTeam.php?msg12=newAccountCreated");
	}
	else{
		echo "mail not sent.";
	}
function mailtoemail($to){
	$to=$_GET['email'];
	$teamName = $_GET['teamName'];
	$token=$_GET['token'];
	

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
	$mail->Subject = utf8_decode("New Team Workspace Activation");
	$mail->Body = utf8_decode("Welcome to DigiGo App!<br><br>
	This email was set for $teamName Workspace.<br><br>
	Please follow the link bellow to activate team and notifications.<br><br>
	<a href='http://localhost/digiGoApp/application/php/newTeamEmailActivate.php?email=$to&token=$token'>Activate Team Notifications!</a><br><br>Best regards,<br>DigiGo Team");    
	$mail->Send();
	return 1;
}
?>