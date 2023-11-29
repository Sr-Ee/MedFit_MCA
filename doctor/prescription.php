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
    $systolicBP = $_POST['systolicBP'];
    $diastolicBP = $_POST['diastolicBP'];
    $heartRate = $_POST['heartRate'];
    $temperature = $_POST['temperature'];
    $respiratoryRate = $_POST['respiratoryRate'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi = $_POST['bmi'];
    $bloodSugar = $_POST['bloodSugar'];
    $oxygenSaturation = $_POST['oxygenSaturation'];
    $allergies = $_POST['allergies'];
    $medications = $_POST['medications'];
    $medicalHistory = $_POST['medicalHistory'];
    $symptoms = $_POST['symptoms'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    // $email = $_POST['mail'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','', 14);
    $cellWidth = 60;

    $logoPath = 'C:/xampp/htdocs/MedFit_MCA/img/medical.png'; // Replace with the actual path to your logo file
    $pdf->Image($logoPath, 10, 4, 30); // Adjust the coordinates and dimensions as needed

    // Add table headers
    $pdf->SetTextColor(0, 153, 51); // Set text color to blue (RGB: 0, 0, 255)
    // Add a multicell for headers
    //$pdf->SetDrawBorder(0); // Turn off cell borders
    $pdf->MultiCell(0, 10, 'Dr. ' . $fname . ' ' . $lname, 0, 'C');
    $pdf->MultiCell(0, 10, 'Qualification: ' . $qualification, 0, 'C');
    $pdf->MultiCell(0, 10, 'Clinic Address: ' . $clinic_address, 0, 'C');
    //$pdf->SetDrawBorder(1); // Turn on cell borders for data rows
    
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
        'Systolic Blood Pressure (mmHg)' => $systolicBP,
        'Diastolic Blood Pressure (mmHg)' => $diastolicBP,
        'Heart Rate (bpm)' => $heartRate,
        'Body Temperature (°C)' => $temperature,
        'Respiratory Rate (breaths per minute)' => $respiratoryRate,
        'Weight (kg)' => $weight,
        'Height (cm)' => $height,
        'Body Mass Index (BMI)' => $bmi,
        'Fasting Blood Sugar (mg/dL)' => $bloodSugar,
        'Oxygen Saturation (%)' => $oxygenSaturation,
        'Allergies' => $allergies,
        'Current Medications' => $medications,
        'Medical History' => $medicalHistory,
        'Presenting Symptoms' => $symptoms,
        'Date' => $date,
        'Time' => $time,
    );

    foreach ($data as $field => $value) {
        $pdf->MultiCell(100, 10, $field, 1);
        $pdf->SetXY($pdf->GetX() + 100, $pdf->GetY() - 10); // Move to the next column
        $pdf->MultiCell(90, 10, $value, 1);
       // $pdf->Ln();
    }
   
    // $mpdf->output();
    $file = "prescription.pdf";
    $pdf->output($file,'D'); // Save PDF as file

    $query = "INSERT INTO `prescription` (`doc_id`, `pat_id`, `complaints`, `examination`, `diagnosis`, `medication`, `investigation`, `advice`) VALUES ('$doctorid', '$patient_id', '$comp', '$exam', '$diagnosis', '$medication', '$investigation', '$advice');";
    mysqli_query($con,$query);

    $query1 = "INSERT INTO `patient_vitals` (`doc_id`, `pat_id`, `sys_bp`, `dys_bp`, `heart_rate`, `temp`, `resp_rate`, `weight`, `height`, `bmi`, `sugar`, `ox_sat`, `allergies`, `curr_med`, `med_hist`, `symptoms`, `vit_date`, `vit_time`) VALUES ('$doctorid', '1', '$systolicBP', '$diastolicBP', '$heartRate', '$temperature', '$respiratoryRate', '$weight', '$height', '$bmi', '$bloodSugar', '$oxygenSaturation', '$allergies', '$medications', '$medicalHistory', '$symptoms', '$date', '$time');";
    mysqli_query($con,$query1);

   
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
	$mail->Username = "";
	$mail->Password = "";
	$mail->SetFrom("");
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