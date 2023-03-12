<?php
include 'db.php';
if(isset($_POST['query'])){

    $inputText = $_POST['query'];

    $query = "SELECT * FROM `doctors` WHERE `first_name` LIKE '%$inputText%' or `speciality` LIKE '%$inputText%'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            echo "<a href='doctor_details.php?doctor_id={$row['doctor_id']}' 
            class='list-group-item list-group-item-action border-1' 
            style='font-size:18px;font-weight:bold;width:59rem;margin-left:4px;margin-top:4px;border:3px solid grey;border-radius:22px;'>
            ".$row['first_name'] .' '. $row['last_name'] .'    -  ' .$row['speciality'].' ,'.$row['clinic_name']."</a>";
        }
    }
    else{

        echo "<p class='list-group-item border-1' style='font-size:18px;font-weight:bold;width:59rem;margin-left:4px;margin-top:4px;border:3px solid grey;border-radius:22px;'>No Records Found</p>";
    }
}



?>