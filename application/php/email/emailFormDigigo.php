<?php
# http://localhost/digiGoApp/application/php/email/emailFormDigigo.php

$temp = mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/application/contactFormDigigo.php?msg23#response");
	}
	else{
		header("Location:http://localhost/digiGoApp/application/contactFormDigigo.php?msg24#response");
	}

function mailtoemail($to){
	$to = "freewebdev2021@gmail.com";
	$firstName = $_REQUEST['firstname'];
    $lastName = $_REQUEST['lastname'];
    $userEmail = $_REQUEST['email'];
	$subject = $_REQUEST['subject'];
	$message = $_REQUEST['message'];
	

	require("class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->Username = "freewebdev2021@gmail.com";
	$mail->Password = "#Qwerty2021";
	$mail->FromName = "DigiGo App - Contact Form";
	$mail->AddAddress($to);
	$mail->IsHTML(true);
	$mail->Subject = utf8_decode("App Contact Form");
	$mail->Body = utf8_decode("You have a new message!<br><br>
    Email: $userEmail<br>
	Subject: $subject<br>
	Message: $message<br><br>
	Best regards,<br>$firstName $lastName");
	$mail->Send();
	return 1;
}
?>



