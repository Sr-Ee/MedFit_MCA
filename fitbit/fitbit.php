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
  .health-box {
    margin-top: 2rem;
  }

  .profile-container{
    display: flex;
    margin-top: 5rem;
    margin-left: 10rem;
  }

  .profile-card{
    margin-right: 46px;
  }
  .steps-filter-card{
    margin-right: 46px;
  }

  .heart-rate-card{
    margin-right: 46px;
  }
  .access-token{
    width: 30rem;
    margin-top: 5rem;
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
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php echo $msg;  ?>
  <!-- Access-Token -->
  <div class="access-token container">
    <div class="mb-3">
      <form action="fitbit.php" method="POST">
        <label for="accessToken" class="form-label">Fitbit Access Token</label>
        <input type="text" name="accessToken" class="form-control" id="accessToken" placeholder="Paste your access token here">
        <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
      </form>
     
    </div>
  </div>
  <!-- Access-Token -->

  <div class="profile-container">
    <div class="card border-success mb-3 profile-card" style="max-width: 18rem;">
      <div class="card-header">Profile</div>
      <div class="card-body text-success">
        <h5 class="card-title">Name: <span id="full-name"></span></h5>
        <p class="card-text">DOB: <span id="dob"></span></p>
        <p class="card-text">Gender: <span id="gender"></span></p>
        <p class="card-text">Height: <span id="height"></span></p>
        <p class="card-text">Weight: <span id="weight"></span></p>
        <p class="card-text">Member Since: <span id="mem-since"></span></p>
      </div>
    </div>
    <!-- steps filter -->
    <div class="card steps-filter-card border border-primary" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Steps Filter</h5>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Start Date:</label>
          <input type="date" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">End Date:</label>
          <input type="date" class="form-control" id="exampleFormControlInput2">
        </div>
        <button class="btn btn-primary">Calculate</button>
      </div>
    </div>
     <!-- heart-rate filter -->
    <div class="card heart-rate-card border border-primary" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Heart Rate Filter</h5>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Start Date:</label>
          <input type="date" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">End Date:</label>
          <input type="date" class="form-control" id="exampleFormControlInput2">
        </div>
        <button class="btn btn-primary">Calculate</button>
      </div>
    </div>
     <!-- heart-rate filter -->
    
     <!-- SPO2 filter -->
    <div class="card border border-primary" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">SpO2 Filter</h5>
        <div class="mb-3">
          <form action="fitbit.php" method="post">
            <label for="exampleFormControlInput1" class="form-label">Select Date:</label>
            <input type="date" name="spo2-date" class="form-control" id="spo2-control">
          </div>
          <input type="submit" id="submit" name="spo2-submit" value="Calculate" class="btn btn-primary">
        </form>
      </div>
    </div>


  </div>
  
  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center health-box">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border border-primary">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Steps</h4>
            <small><img src="https://media.tenor.com/gVKKWG-Jt58AAAAC/idctest-idc.gif" width="60" height="60"
                alt="steps icon"></small>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><span id="steps"></span> <small
                class="text-muted fw-light">steps</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Active Minutes: <span id="activeMinutes"></span> <small class="text-muted fw-light">mins</small></li>
              <!-- <li>Active Zone Minutes: <span id="activeZoneMinutes"></span> <small class="text-muted fw-light">steps</small></li> -->
              <li>Calories Burnt: <span id="caloriesOut"></span> <small class="text-muted fw-light">calories</small>
              </li>
              <li>Distance: <span id="distance"></span> <small class="text-muted fw-light">Km</small></li>
              <li>Floors: <span id="floors"></span></li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">More Info</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border border-primary">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Heart Rate</h4>
            <small><img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/7524c582986207.5d2e5b8c470e2.gif"
                width="100" height="100" alt="heart icon"></small>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><span id="restingHeartRate"></span><small
                class="text-muted fw-light"> BPM</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Max Heart Rate: <strong><span id="max"></span></strong> bpm</li>
              <li>Min Heart Rate: <strong><span id="min"></span></strong> bpm</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">More Info</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">SpO2</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">%SpO2<small class="text-muted fw-light"></small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>SpO2 Min: <strong><span id="spo2-min"></span></strong></li>
              <li>SpO2 Avg: <strong><span id="spo2-avg"></span></strong> </li>
              <li>SpO2 Max: <strong><span id="spo2-max"></span></strong> </li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary">More Info</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!-- <script src="./steps.js"></script> -->
  <!-- <script src="./heartrate.js"></script> -->
<script>
const accessToken = '<?php echo $access_token_db;  ?>';
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
        document.getElementById('activeMinutes').innerHTML = activeMinutes;
        document.getElementById('caloriesOut').innerHTML = caloriesOut;
        document.getElementById('distance').innerHTML = distance;
        document.getElementById('floors').innerHTML = floors;
        document.getElementById('steps').innerHTML = steps;
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
  const { displayName, fullName, gender, height, weight, dateOfBirth,memberSince } = user;
  document.getElementById('full-name').innerHTML = fullName;
  document.getElementById('dob').innerHTML = dateOfBirth;
  document.getElementById('gender').innerHTML = gender;
  document.getElementById('height').innerHTML = height;
  document.getElementById('weight').innerHTML = weight;
  document.getElementById('mem-since').innerHTML = memberSince;
})
.catch(err => console.error(err));


fetch('https://api.fitbit.com/1/user/-/spo2/date/30d.json', options)
    .then(response => {
      if (!response.ok) {
        document.getElementById('spo2-min').innerText = 'No Data';
        document.getElementById('spo2-avg').innerText = 'No Data';
        document.getElementById('spo2-max').innerText = 'No Data';
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
      const { value: { avg, min, max } } = data;
      document.getElementById('spo2-min').innerHTML = min;
      document.getElementById('spo2-avg').innerHTML = avg;
      document.getElementById('spo2-max').innerHTML = max;
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