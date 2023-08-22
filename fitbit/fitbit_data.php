<?php
session_start();
$patientid = $_SESSION['patient_id'];
include('db.php');
$msg = "";
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
}
if(isset($_POST['submit'])){
  
  $access_token = $_POST['accessToken'];
  $query = "INSERT INTO `fitbit` (`access_token`,`patient_id`) VALUES ('$access_token','$patientid');";
  mysqli_query($con,$query);
  $msg = " <div class='alert alert-success' role='alert' style='margin-top:3rem;'>
    Access Token added successfully
  </div>";
}
// if(isset($_POST['spo2-submit'])){
  
//   $spo_date = $_POST['spo2-date'];
//   $query = "INSERT INTO `fitbit` (`access_token`,`patient_id`) VALUES ('$access_token','$patientid');";
//   mysqli_query($con,$query);
//   $msg = " <div class='alert alert-success' role='alert' style='margin-top:3rem;'>
//     Access Token added successfully
//   </div>";
// }

$query1 = "SELECT * FROM `fitbit` WHERE `patient_id` = '$patientid'";
$pat_result = mysqli_query($con,$query1);
  
  if(mysqli_num_rows($pat_result)>=1){

      while($row = mysqli_fetch_assoc($pat_result)){
          $access_token_db = $row['access_token'];
          
      }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MedFit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
.container{
    display: flex;
    justify-content: center;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 110px;
    padding: 20px;
    width: 60rem;
    /* border: 1px solid black; */
}

.card{
    box-shadow: 2px 6px 10px -2px rgba(0,0,0,0.75);
}
  .access-token{
    width: 30rem;
    margin-top: 5rem;
  }
.card-text{
    text-align: center;
    font-size: 35px;
}

#steps-data{
    font-size: 15px;
    text-align: left;
}
#vo2{
    font-size: 30px;
}
.spo2{
    font-size: 20px;
    text-align: left;
}
</style>

<body>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/MedFit_MCA/welcome.php">MedFit</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">FitBit Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php echo $msg;  ?>
  <div class="container">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Profile</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">data</h6>
            <p class="card-text" id="steps-data">Name - <span id="full-name"></span></p>
            <p class="card-text" id="steps-data">Gender - <span id="gender"></span></p>
            <p class="card-text" id="steps-data">Age - <span id="age"></span></p>
            <p class="card-text" id="steps-data">Height - <span id="height"></span></p>
            <p class="card-text" id="steps-data">Weight - <span id="weight"></span></p>
            <!-- <p class="card-text" id="steps-data">BMI <span id="bmi"></span></p> -->
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Device</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">data</h6>
            <p class="card-text" id="steps-data">Battery - <span id="battery"></span></p>
            <p class="card-text" id="steps-data">Battery level - <span id="batteryLevel"></span></p>
            <p class="card-text" id="steps-data">Device Version - <span id="deviceVersion"></span></p>
            <p class="card-text" id="steps-data">Type - <span id="type"></span></p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Steps</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Steps - today</h6>
            <p class="card-text"><span id="steps"></span> steps</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Calories Burnt</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">2771 calories</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Distance</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">1.8 km</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Floors</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">4 Floors</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Max heart rate</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">177 bpm</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Min heart rate</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">144 bpm</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">VO2 Max</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by date - <span id="date"></span></h6>
            <p class="card-text" id="vo2">Range: <span id="range"></span></p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Breathing Rate</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by date</h6>
            <p class="card-text" id="vo2">17.8</p>
        </div>
    </div>
  </div>








  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!-- <script src="./steps.js"></script> -->
  <!-- <script src="./heartrate.js"></script> -->
