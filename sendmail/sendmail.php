<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->setLanguage('en', 'phpmailer/language/');
$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

$mail->isSMTP(); //Send using SMTP
$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
$mail->SMTPAuth   = true; //Enable SMTP authentication
$mail->Username   = 'istvan.mbox@gmail.com'; //SMTP username
$mail->Password   = 'sitnphjwjmiqrinp'; //SMTP password
$mail->Port = '587'; 
$mail->SMTPSecure = 'TLS';

//From SMTP username (email)
$mail->setFrom('istvan.mbox@gmail.com', 'Istvan Capfel');
//To...
$mail->addAddress('thorns@ukr.net');
//Subject
$mail->Subject = 'E-mail from test';

//Body
$Body = '<h1>Hi! It`s Test!</h1>';

if(trim(!empty($_POST['name']))){
	$Body .= "<p>Name: <strong>".$_POST['name']."</strong></p>";
}
if(trim(!empty($_POST['email']))){
	$Body .= "<p>E-mail: <strong>".$_POST['email']."</strong></p>";
}
if(trim(!empty($_POST['message']))){
	$Body .= "<p>Message: <strong>".$_POST['message']."</strong></p>";
}
if(trim(!empty($_POST['like']))){
	$Body .= "<p>Do you like test? <strong>".$_POST['like']."</strong></p>";
}
if(trim(!empty($_POST['thebest']))){
	$Body .= "<strong>this test is a best in the world </strong></p>";
}

//add File
if(trim(!empty($_FILES['image']['tmp_name']))){
	$fileTmpName = $_FILES['image']['tmp_name'];
	$fileName = $_FILES['image']['name'];
	$mail->addAttachment($fileTmpName, $fileName);
}

$mail->Body = $Body;

//Sending
$mail->send();
$mail->smtpClose();

?>