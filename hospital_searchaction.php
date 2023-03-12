<?php
include 'db.php';
if(isset($_POST['query'])){

    $inputText = $_POST['query'];

    $query = "SELECT * FROM `hospital` WHERE `hospital_name` LIKE '%$inputText%' OR `city` LIKE '%$inputText%'";
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            echo "<a href='hospital_details.php?hospital_id={$row['hospital_id']}' 
            class='list-group-item list-group-item-action border-1' 
            style='font-size:18px;font-weight:bold;width:59rem;margin-left:4px;margin-top:4px;border:3px solid grey;border-radius:22px;'>
            ".$row['hospital_name'] .' '. $row['city'] ."</a>";
        }
    }
    else{

        echo "<p class='list-group-item border-1' style='font-size:18px;font-weight:bold;width:59rem;margin-left:4px;margin-top:4px;border:3px solid grey;border-radius:22px;'>No Records Found</p>";
    }
}



?>