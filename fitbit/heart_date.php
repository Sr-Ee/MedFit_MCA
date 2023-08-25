<!DOCTYPE html>
<html>
<head>
    <title>Fitbit - Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
.container{
    display: flex;
    flex-direction: column;
    width: 31rem;
    margin-top: 5rem;
}
li{
    font-size: 20px;
}
</style>
<body>
<?php include "nav.php"; ?>
  <div class="container">
  <h1>Heart Rate by Date</h1>
  <input class="form-control" type="text" id="accessTokenInput" placeholder="Enter Access Token">
    <button id="saveTokenButton" class="btn btn-success">Save Access Token</button>
    <br>
    <label for="dateInput">Select Date:</label>
    <input class="form-control" type="date" id="dateInput" value="">
    <button id="fetchDataButton" class="btn btn-success">Fetch Heart Rate Data</button>
    <div id="heartRateData"></div>
    
  </div>
   
    <script src="heart_date1.js"></script>
</body>
</html>