<script>
// const accessToken = '<?php //echo $access_token_db;  ?>';
const accessToken = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMzhaU1ciLCJzdWIiOiI5UDRKM00iLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJlY2cgcnNldCByb3h5IHJudXQgcnBybyByc2xlIHJjZiByYWN0IHJsb2MgcnJlcyByd2VpIHJociBydGVtIiwiZXhwIjoxNjkyNTQ3MzUxLCJpYXQiOjE2OTI1MTg1NTF9.y0W6AKqadG0IzzSSyVEv1_CMQTsOA6ORItLMdjXyV0w';
let options = {
    headers: {
        'Authorization': 'Bearer ' + accessToken
    }
};
fetch('https://api.fitbit.com/1/user/-/activities/goals/daily.json', options)
    .then(response => response.json())
    .then((data) => {
        console.log(data);
        const { activeMinutes, caloriesOut, distance, floors, steps } = data.goals;
        // document.getElementById('activeMinutes').innerHTML = activeMinutes;
        // document.getElementById('caloriesOut').innerHTML = caloriesOut;
        // document.getElementById('distance').innerHTML = distance;
        // document.getElementById('floors').innerHTML = floors;
        document.getElementById('steps').innerHTML = steps;
    })
    .catch(err => console.error(err));

fetch('https://api.fitbit.com/1/user/-/devices.json', options)
    .then(response => response.json())
    .then((data) => {
        // console.log(data);
        const [{ battery,batteryLevel,deviceVersion,type }] = data;
        document.getElementById('battery').innerHTML = battery;
        document.getElementById('batteryLevel').innerHTML = batteryLevel;
        document.getElementById('deviceVersion').innerHTML = deviceVersion;
        document.getElementById('type').innerHTML = type;
    })
    .catch(err => console.error(err));

fetch('https://api.fitbit.com/1/user/-/cardioscore/date/today.json', options)
    .then(response => response.json())
    .then((data) => {
        console.log(data);
        const [{  dateTime,value: { vo2Max } }] = data.cardioScore;
        document.getElementById('date').innerHTML = dateTime;
        document.getElementById('range').innerHTML = vo2Max;
       
    })
    .catch(err => console.error(err));

fetch('https://api.fitbit.com/1/user/-/activities/heart/date/today/30d.json', options)
    .then(response => response.json())
    .then((data1) => {
        console.log(data1);
        const { "activities-heart": [{ value: { restingHeartRate, heartRateZones } }] } = data1;
        const { max, min } = heartRateZones.find(zone => zone.name === "Cardio");
        document.getElementById('restingHeartRate').innerHTML = restingHeartRate;
        document.getElementById('max').innerHTML = max;
        document.getElementById('min').innerHTML = min;
        console.log("Resting heart rate: " + restingHeartRate);
        console.log("Max heart rate: " + max);
        console.log("Min heart rate: " + min);
        
    })
    .catch(err => console.error(err));

fetch('https://api.fitbit.com/1/user/-/profile.json', options)
.then(response => {
  if (!response.ok) {
    throw new Error('Error retrieving profile data: ' + response.status);
  }
  return response.json();
})
.then(data => {
  console.log(data);
  const { user } = data;
  const { displayName, fullName, gender, height, weight, age,memberSince } = user;
  document.getElementById('full-name').innerHTML = fullName;
  document.getElementById('age').innerHTML = age;
  document.getElementById('gender').innerHTML = gender;
  document.getElementById('height').innerHTML = height;
  document.getElementById('weight').innerHTML = weight;
  // document.getElementById('mem-since').innerHTML = memberSince;
})
.catch(err => console.error(err));


fetch('https://api.fitbit.com/1/user/-/activities/heart/date/today/1d/1sec.json', options)
  .then(response => response.json())
  .then((data) => {
    const heartRate = data['activities-heart-intraday'].dataset[0].value;
    console.log('Real-time heart rate:', heartRate);

    // Process the real-time heart rate data as needed
    // For example, update UI, perform calculations, etc.
    document.getElementById('realTimeHeartRate').innerHTML = heartRate;
  })
  .catch(err => console.error(err));


</script>
</body>

</html>