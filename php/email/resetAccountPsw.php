<?php
# http://localhost/digiGoApp/php/email/resetAccountPsw.php

$temp=mailtoemail($to);
	if($temp){
        header("Location:http://localhost/digiGoApp/recoveyPasswordMailSent.html?msg8=resetPassword");
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
$mail->Subject = utf8_decode("Reset Password Request");
$mail->Body = utf8_decode("We receive a request to reset password for this email.<br><br>If you didn't request please forget this email, otherwise follow the link bellow!<br><br><a href='http://localhost/digiGoApp/resetPassword.Form.php?email=$to&token=$token'>Reset Password.</a>");    
$mail->Send();
return 1;
}
?>