<?php
try {
    $conn = new PDO('mysql:host=localhost; dbname=medfit', 'root', '');
    foreach($_POST['Medicine_Name'] as $key => $value){
        $sql = 'INSERT INTO prescriptions (medicine_name, dosage, m_dose, a_dose, e_dose) VALUES (:Medicine_Name, :dosage, :m_dose, :a_dose, :e_dose)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'Medicine_Name' => $value,
            'dosage' => isset($_POST['dosage'][$key]) ? $_POST['dosage'][$key] : null,
            'm_dose' => isset($_POST['morning'][$key]) ? $_POST['morning'][$key] : null,
            'a_dose' => isset($_POST['aftrnoon'][$key]) ? $_POST['aftrnoon'][$key] : null,
            'e_dose' => isset($_POST['evening'][$key]) ? $_POST['evening'][$key] : null
        ]);
    }
    echo 'Records inserted successfully!';
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
