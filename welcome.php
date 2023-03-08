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
.container{
  display: flex;
  justify-content: center;
  flex-wrap:wrap;
  margin: 49px;
}
.card{
  margin-bottom: 25px;
  margin-right: 37px;
  transition: transform .2s;
}
.card:hover{
  transform: scale(1.1); 
  cursor: pointer;
}
.btn{
  display: block;
  margin: 0 auto;
}
.session-details{
  font-size: 20px;
    color: white;
    position: relative;
    right: 36px;
}
</style>
<body>
  <?php require 'includes/nav.php' ?>
<div class="container">
  <div class="card" style="width: 18rem;">
    <img src="./img/hospital.avif" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Search Hospitals</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="hospital_search.php" class="btn btn-primary">Search</a>
    </div>
  </div>
  <!-- 1 -->
  <div class="card" style="width: 18rem;">
    <img src="./img/doctor.webp" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Search Doctors</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="doc_search.php" class="btn btn-primary">Search</a>
    </div>
  </div>
  <!-- 2 -->
  <div class="card" style="width: 18rem;">
    <img src="./img/app.webp" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Book Appointment</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Book</a>
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <img src="./img/fitness.avif" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">FitBit</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Access Your FitBit Data</a>
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <img src="./img/vault.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Health Vault</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Access Health Vault</a>
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <img src="./img/fitprofile.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Fitness Profile</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="profile.php?patient_id=<?php echo $patientid ?>" class="btn btn-primary">Profile</a>
    </div>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>