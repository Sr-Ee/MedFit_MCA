<?php
require "phpmailer/PHPMailerAutoload.php";
session_start();
$name = $_SESSION["patient_name"];
if(!isset($_SESSION["doctor_name"]) || strlen($_SESSION["doctor_name"])<1){
  $_SESSION["error"]="Please enter your information";
  header("Location: docinfo.php");
  return;
}
//Sending Mail
if(isset($_POST["sendMail"]) && strlen($_POST["receiver"])>1){
  $receiver_email=$_POST["receiver"];
  $ini = parse_ini_file('cred/cred.ini', true);
  $mail = new PHPMailer();

  $mail->IsSMTP();

  $mail->Host = "smtp.gmail.com";

  $mail->SMTPAuth = true;

  $mail->Username = $ini['email']['username']; // SMTP username
  $mail->Password = $ini['email']['password']; // SMTP password
  $mail->addAttachment("prescription.pdf");
  $mail->addAttachment("<?php echo $name.'_'.'prescription.docx' ?>");
  $mail->From = "tawsifhasan882@gmail.com";
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587; //SMTP port
  $mail->Subject = "Prescription from"." ".$_SESSION["doctor_name"];
  $mail->Body='Please find your prescription from'." ".$_SESSION["doctor_name"]." "."attached to this email. DO NOT USE THE PRESCRIBED MEDICINE IF YOU DO NOT KNOW THE DOCTOR OR IF YOU HAVE NOT ASKED FOR SUCH A PRESCRIPTION";
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

// Get a file into an array.  In this example we'll go through HTTP to get
// the HTML source of a URL.

// Loop through our array, show HTML source as HTML source; and line numbers too.
/*echo "<div class='prescription'>";
foreach ($lines as $line_num => $line) {
    echo "<pre>".$line;
}
echo "</pre>";
echo"</div>";*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,intital-scale=1.0">
  <title> View Prescription</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/view_style.css">
</head>
<body>
  <header>
  <div class="mynavbar container-fluid p-0">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand" href="index.html">
        <img class="logo" src="images/pg.png" width="60" height="60" alt="">
      </a>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="create.php">Create Prescription</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../doctor/index.php">Dashboard</a>
      </li>
      </ul>
    </div>
  </nav>
  </div>
  </header>
<main>
  <div class="container">
    <div class="row">
      <div class="col-4">
      </div>
      <div class="col site-title align-self-center">
          <h1>Prescription Generator
      </div>
      </div>
<div>
<form method="post">
<a class="view-links" href="<?php echo $name.'_'.'prescription.pdf' ?>" target="_blank">Click to view</a><br>
<a class="view-links" href="javascript:history.go(-1)">Edit</a><br>
<a class="view-links" href="<?php echo $name.'_'.'prescription.pdf' ?>" download>Download PDF</a>
<a class="view-links" href="<?php echo $name.'_'.'prescription.docx' ?>" download>Download MSWord File</a>
<a class="view-links" href="prescription.txt" download>Download Text File</a><br>
<small>*PDF Format is recommended</small>
<div class="sendMail"><label for="email">Send to:</label><br>
<input type="email" id="email" name="receiver" class="col-5" placeholder="Email Address">
<input type="submit" name="sendMail" value="Send Prescription" class="col-4"></div>
</form>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>
