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
  <script src="https://cdn.jsdelivr.net/npm/@alan-ai/alan-sdk-web/dist/alan-sdk-web.js"></script>
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

  .container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin: 77px;
  }

  .card {
    margin-bottom: 25px;
    margin-right: 37px;
    transition: transform .2s;

  }

  .card:hover {
    transform: scale(1.1);
    cursor: pointer;
  }

  .btn {
    display: block;
    margin: 0 auto;
  }

  .session-details {
    font-size: 20px;
    color: white;
    position: relative;
    right: 36px;
  }
  
  

</style>

<body>
<div class="alan-btn"></div>
  <?php require 'includes/nav.php' ?>
  <div class="container">
    <div class="card" style="width: 18rem;">
      <img src="./img/hospital.avif" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Search Hospitals</h5>
        <p class="card-text">Whether you're seeking emergency care or planning a medical procedure, 
          our search hospitals functionality makes it simple to find the right facility for you.</p>
        <a href="hospital_search.php" class="btn btn-primary">Search</a>
      </div>
    </div>
    <!-- 1 -->
    <div class="card" style="width: 18rem;">
      <img src="./img/doctor.webp" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Search Doctors</h5>
        <p class="card-text">With our search doctors functionality, finding the right medical professional has never been easier.</p>
        <a href="doc_search.php" class="btn btn-primary">Search</a>
      </div>
    </div>
    <!-- 2 -->
    <div class="card" style="width: 18rem;">
      <img src="./img/app.webp" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Your Appointments</h5>
        <p class="card-text">Our booking appointments functionality lets you choose the perfect date and time to fit your schedule, 
          all with just a few clicks.</p>
        <a href="patient_appointments.php" class="btn btn-primary">Access Appointments</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="./img/fitness.avif" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Nutrition Analysis</h5>
        <p class="card-text">Take control of your health with our nutrition analysis of food functionality - 
          get the facts about the food you're eating and make informed choices.</p>
        <a href="foodapi/index.php" class="btn btn-primary">Analyze</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="./img/heart.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Heart Rate Failure & Diabetes Prediction</h5>
        <p class="card-text">Introducing our innovative heart failure prediction feature: 
          harnessing advanced algorithms to analyze key biometrics and trends, enabling proactive monitoring and early detection for optimal cardiac care</p>
        <a href="http://127.0.0.1:5000/" class="btn btn-primary">Access MedHeart</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="./img/fitprofile.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Fitness Profile</h5>
        <p class="card-text">Take your fitness journey to the next level with our fitness profile functionality - create a 
          customized workout plan and track your progress in one convenient location.</p>
        <a href="profile.php" class="btn btn-primary">Profile</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="./img/fitprofile.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Medbot</h5>
        <p class="card-text">Your Bot For Your Queries</p>
        <a href="https://mediafiles.botpress.cloud/b69a61b9-3460-446a-8917-adaf4d05dced/webchat/bot.html" class="btn btn-primary">Access Medbot</a>
      </div>
    </div>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/6416faeb31ebfa0fe7f3747e/1grss8ag5';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script> -->
  <!--End of Tawk.to Script-->
</body>

<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script>
  window.botpressWebChat.init({
      "composerPlaceholder": "Chat with MedBot",
      "botConversationDescription": "Medical bot",
      "botId": "b69a61b9-3460-446a-8917-adaf4d05dced",
      "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
      "messagingUrl": "https://messaging.botpress.cloud",
      "clientId": "b69a61b9-3460-446a-8917-adaf4d05dced",
      "webhookId": "8f79930a-ece6-46b1-875f-9a7a58f9d102",
      "lazySocket": true,
      "themeName": "prism",
      "botName": "MedBot",
      "frontendVersion": "v1",
      "useSessionStorage": true,
      "enableConversationDeletion": true,
      "showPoweredBy": false,
      "theme": "prism",
      "themeColor": "#2563eb"
  });
</script>
</html>