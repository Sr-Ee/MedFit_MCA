<?php
require "phpmailer/PHPMailerAutoload.php";
$receiver_email="tawsifhasan@iut-dhaka.edu";
$ini = parse_ini_file('cred/cred.ini', true);
$mail = new PHPMailer();

$mail->IsSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = true;

$mail->Username = $ini['email']['username']; // SMTP username
$mail->Password = $ini['email']['password']; // SMTP password
$mail->From = $_POST["email"];
$mail->SMTPSecure = 'tls';
$mail->Port = 587; //SMTP port
$mail->Subject = "Prescription from"." ".$_POST["email"];
$mail->Body=$_POST["name"].:."''".$_POST["message"]."''";
$mail->AddAddress($receiver_email);
$mail->Send();

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}
if($mail->Send()){
  header("Location: create.php");
}

}
 ?>
