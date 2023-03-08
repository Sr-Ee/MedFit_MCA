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
    <h1 class="text-center">Blogs</h1>
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
//   echo "Connection successful";
}

?>

<form class="row g-3" action="searchblog.php" method="post">
    <br>
    <h3>Search for blogs</h3>
  <div class="col-auto">
  <select class="form-select" aria-label="Default select example" name="category" >
  <option selected>Select your Category</option>
  <option value="Health">Health</option>
  <option value="Fitness">Fitness</option>
  <option value="Sports">Sports</option>
  <option value="Decease">Decease</option>
  <option value="Decease">Medicine</option>
</select><br>
  
  </div>
  <div class="col-auto">
    <h4>OR</h4>
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Search by title" name = "title">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Search</button>
  </div>
</form>



<?php
$category = $_POST["category"];
$title = $_POST["title"];


$sql = "SELECT * FROM `forum` where `category` = '$category' || `topic` = '$title'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
 
if($num > 0)
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
 
  
?>

<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="..." class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['topic']; ?></h5>
        <p class="card-text"><?php echo $row['info']; ?></p>
        <p class="card-text">Category:- <?php echo $row['category']; ?></p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>


<!-- <div class="card" style="width: 18rem;" id="h">
  <img src="https://unsplash.com/s/photos/hospital/300x300" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['hospital_name']; ?></h5>
    <p class="card-text">It is located in <?php echo $row['address']; ?></p>
    <a href="hospitaldetail.php" class="btn btn-primary">Details</a>
  </div>
</div><br> -->

<?php


  }
}
 
?>



</body>
</html>