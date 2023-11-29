<?php
session_start();
$patientid = $_SESSION['patient_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
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
     body {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
    height: 100vh;
  }

  @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }
    :root {
        --gradient: linear-gradient(to left top, #DD2476 10%, #FF512F 90%) !important;
    }

    .container{
        display: flex;
        justify-content: center;
        margin-top: 100px;  
    }

    .card {
        background: #fff;
        border: 1px solid #dd2476;
        color: #222;
        margin-bottom: 2rem;
        margin-right: 27px;
        box-shadow: 1px 1px 28px 0px rgba(0,0,0,0.75);
        transition: transform .2s;
    }
    .card:hover {
    transform: scale(1.1);
    cursor: pointer;
  }
  .card-subtitle{
    text-transform: capitalize;
  }

</style>

<body>
<?php require 'includes/nav.php' ?>

    <div class="container mx-auto">
        <?php
            $query1 = "SELECT * FROM `hospital`";
            $select_all_hosp_query = mysqli_query($con,$query1);
            while($row = mysqli_fetch_array($select_all_hosp_query)){
                $doctor_id = $row['hospital_id'];
                $hname = $row['hospital_name'];
                $address = $row['address'];
                $city = $row['city'];
                $opentime = $row['open_time'];                           
                $beds = $row['beds'];                           
                $speciality = $row['speciality'];                           
                $no_doctors = $row['no_doctors'];                           
                $no_nurses = $row['no_nurses'];                           
                $hospital_contact = $row['hospital_contact'];                           
                $profile_pic = $row['profile_pic']; 
                
         ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="./img/hospital.avif" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $hname;  ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $address;  ?></h6>
                        <p class="card-text">Speciality: <?php echo $speciality;  ?></p>
                        <p class="card-text">Number of Doctors: <?php echo $no_doctors;  ?></p>
                        <p class="card-text">Number of Nurses: <?php echo $no_nurses;  ?></p>
                        <p class="card-text">Number of Beds: <?php echo $beds;  ?></p>
                        <p class="card-text">Open Time: <?php echo $opentime;  ?></p>
                        <p class="card-text">Contact: <?php echo $hospital_contact;  ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>