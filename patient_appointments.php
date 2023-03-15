<?php
session_start();
$patientid = $_SESSION['patient_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
}
$con = mysqli_connect("localhost","root","","medfit");

$query1 = "SELECT * FROM `added_appointments` WHERE `patient_id` = '$patientid'";
$pat_result = mysqli_query($con,$query1);
  
  if(mysqli_num_rows($pat_result)>=1){

      while($row = mysqli_fetch_assoc($pat_result)){
          $first_name = $row['fname'];
          $last_name = $row['lname'];
          $pat_email = $row['email'];
          $pat_gender = $row['gender'];
          $pat_age = $row['age'];
          $pat_date = $row['preferred_date'];
          $pat_time = $row['preferred_time'];
          $pat_comp = $row['complaints'];
          
      }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    
    .container{
        border: 1px solid black;
        margin-top: 8rem;
        padding: 2rem;
        display: flex;
        justify-content: center;
        width:47rem;
        border-radius: 45px;
        box-shadow: 6px 16px 27px -3px rgba(0,0,0,0.75);
        transition: transform .2s;

    }
    .container:hover {
    transform: scale(1.1);
    cursor: pointer;
  }
    .card{
        width: 35rem;
        border-radius: 19px;
    }
    b{
        text-transform: capitalize;
    }
    #particles-js{
        background: blue;
    }
</style>

<body>
<?php require 'includes/nav.php' ?>
<div id="particles-js"></div>

<div class="container">
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Appointment Details</h5>
        <p class="card-text"><b><?php echo $first_name;  ?></b> Your Appointment is Scheduled at: </p>
        <p class="card-text"><b>Date: </b><?php echo $pat_date;  ?></p>
        <p class="card-text"><b>Time:</b> <?php echo $pat_time;  ?></p>
        <p class="card-text"><small class="text-muted">Visit your Email for Zoom Link</small></p>
      </div>
    </div>
  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>