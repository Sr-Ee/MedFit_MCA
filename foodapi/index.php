<?php
session_start();
$patientid = $_SESSION['patient_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Nutrition Analysis</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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
  </style>
  <?php require '../includes/nav.php' ?>
  <div class="container my-3">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">Nutrition Facts</h3>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
          <h6>Enter an ingredient list for what you are cooking, like "1 cup rice, 10 oz chickpeas", etc.
          Enter each ingredient separated by commas.</h6>
            <label for="food">Enter a food name:</label>
            <input type="text" id="food" name="food" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Analyze</button>
        </form>
        <div id="result"></div>
      </div>
    </div>
  </div>
  <!-- Add Bootstrap JS and jQuery links -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="nutrition.js"></script>
</body>
</html>
