<?php
require "phpmailer/PHPMailerAutoload.php";
$receiver_email = "tawsifhasan@iut-dhaka.edu";
$ini = parse_ini_file('cred/cred.ini', true);
$mail = new PHPMailer();

$mail->isSMTP(); // Corrected method name

$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = $ini['email']['username'];
$mail->Password = $ini['email']['password'];
$mail->From = $_POST["email"];
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Subject = "Prescription from" . " " . $_POST["email"];
$mail->Body = $_POST["name"] . ": " . "'" . $_POST["message"] . "'"; // Corrected concatenation
$mail->addAddress($receiver_email); // Corrected method name

if (!$mail->send()) {
    echo "Message could not be sent. <p>";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    header("Location: create.php");
}
?>

<!-- guys this is just a dummy comment to make a commit -->