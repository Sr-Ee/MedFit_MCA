<?php
session_start();
$con = mysqli_connect("localhost","root","","medfit");
$doctorid = $_SESSION['doctor_id'];
$name_query = "SELECT * FROM `doctors` WHERE `doctor_id`='$doctorid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  $qualification = $row['qualification'];
  $clinic_address = $row['clinic_address'];
}

$msg="";

require("fpdf/fpdf.php");
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $comp = $_POST['comp'];
    $exam = $_POST['exam'];
    $diagnosis = $_POST['diagnosis'];
    $medication = $_POST['medication'];
    $investigation = $_POST['investigation'];
    $advice = $_POST['advice'];
    // $email = $_POST['mail'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','', 14);
    $cellWidth = 60;

    // Add table headers
    $pdf->SetTextColor(0, 153, 51); // Set text color to blue (RGB: 0, 0, 255)
    $pdf->Cell(0, 10,'Dr. ' . $fname.' '.$lname, 1);    
    $pdf->Ln();
    $pdf->Cell(0, 10,'Qualification: ' . $qualification, 1);    
    $pdf->Ln();
    $pdf->Cell(0, 10,'Clinic Address: ' . $clinic_address, 1);    
    $pdf->Ln();
    $pdf->SetTextColor(0); // Reset text color to default (black)
    
     // Add data rows to the table
    $data = array(
        'Name' => $name,
        'Age' => $age,
        'Gender' => $gender,
        'Chief Complaints' => $comp,
        'Examination' => $exam,
        'Diagnosis' => $diagnosis,
        'Medication' => $medication,
        'investigation' => $investigation,
        'Advice' => $advice,
    );

    foreach ($data as $field => $value) {
        $pdf->MultiCell(80, 10, $field, 1);
        $pdf->SetXY($pdf->GetX() + 80, $pdf->GetY() - 10); // Move to the next column
        $pdf->MultiCell(100, 10, $value, 1);
        $pdf->Ln();
    }
   
    // $mpdf->output();
    $file = "prescription.pdf";
    $pdf->output($file,'D'); // Save PDF as file

    $query = "INSERT INTO `prescription` (`doc_id`, `pat_id`, `complaints`, `examination`, `diagnosis`, `medication`, `investigation`, `advice`) VALUES ('$doctorid', '$patient_id', '$comp', '$exam', '$diagnosis', '$medication', '$investigation', '$advice');";
    mysqli_query($con,$query);


   
}



include('C:/xampp/htdocs/MedFit_MCA/doctor/EmailSendScript/smtp/PHPMailerAutoload.php');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
    $mail->AddAttachment('prescription.pdf');
	$mail->Username = "sunnyshmca04@gmail.com";
	$mail->Password = "nzpabphfvwrcgpfq";
	$mail->SetFrom("sunnyshmca04@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo 'Mail Sent Successfully!';
	}
}


if(isset($_POST['submit1'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $comp = $_POST['comp'];
    $exam = $_POST['exam'];
    $diagnosis = $_POST['diagnosis'];
    $medication = $_POST['medication'];
    $investigation = $_POST['investigation'];
    $advice = $_POST['advice'];
    $email = $_POST['mail'];
    $msg="Link Sent Sucessfully";
    $mailHtml = "
        Hello $name, Please find your attached prescription
        \n
        Thanks & Regards,
        $fname $lname
        $qualification
        ";
        smtp_mailer($email,'Prescription Details',$mailHtml);
}
else{
    echo "Mail Not Sent Sucessfully";
}



?>