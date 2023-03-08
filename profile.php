<?php
session_start();
$patientid = $_SESSION['patient_id'];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
<style>
    .gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}
.profile-card{
    position: relative;
    bottom: 10rem;
}

.container-data{
  display: flex;
  justify-content: center;
  flex-wrap:wrap;
  margin: 49px;
  position: relative;
  bottom: 23rem;

}
.card{
    margin-bottom: 22px;
    margin-right: 37px;
    border: 1px solid black;
}
</style>
<body>
<?php require 'includes/nav.php' ?>
<?php

if(isset($_GET['patient_id'])){

  $con = mysqli_connect("localhost","root","","medfit");
  $patientid = $_GET['patient_id'];
  $query = "SELECT * FROM `patient` WHERE `patient_id` = '$patientid'";
  $result = mysqli_query($con,$query);
  
  if(mysqli_num_rows($result)>=1){

      while($row = mysqli_fetch_assoc($result)){
          $fname = $row['first_name'];
          $lname = $row['last_name'];
          $email = $row['email'];
          $gender = $row['gender'];
          $phone = $row['phone'];
          $address = $row['address'];
          $age = $row['age'];
          
      }

  }
}

?>
<section class="" >
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0 profile-card">
          <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                  alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                <h5><?php echo $fname.' '.$lname;  ?></h5>
                <p>Fitness Freak</p>
                <i class="far fa-edit mb-5"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>Profile   </h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Email</h6>
                      <p class="text-muted"><?php echo $email;  ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Phone</h6>
                      <p class="text-muted"><?php echo $phone;  ?></p>
                    </div>
                  </div>
                  <h6>Projects</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Gender</h6>
                      <p class="text-muted"><?php echo $gender;  ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Age</h6>
                      <p class="text-muted"><?php echo $age;  ?></p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-start">
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- health vitals section -->
  <section>
    <div class="container-data">
        <div class="card" style="width: 18rem;">
          <img src="./img/bmi.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Body Mass Index</h5>
            <p class="card-text">Height: </p>
            <p class="card-text">Weight: </p>
            <p class="card-text">BMI: </p>
            <a href="#" class="btn btn-primary">Search</a>
          </div>
        </div>
        <!-- 1 -->
        <div class="card" style="width: 18rem;">
          <img src="./img/medicine.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Past Records</h5>
            <p class="card-text">allergies: </p>
            <p class="card-text">medications: </p>
            
            <p class="card-text">family history: </p>
            <a href="#" class="btn btn-primary">Search</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="./img/info.avif" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Additional Details</h5>
            <p class="card-text">Date of Birth: </p>
            <p class="card-text">Blood Group    :</p>
            <p class="card-text">Emergency Contact   :</p>
            <p class="card-text"></p>
            <a href="#" class="btn btn-primary">Search</a>
          </div>
        </div>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
  crossorigin="anonymous"></script>
</body>

</html>