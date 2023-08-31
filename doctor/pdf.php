<?php
session_start();
$con = mysqli_connect("localhost","root","","medfit");
$doctorid = $_SESSION['doctor_id'];
$name_query = "SELECT * FROM `doctors` WHERE `doctor_id`='$doctorid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['first_name'];
  $lname = $row['last_name'];
}

$msg="";

require("fpdf/fpdf.php");
if(isset($_POST['submit']))
{
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

    // $query = "INSERT INTO `added_patients` (`doctor_id`,`fname`,`lname`,`email`, `mobile`, `location`, `age`, `gender`) VALUES ('$doctorid','$fname', '$lname', '$email', '$mobile', '$location', '$age', '$gender');";
    // mysqli_query($con,$query);

    // $msg = "<p style='color:green;'>Patient Added Successfully!!</p>";
   

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','', 14);
   
     
    // Add table headers
     $pdf->Cell(100, 10,'Parameter',1);
     $pdf->Cell(80, 10,'Measurement',1);
     $pdf->Ln();

     // Add data rows to the table
    $data = array(
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
        $pdf->Cell(100, 10, $field, 1);
        $pdf->Cell(80, 10, $value, 1);
        $pdf->Ln();
    }
    $pdf->Cell(0, 10,'Health Vitals Captured by Dr. ' . $fname.' '.$lname, 1);    
    // $mpdf->output();
    $file = "health_vitals.pdf";
    $pdf->output($file,'D'); // Save PDF as file

    $query = "INSERT INTO `patient_vitals` (`doc_id`, `pat_id`, `sys_bp`, `dys_bp`, `heart_rate`, `temp`, `resp_rate`, `weight`, `height`, `bmi`, `sugar`, `ox_sat`, `allergies`, `curr_med`, `med_hist`, `symptoms`, `vit_date`, `vit_time`) VALUES ('$doctorid', '1', '$systolicBP', '$diastolicBP', '$heartRate', '$temperature', '$respiratoryRate', '$weight', '$height', '$bmi', '$bloodSugar', '$oxygenSaturation', '$allergies', '$medications', '$medicalHistory', '$symptoms', '$date', '$time');";
    mysqli_query($con,$query);

    $msg = "<p style='color:green;'>Patient Added Successfully!!</p>";
    
   
}



?>