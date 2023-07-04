<?php
session_start();
if(isset($_POST["doctor"])){
$_SESSION["doctor_name"]="Dr. ".$_POST["doctor"];
if(strlen($_POST["degree1"])>1 && strlen($_POST["degree2"])>1){
  $degree1=$_POST["degree1"].",";
}
elseif(strlen($_POST["degree1"])>1 && strlen($_POST["degree2"])<1){
  $degree1=$_POST["degree1"];
}
else{
  $degree1="";
}
if(strlen($_POST["degree2"])>1 && strlen($_POST["degree3"])>1){
  $degree2=$_POST["degree2"].",";
}
elseif(strlen($_POST["degree2"])>1 && strlen($_POST["degree3"])<1){
  $degree2=$_POST["degree2"];
}
else{
  $degree2="";
}
if(strlen($_POST["degree3"])>1 && strlen($_POST["degree4"])>1){
  $degree3=$_POST["degree3"].",";
}
elseif(strlen($_POST["degree3"])>1 && strlen($_POST["degree4"])<1){
  $degree3=$_POST["degree3"];
}
else{
  $degree3="";
}
if(strlen($_POST["degree4"])>1){
  $degree4=$_POST["degree4"];
}
else{
  $degree4="";
}
$_SESSION["degrees"]=$degree1.$degree2.$degree3.$degree4;
//Work Address
if(strlen($_POST["designation"])>1 && strlen($_POST["work_address"])>1){
  $_SESSION["designation"]=$_POST["designation"];
  $_SESSION["work_address"]=$_POST["work_address"];
}
else{
  $_SESSION["designation"]="";
  $_SESSION["work_address"]="";
}
//Previous Work address
if(strlen($_POST["ex_designation"])>1 && strlen($_POST["ex_work_address"])>1){
  $_SESSION["ex_designation"]=$_POST["ex_designation"];
  $_SESSION["ex_work_address"]=$_POST["ex_work_address"];
  }
else{
  $_SESSION["ex_designation"]="";
  $_SESSION["ex_work_address"]="";
}
//Contact Information
if(isset($_POST["phone"])){
$_SESSION["doctor_phone"]=$_POST["phone"];
}
if(isset($_POST["doctor_email"])){
  $_SESSION["doctor_email"]=$_POST["doctor_email"];
}
else{
  $_SESSION["doctor_email"]="";
}
header("Location: create.php");
return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,intital-scale=1.0">
  <title> Prescription Generator</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header>
<div class="mynavbar container-fluid p-0">
  <nav class="navbar sticky-top navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="index.html">
      <img class="logo" src="images/pg.png" width="60" height="60" alt="">
    </a>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Create Prescription</a>
      </li>
    </ul>
  </div>
</nav>
</div>
</header>
<main>
  <div class="container">
    <div class="row">
      <div class="col-4">
      </div>
      <div class="col create align-self-center">
          <h1>Prescription Generator
      </div>
      </div>
  </div>
<div class="container-fluid">
<h3>Enter Your Particulars</h3>
<div class="form_div">
  <form method="post" action="docinfo.php">
    <div class="doctor_name">
    <label for="doctor_name">Enter Your Name: </label>
    <input type="text" name="doctor" id="doctor_name" required><br></div>
    <label for="degree">Degree(s)</label><br>
    <input id="degree" type="text" name="degree1" class="degree col-sm-12 col-md-5 col-lg-4" placeholder="e.g, FCPS">&nbsp; &nbsp;
    <input type="text" name="degree2" class="degree col-sm-12 col-md-5 col-lg-4" placeholder="e.g, MRCP">&nbsp; &nbsp;
    <input type="text" name="degree3" class="degree col-sm-12 col-md-5 col-lg-4"placeholder="e.g, DGO">&nbsp; &nbsp;
    <input type="text" name="degree4" class="degree col-sm-12 col-md-5 col-lg-4"placeholder="e.g, MRCS">
    <h5>Work Address:</h5>
    <label for="des">Designation: </label>
    <input type="text" name="designation" id="des" class="col-md-4" placeholder="e.g, Professor">
    <label for="work_address">Address: </label>
    <input type="text" name="work_address" id="work_address" class="col-md-6" placeholder="e.g, Mount Elizabeth Hospital, Park Street,Singapore">
    <h5>Previous Work Address(if any):</h5>
      <label for="des_prev">Designation: </label>
      <input type="text" name="ex_designation" id="des_prev"  class="col-md-4" placeholder="e.g, Associate Professor">
      <label for="ex_work_address">Address: </label>
      <input type="text" name="ex_work_address" id="ex_work_address" class="col-md-6" placeholder="e.g, Mount Elizabeth Hospital, Park Street,Singapore"><br>
    <h5>Contact Information</h5>
    <label for="phone">Contact Number:</label>
    <input type="text" name="phone" id="phone" class="col-md-5" placeholder="+880-123456789" required>
    <label for="doctor_email">Email:</label>
    <input type="email" name="doctor_email" id="doctor_email" class="col-md-5">
    <input type="submit" name="send" value="Confirm">
  </form>
</div>
</div>
<main>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
