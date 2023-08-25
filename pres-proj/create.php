<?php
require "phpmailer/PHPMailerAutoload.php";
require_once "vendor/autoload.php";
require_once "fpdf/fpdf.php";
session_start();
ini_set('display_errors', 1);
if(!isset($_SESSION["doctor_name"]) || strlen($_SESSION["doctor_name"])<1){
  $_SESSION["error"]="Please enter your information";
  header("Location: docinfo.php");
  return;
}
if(isset($_POST["cancel"])){
  header("Location: docinfo.php");
  return;
}
if(isset($_POST["view"])){
  header('Refresh: 5; URL=view.php');
  echo"<body style='display: none;'></body>";
}
//DOCTOR's Information
$doctor_name=$_SESSION["doctor_name"];
$degrees=$_SESSION["degrees"];
$designation=$_SESSION["designation"];
$work_address=$_SESSION["work_address"];
$ex_designation="Ex"." ".$_SESSION["ex_designation"];
$ex_work_address=$_SESSION["ex_work_address"];
//Doctor's Contact
$doctor_phone=$_SESSION["doctor_phone"];
$doctor_email=$_SESSION["doctor_email"];
//Medication Variables
if(isset($_POST["med1"]) && isset($_POST["strength1"]) && isset($_POST["dose1"]) && strlen($_POST["med1"])>1 && strlen($_POST["strength1"])>1 && strlen($_POST["dose1"])>1){
  $med1="1. ".$_POST["med1"];
  $strength1="(".$_POST["strength1"].")";
  $dose1=$_POST["dose1"];
}
else{
  $med1="";
  $strength1="";
  $dose1="";
}
if(isset($_POST["med2"]) && isset($_POST["strength2"]) && isset($_POST["dose2"]) && strlen($_POST["med2"])>1 && strlen($_POST["strength2"])>1 && strlen($_POST["dose2"])>1){
  $med2="2. ".$_POST["med2"];
  $strength2="(".$_POST["strength2"].")";
  $dose2=$_POST["dose2"];
}
else{
  $med2="";
  $strength2="";
  $dose2="";
}
if(isset($_POST["med3"]) && isset($_POST["strength3"]) && isset($_POST["dose3"])  && strlen($_POST["med3"])>1 && strlen($_POST["strength3"])>1 && strlen($_POST["dose3"])>1){
  $med3="3. ".$_POST["med3"];
  $strength3="(".$_POST["strength3"].")";
  $dose3=$_POST["dose3"];
}
else{
  $med3="";
  $strength3="";
  $dose3="";
}
if(isset($_POST["med4"]) && isset($_POST["strength4"]) && isset($_POST["dose4"])  && strlen($_POST["med4"])>1 && strlen($_POST["strength4"])>1 && strlen($_POST["dose4"])>1){
  $med4="4. ".$_POST["med4"];
  $strength4="(".$_POST["strength4"].")";
  $dose4=$_POST["dose4"];
}
else{
  $med4="";
  $strength4="";
  $dose4="";
}
if(isset($_POST["med5"]) && isset($_POST["strength5"]) && isset($_POST["dose5"])  && strlen($_POST["med5"])>1 && strlen($_POST["strength5"])>1 && strlen($_POST["dose5"])>1){
  $med5="5. ".$_POST["med5"];
$strength5="(".$_POST["strength5"].")";
  $dose5=$_POST["dose5"];
}
else{
  $med5="";
  $strength5="";
  $dose5="";
}
if(isset($_POST["med6"]) && isset($_POST["strength6"]) && isset($_POST["dose6"])  && strlen($_POST["med6"])>1 && strlen($_POST["strength6"])>1 && strlen($_POST["dose6"])>1){
  $med6="6. ".$_POST["med6"];
  $strength6="(".$_POST["strength6"].")";
  $dose6=$_POST["dose6"];
}
else{
  $med6="";
  $strength6="";
  $dose6="";
}
if(isset($_POST["med7"]) && isset($_POST["strength7"]) && isset($_POST["dose7"])  && strlen($_POST["med7"])>1 && strlen($_POST["strength7"])>1 && strlen($_POST["dose7"])>1){
  $med7="7. ".$_POST["med7"];
  $strength7="(".$_POST["strength7"].")";
  $dose7=$_POST["dose7"];
}
else{
  $med7="";
  $strength7="";
  $dose7="";
}
if(isset($_POST["med8"]) && isset($_POST["strength8"]) && isset($_POST["dose8"])){
  $med8="8. ".$_POST["med8"];
$strength8="(".$_POST["strength8"].")";
  $dose8=$_POST["dose8"];
}
else{
  $med8="";
  $strength8="";
  $dose8="";
}
if(isset($_POST["med9"]) && isset($_POST["strength9"]) && isset($_POST["dose9"])){
  $med9="9. ".$_POST["med9"];
$strength9="(".$_POST["strength9"].")";
  $dose9=$_POST["dose9"];
}
else{
  $med9="";
  $strength9="";
  $dose9="";
}
//Chief Complaint variables
if(isset($_POST["cc1"]) && strlen($_POST["cc1"])>1){
  $cc1="1. ".$_POST["cc1"]." ";
}
else{
  $cc1="";
}
if(isset($_POST["cc2"]) && strlen($_POST["cc2"])>1){
  $cc2="2. ".$_POST["cc2"]." ";
}
else{
  $cc2="";
}
if(isset($_POST["cc3"]) && strlen($_POST["cc3"])>1){
  $cc3="3. ".$_POST["cc3"]." ";
}
else{
  $cc3="";
}
if(isset($_POST["cc4"]) && strlen($_POST["cc4"])>1){
  $cc4="4. ".$_POST["cc4"]." ";
}
else{
  $cc4="";
}
if(isset($_POST["cc5"]) && strlen($_POST["cc5"])>1){
  $cc5="5. ".$_POST["cc5"]." ";
}
else{
  $cc5="";
}
//examination
if(isset($_POST["examination"]) && strlen($_POST["examination"])>1){
  $examination=htmlentities($_POST["examination"]);
}
else{
  $examination="";
}
if(isset($_POST["advice"]) && strlen($_POST["advice"])>1){
  $advice=htmlentities($_POST["advice"]);
}
else{
  $advice="";
}
if(isset($_POST["investigation"]) && strlen($_POST["investigation"])>1){
  $investigation=htmlentities($_POST["investigation"]);
}
else{
  $investigation="";
}
if(isset($_POST["diagnosis"]) && strlen($_POST["diagnosis"])>1){
$diagnosis=htmlentities($_POST["diagnosis"]);
}else{
  $diagnosis="";
}
//Variables
if(isset($_POST["name"])&& $_POST["age"] && $_POST["date"]){
$name=htmlentities($_POST["name"]);
$_SESSION["patient_name"]=$name;
$age=htmlentities($_POST["age"]);

$date=htmlentities($_POST["date"]);
$date=date_create($date);
$date=date_format($date,"d/m/Y");



//Prescription
$doctor_info=$doctor_name."\n".
$degrees."\n".
$designation."\n".
$work_address."\n"."\n".
$ex_designation."\n".
$ex_work_address."\n"."\n".
"\n";
$patient_info="Name:".$name."\t\t\t\tAge:".$age."\t\t\t\t\tDate:".$date."\n";


$prescription=
"Chief Complaints: ".$cc1." ".$cc2." ".$cc3." ".$cc4." ".$cc5."\n".
"Examination: ".$examination.
"\t\t\t\t\t\t"."Diagnosis:".$diagnosis."\n".
"\t\t\t\t\t\t".$med1.$strength1."\n".
"\t\t\t\t\t\t"."     ".$dose1."\n"."\n".
"\t\t\t\t\t\t".$med2.$strength2."\n".
"\t\t\t\t\t\t"."     ".$dose2."\n"."\n".
"\t\t\t\t\t\t".$med3.$strength3."\n".
"\t\t\t\t\t\t"."     ".$dose3."\n"."\n".
"\t\t\t\t\t\t".$med4.$strength4."\n".
"\t\t\t\t\t\t"."     ".$dose4."\n"."\n".
"\t\t\t\t\t\t".$med5.$strength5."\n".
"\t\t\t\t\t\t"."     ".$dose5."\n"."\n".
"\t\t\t\t\t\t".$med6.$strength6."\n".
"\t\t\t\t\t\t"."     ".$dose6."\n"."\n".
"\t\t\t\t\t\t".$med7.$strength7."\n".
"\t\t\t\t\t\t"."     ".$dose7."\n"."\n".
"\t\t\t\t\t\t".$med8.$strength8."\n".
"\t\t\t\t\t\t"."     ".$dose8."\n"."\n".
"\t\t\t\t\t\t".$med9.$strength9."\n".
"\t\t\t\t\t\t"."     ".$dose9."\n"."\n".
"Investigation(s):"."\n".$investigation."\n".
"Advice: "."\n".$advice.
"\t\t\t\t\t\t"."     "."Contact Number: ".$doctor_phone."\n".
"\t\t\t\t\t\t"."     "."Email Address: ".$doctor_email;
//Opening and writing to text file
$pres_file=fopen("prescription.txt","w");
fwrite($pres_file,$doctor_info.$patient_info."\n\n\n\n".$prescription);

//Writing to MS WORD file
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();

//Prescription
$section->addText($doctor_name,array('name'=>'Georgia','size'=>14,'color'=>'0000AA'));
$section->addText($degrees,array('name'=>'Georgia','size'=>14,'color'=>'0000AA'));
$section->addText($designation,array('name'=>'Georgia','size'=>14,'color'=>'0000AA'));
$section->addText($work_address,array('name'=>'Georgia','size'=>14,'color'=>'0000AA'));
$section->addText($ex_designation,array('name'=>'Georgia','size'=>14,'color'=>'FFAFC5'));
$section->addText($ex_work_address,array('name'=>'Georgia','size'=>14,'color'=>'FFAFC5'));
$section->addText();
$section->addText(
  "Name: ".$name."                       "."Age: ".$age."                      "."Date: ".$date."\n",
   array('name'=>'Times New Roman','size'=>10));
$section->addText("-----------------------------------------------------------------------------------------------------------------");
$section->addText("Chief Complaints: ".$cc1.$cc2.$cc3.$cc4.$cc5,array('name'=>'Times New Roman','size'=>10));
$section->addText("Examination: ".$examination,array('name'=>'Times New Roman','size'=>10));
$section->addText("Diagnosis: ".$diagnosis,array('name'=>'Times New Roman','size'=>10));
 $section->addText("---------------------------------------------------------------------------------------------------------------");
 $section->addText("Dosage: ",array('name'=>'Times New Roman','size'=>10));
 $section->addText("  ".$med1.$strength1,array('name'=>'Times New Roman','size'=>10));
 $section->addText("    "."  ".$dose1,array('name'=>'Times New Roman','size'=>10));
 $section->addText("  ".$med2.$strength2,array('name'=>'Times New Roman','size'=>10));
 $section->addText("    "."  ".$dose2,array('name'=>'Times New Roman','size'=>10));
 $section->addText("  ".$med3.$strength3,array('name'=>'Times New Roman','size'=>10));
 $section->addText("    "."  ".$dose3,array('name'=>'Times New Roman','size'=>10));
 $section->addText("  ".$med4.$strength4,array('name'=>'Times New Roman','size'=>10));
 $section->addText("    "."  ".$dose4,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("  ".$med5.$strength5,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("    "."  ".$dose5,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("  ".$med6.$strength6,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("    "."  ".$dose6,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("  ".$med7.$strength7,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("    "."  ".$dose7,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("  ".$med8.$strength8,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("    "."  ".$dose8,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("  ".$med9.$strength9,array('name'=>'Times New Roman','size'=>10));
//  $section->addText("    "."  ".$dose9,array('name'=>'Times New Roman','size'=>10));
 $section->addText("---------------------------------------------------------------------------------------------------------------");
 $section->addText("Investigation: ",array('name'=>'Times New Roman','size'=>10));
 $section->addText($investigation,array('name'=>'Times New Roman','size'=>10));

 $section->addText("Advice: ",array('name'=>'Times New Roman','size'=>10));
 $section->addText($advice,array('name'=>'Times New Roman','size'=>10));

$section->addText("                                                                        "."  "."Contact Number: ".$doctor_phone,array('name'=>'Arial','size'=>10,'color'=>'0000AA'));
$section->addText("                                                                        "."  "."Email Address: ".$doctor_email,array('name'=>'Arial','size'=>10,'color'=>'0000AA'));

// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('prescription.docx');

//Saving as pdf*****
//fpdf
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->Image('50.png',75,100,50,50);
  $pdf->SetFont('Arial','',11);
  $pdf->SetFillColor(190,207,180);
  $pdf->Cell(200,8,$doctor_name,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,$degrees,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,$designation,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,$work_address,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,$ex_designation,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,$ex_work_address,0,0,'',True);
  $pdf->Ln();
  $pdf->Cell(200,8,"Name: ".$name."                       "."Age: ".$age."                      "."Date: ".$date);
  $pdf->Ln();
  $pdf->AddFont('CaveatRegular','');
  $pdf->SetFont('CaveatRegular','',13);
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                  "."Diagnosis: ".$diagnosis);
  $pdf->Ln();
  $pdf->Cell(60,8,"Chief Complaints: ");
  $pdf->Cell(60,8,"                                                                   ".$med1.$strength1);
  $pdf->Ln();
  $pdf->Cell(60,8,$cc1);
  $pdf->Cell(60,8,"                                                                       "."  ".$dose1);
  $pdf->Ln();
  $pdf->Cell(60,8,$cc2);
  $pdf->Cell(60,8,"                                                                   ".$med2.$strength2);
  $pdf->Ln();
  $pdf->Cell(60,8,$cc3);
  $pdf->Cell(60,8,"                                                                       "."  ".$dose2);
  $pdf->Ln();
  $pdf->Cell(60,8,$cc4);
  $pdf->Cell(60,8,"                                                                   ".$med3.$strength3);
  $pdf->Ln();
  $pdf->Cell(60,8,$cc5);
  $pdf->Cell(60,8,"                                                                       "."  ".$dose3);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med4.$strength4);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose4);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med5.$strength5);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose5);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med6.$strength6);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose6);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med7.$strength7);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose7);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med8.$strength8);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose8);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                   ".$med9.$strength9);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                                       "."  ".$dose9);
  $pdf->Ln();
  $pdf->Multicell(120,8,"Examination: "."\n".$examination);
  $pdf->Multicell(120,8,"Investigation: "."\n".$investigation);
  $pdf->Multicell(120,8,"Advice: "."\n".$advice);
  $pdf->Ln();
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                            "."Contact Number: ".$doctor_phone);
  $pdf->Ln();
  $pdf->Cell(60,8,"                  ");
  $pdf->Cell(60,8,"                                                            "."Email Address: ".$doctor_email);


  if (file_exists('prescription2.pdf')) {
    unlink('prescription2.pdf');
}
  $pdf->Output("prescription.pdf",'F');

