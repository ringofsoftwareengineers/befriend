<?php

require './PHPMailer/PHPMailerAutoload.php';

function send_mail_volunteer($Subject= "Volunteer user created",$message="<h1>This is a test mail</h1>",$address="computing.engineer@gmail.com")
{
    
$mail = new PHPMailer();
//echo "SMTPSERVER  " . ini_get("SMTP")."<br>";  
//$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->Host = "smtp.rosetelecom.co.uk"; // SMTP server
$mail->Port = 587;
$mail->From = "test@test.com";
$mail->FromName = 'Be Friend a Child';
$mail->AddAddress($address);

$mail->Subject =$Subject;

$mail->Body = $message;

$mail->isHTML(true);
if (!$mail->Send()) {
    error_log($mail->ErrorInfo, 3, "mail.log");   
}
}//end function

//send_mail_volunteer();
