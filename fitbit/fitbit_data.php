<?php
session_start();
$patientid = $_SESSION['patient_id'];
include('db.php');
$msg = "";
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
  <title>MedFit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  .container {
    display: flex;
    justify-content: center;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 53px;
    margin-bottom: -58px;
    padding: 20px;
    width: 75rem;
    /* border: 1px solid black; */
  }

  .card {
    box-shadow: 2px 6px 10px -2px rgba(0, 0, 0, 0.75);
  }

  .access-token {
    width: 30rem;
    margin-top: 5rem;
  }

  .card-text {
    text-align: center;
    font-size: 35px;
  }

  #steps-data {
    font-size: 15px;
    text-align: left;
  }

  #vo2 {
    font-size: 30px;
  }

  .spo2 {
    font-size: 20px;
    text-align: left;
  }
</style>

<body>
  <?php include "nav.php"; ?>
  <?php echo $msg;  ?>

  <div class="container">
    <input class="form-control" type="text" id="accessTokenInput" placeholder="Enter Access Token">
    <button id="saveTokenButton" class="btn btn-success">Save Access Token</button>
  </div>
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
        <h6 class="card-subtitle mb-2 text-body-secondary">Data</h6>
        <p class="card-text"><span id="caloriesOut"></span> calories</p>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Distance</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Data</h6>
        <p class="card-text"><span id="distance"> </span> km</p>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Floors</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Data</h6>
        <p class="card-text"><span id="floors"> </span> floors</p>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">VO2 Max</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Data - <span id="date"></span></h6>
        <p class="card-text" id="vo2">Range: <span id="range"></span></p>
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
    document.addEventListener("DOMContentLoaded", function () {
      const saveTokenButton = document.getElementById("saveTokenButton");

      saveTokenButton.addEventListener("click", function () {
        const accessToken = document.getElementById("accessTokenInput").value;
        if (accessToken.trim() !== "") {
          localStorage.setItem("fitbitAccessToken", accessToken);
          alert("Access token saved!");
        } else {
          alert("Please enter a valid access token.");
        }
      });
      const accessToken = localStorage.getItem("fitbitAccessToken");
      if (accessToken) {
        let options = {
          headers: {
            'Authorization': 'Bearer ' + accessToken
          }
        };

        // Rest of your fetch and data display logic
        fetch('https://api.fitbit.com/1/user/-/activities/goals/daily.json', options)
          .then(response => response.json())
          .then((data) => {
            console.log(data);
            const { activeMinutes, caloriesOut, distance, floors, steps } = data.goals;
            // document.getElementById('activeMinutes').innerHTML = activeMinutes;
            document.getElementById('caloriesOut').innerHTML = caloriesOut;
            document.getElementById('distance').innerHTML = distance;
            document.getElementById('floors').innerHTML = floors;
            document.getElementById('steps').innerHTML = steps;
          })
          .catch(err => console.error(err));

        fetch('https://api.fitbit.com/1/user/-/devices.json', options)
          .then(response => response.json())
          .then((data) => {
            // console.log(data);
            const [{ battery, batteryLevel, deviceVersion, type }] = data;
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
            const [{ dateTime, value: { vo2Max } }] = data.cardioScore;
            document.getElementById('date').innerHTML = dateTime;
            document.getElementById('range').innerHTML = vo2Max;

          })
          .catch(err => console.error(err));

        fetch('https://api.fitbit.com/1/user/-/activities/heart/date/today/1d.json', options)
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
            const { displayName, fullName, gender, height, weight, age, memberSince } = user;
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
      }

  });
  </script>
</body>

</html>