<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register_style.css"> <!-- register style sheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "medfit";

  $conn = mysqli_connect($servername,$username,$password,$database);

  if(!$conn){
    die("Sorry we failed to connect :".mysqli_connect_error());
  }
  else{
    echo "Connection successful";
  }
 
  ?>
    
<form class="row g-3" name="myform" action="index.php" method ="post">
  <div>
    <label for="formFileLg" class="form-label">Search Hospital</label><Br><Br>
    <input class="form-control input-sm" id="formFileLg" type="text" name="hname">
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>

<?php
$hospitalname = $_POST["hname"];
echo $hospitalname  
?>

</body>
</html>