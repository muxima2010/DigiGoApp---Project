<?php

require("../php/email/class.phpmailer.php");
$mail = new PHPMailer(true);

if ($_POST ["name"]) {
	$name = $_REQUEST ["name"];
	$email = $_REQUEST ["email"];
	$content = $_REQUEST ["message"];

	try {
		$toEmail = "freewebdev2021@gmail.com";
		// Server settings
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		$mail->Username = 'freewebdev2021@gmail.com'; // gmail email
		$mail->Password = '#Qwerty2021'; // gmail password
		// Recipient settings
		$mail->addAddress($toEmail);
		// Setting the email content
		$mail->IsHTML(true);
		$mail->Subject = utf8_decode("New Contact Form");
		$mail->Body = utf8_decode("From: {$name}<br>Email: {$email}<br>Message:<br>{$content}");
		$mail->send();
		
		$response = "success";
	} catch (Exception $e) {
		$response = "Message not sent, please try again!";
	}
	echo $response;
	exit();
}
?>