chmod("prescription.txt",0644);
chmod("prescription1.pdf",0644);
chmod("prescription.docx",0644);

//Sending Mail
/*
$ini = parse_ini_file('cred.ini', true);
$mail = new PHPMailer();

$mail->IsSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = true;

$mail->Username = $ini['email']['username']; // SMTP username
$mail->Password = $ini['email']['password']; // SMTP password
if($_POST["format"]=="txt"){
$mail->addAttachment("prescription.txt");
}else if($_POST["format"]=="pdf"){
$mail->addAttachment("prescription.pdf");
}else{
$mail->addAttachment("prescription.docx");
}
$mail->From = "tawsifhasan882@gmail.com";
$mail->SMTPSecure = 'tls';
$mail->Port = 587; //SMTP port
$mail->Subject = "Prescription from".$doctor_name;
$mail->Body='Prescription:';
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
}*/
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,intital-scale=1.0">
  <title> Prescription Generator</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
      <div class="col align-self-center create">
          <h1>Prescription Generator
      </div>
      </div>
  </div>
  <div class="form_div container">
    <form action="create.php" method="post" >
      <label for="patient_name"> Name of the Patient:</label>
      <input type ="text" name="name" id="patient_name" class="col-md-4" required>
      <label for="age">Age:</label>
      <input type="text" name="age" id=age class="col-md-2"required>
      <label for="date">Date:</label>
      <input type="date" name="date" id=date placeholder="dd/mm/yyyy" class="col-md-3"required>
      <label for="cc">Chief Complaints:</label><br>
      <input type="text" id="cc" name="cc1" placeholder="1" class="col-md-4">
      <input type="text" name="cc2" placeholder="2"class="col-md-4">
      <input type="text" name="cc3" placeholder="3"class="col-md-4">
      <input type="text" name="cc4" placeholder="4"class="col-md-4">
      <input type="text" name="cc5" placeholder="5"class="col-md-4"><br>
      <label for ="examination">Examination:</label>
        <textarea cols="60" rows="12" id="examination" name="examination"></textarea>
      <p style="font-weight: normal;">Diagnosis:
      <input type="text" name="diagnosis" class="col-md-4"></p>

      <p style="font-weight: normal;">Medication:</p>
      <p class="medicine">Medicine:
      <input type="text" name="med1"></p>
      <p class="medicine">Strength:
        <input type="text" list="strengths1" name="strength1">
        <datalist id="strengths1">
          <option value="0.5mg">0.5mg</option>
          <option value="1mg">1mg</option>
          <option value="2mg">2mg</option>
          <option value="5mg">5mg</option>
          <option value="10mg">10mg</option>
          <option value="25mg">25mg</option>
          <option value="20mg">20mg</option>
          <option value="50mg">50mg</option>
          <option value="100mg">100mg</option>
          <option value="250mg">250mg</option>
          <option value="500mg">500mg</option>
        </datalist></p>
      <p class="medicine">Dose:
        <input list="doses1" type="text" name="dose1">
        <datalist id="doses1">
          <option value="1+0+0">1+0+0</option>
          <option value="1+0+1">1+0+1</option>
          <option value="1+1+0">1+1+0</option>
          <option value="0+1+1">0+1+1</option>
          <option value="1+1+1">1+1+1</option>
          <option value="2+0+0">2+0+0</option>
          <option value="0+2+0">0+2+0</option>
          <option value="0+0+2">0+0+2</option>
          <option value="2+2+2">2+2+2</option>
       </datalist>
      </p>
      <p class="medicine">Medicine:<input type="text" name="med2"></p>
      <p class="medicine">Strength:
        <input type="text" list="strengths2" name="strength2">
        <datalist id="strengths2">
          <option value="0.5mg">0.5mg</option>
          <option value="1mg">1mg</option>
          <option value="2mg">2mg</option>
          <option value="5mg">5mg</option>
          <option value="10mg">10mg</option>
          <option value="25mg">25mg</option>
          <option value="20mg">20mg</option>
          <option value="50mg">50mg</option>
          <option value="100mg">100mg</option>
          <option value="250mg">250mg</option>
          <option value="500mg">500mg</option>
        </datalist></p>
      <p class="medicine">Dose:
        <input list="doses2" type="text" name="dose2">
        <datalist id="doses2">
          <option value="1+0+0">1+0+0</option>
          <option value="1+0+1">1+0+1</option>
          <option value="1+1+0">1+1+0</option>
          <option value="0+1+1">0+1+1</option>
          <option value="1+1+1">1+1+1</option>
          <option value="2+0+0">2+0+0</option>
          <option value="0+2+0">0+2+0</option>
          <option value="0+0+2">0+0+2</option>
          <option value="2+2+2">2+2+2</option>
        </datalist>
      </p>
      <p>
      <input type="submit" id="addMed" value="+" class="col-xs-2 col-sm-1 col-md-1"></p><br>
      <div id="medicine_fields">
      </div>
     <label for="investigation">Investigation:</label>
        <textarea rows="12" cols="60" name="investigation" id="investigation"></textarea>
      <label for="advice">Advice:</label>
        <textarea rows="12" cols="60" placeholder="As You Want In The Prescription" name="advice" id="advice"></textarea>
     <input type="submit" name="view" value="Confirm">
     <!--<input type="submit" name="download" value="Download Prescription">-->
      <!--<p>Send to:
      <input type="email" name="receiver" value=""></p>
      <input type="submit" name="send" value="Send Prescription">-->
      <input type="submit" name="cancel" value="Cancel">
        </form>
      </div>
