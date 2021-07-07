<?php
# http://localhost/digiGoApp/php/email/newAccountEmail.php
$temp=mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/signinSuccess.html?msg3=newAccountCreated");
	}
	else{
		echo "mail not sent.";
	}
function mailtoemail($to){
	$to=$_GET['email'];
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
	$mail->Subject = utf8_decode("New User Account Activation");
	$mail->Body = utf8_decode("Welcome to DigiGo App!<br><br><a href='http://localhost/digiGoApp/php/email/newAccountActivate.php?email=$to&token=$token'>Activate New Account - Please submit here!</a><br><br>After click in the link please do Login.");    
	$mail->Send();
	return 1;
}
?>