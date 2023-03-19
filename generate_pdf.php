<?php
    // require_once 'C:/xampp/htdocs/Prescriptor/dompdf_2-0-3/dompdf/vendor/autoload.php';
    require_once 'C:/xampp/htdocs/MEDFIT_MCA/dompdf_2-0-3/dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;

    $conn = new PDO('mysql:host=localhost; dbname=medfit', 'root', '');

    $var1 = 5;
    $var2 = 0;

    $sql = "SELECT * FROM `prescriptions` WHERE done='N'";
    

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $sql1 = 'SELECT name FROM prescriptions WHERE doctor_id = :doctor_id';
    // $stmt = $conn->prepare($sql1);
    // $stmt->bindParam(':doctor_id', $doctor_id);
    // $stmt->execute();
    // $doctor_id = $stmt->fetchColumn();


    $html='<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Prescription</title>
        <style>
            h3{
                font-family: serif;
                text-align: center;
            }
            table{
                font-family: serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th{
                border: 1px solid black;
                padding: 10px;
            }
        </style>
    </head>
    <body>

  
        <h3>Prescription</h3>
        <table>
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Dosage</th>
                    <th>Morning</th>
                    <th>Afternoon</th>
                    <th>Evening</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($rows as $row){
                $html .= '<tr>
                <td>'.$row['medicine_name'].'</td>
                <td>'.$row['dosage'].'</td>
                <td>'.$row['m_dose'].'</td>
                <td>'.$row['a_dose'].'</td>
                <td>'.$row['e_dose'].'</td> 
            </tr>';
            }

            $html .= '        </tbody>
            </table>
        
        </body>
        </html>';

        $update = "UPDATE `prescriptions` SET done='Y' WHERE done = 'N'";
        $stmt1 = $conn->prepare($update);
        $stmt1 ->execute();

        


        $dompdf = new Dompdf();
        $dompdf -> loadHtml ($html);
        $dompdf -> setPaper('A4', 'portrait');
        $dompdf -> render();
        $dompdf -> stream('prescription.pdf', ['Attachment' => 0]);
?>

<h2>'.$doctor_id[$doctor_id].'</h2>