</main>
</body>
<script>
countPos = 2;

// http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
$(document).ready(function(){
    window.console && console.log('Document ready called');

    $('#addMed').click(function(event){
        // http://api.jquery.com/event.preventdefault/
        event.preventDefault();
        if ( countPos >= 9 ) {
            alert("Maximum of nine medicine entries exceeded");
            return;
        }
        countPos++;
        window.console && console.log("Adding medicine "+countPos);
        $('#medicine_fields').append(
            '<div id="position'+countPos+'"> \
            <p class="medicine">Medicine: <input class="js" type="text" name="med'+countPos+'" value="" /></p> \
            <p class="medicine">Strength: <input class="js" type="text" list="strengths" name="strength'+countPos+'" value=""> \
            <datalist id="strengths">\
            <option value="0.5mg">0.5mg</option>\
            <option value="1mg">1mg</option>\
            <option value="2mg">2mg</option>\
            <option value="5mg">5mg</option>\
            <option value="10mg">10mg</option>\
            <option value="25mg">25mg</option>\
            <option value="20mg">20mg</option>\
            <option value="50mg">50mg</option>\
            <option value="100mg">100mg</option>\
            <option value="250mg">250mg</option>\
            <option value="500mg">500mg</option>\
            </datalist></p>\
            <p class="medicine">Dose: <input class="js" type="text" list="doses" name="dose'+countPos+'" value=""> \
            <datalist id="doses">\
            <option value="1+0+0">1+0+0</option>\
            <option value="1+0+1">1+0+1</option>\
            <option value="1+1+0">1+1+0</option>\
            <option value="0+1+1">0+1+1</option>\
            <option value="1+1+1">1+1+1</option>\
            <option value="2+0+0">2+0+0</option>\
            <option value="0+2+0">0+2+0</option>\
            <option value="0+0+2">0+0+2</option>\
            <option value="2+2+2">2+2+2</option>\
            </datalist>\
            </p>\
            <input type="button" value="-" onclick="$(\'#position'+countPos+'\').remove();return false;"><br>\
            </div>');
    });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
