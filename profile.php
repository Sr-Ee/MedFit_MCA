<?php
session_start();
$patientid = $_SESSION['patient_id'];
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="./includes/profile_style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>

</style>

<body>
  <?php require 'includes/nav.php' ?>
<?php
$con = mysqli_connect("localhost","root","","medfit");
// $patientid = $_GET['patient_id'];
$query = "SELECT * FROM `patient` WHERE `patient_id` = '$patientid'";
$result = mysqli_query($con,$query);
  
  if(mysqli_num_rows($result)>=1){

      while($row = mysqli_fetch_assoc($result)){
          $fname = $row['first_name'];
          $lname = $row['last_name'];
          $email = $row['email'];
          $gender = $row['gender'];
          $phone = $row['phone'];
          $address = $row['address'];
          $age = $row['age'];
          
      }

  }

?>
  <div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="profile-nav col-md-3">
        <div class="panel">
          <div class="user-heading round">
            <a href="#">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
            </a>
            <h1><?php echo $fname.'  '.$lname;  ?></h1>
            <p><?php echo $email;  ?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#"> <i class="fa fa-calendar"></i> Your Appointments <span
                  class="label label-warning pull-right r-activity"></span></a></li>
            <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
          </ul>
        </div>
      </div>
      <div class="profile-info col-md-9">
        <div class="panel">
        </div>
        <div class="panel">
          <div class="bio-graph-heading">
           Health is Wealth
          </div>
          <div class="panel-body bio-graph-info">
            <h1>Bio Graph</h1>
            <div class="row">
              <div class="bio-row">
                <p><span>First Name: </span><?php echo $fname;  ?></p>
              </div>
              <div class="bio-row">
                <p><span>Last Name: </span><?php echo $lname;  ?></p>
              </div>
              <div class="bio-row">
                <p><span>Address: </span><?php echo $address;  ?></p>
              </div>
              <div class="bio-row">
                <p><span>Age: </span><?php echo $age;  ?></p>
              </div>
              <div class="bio-row">
                <p><span>Height: </span>153 cms</p>
              </div>
              <div class="bio-row">
                <p><span>Weight: </span>70 kg</p>
              </div>
              <div class="bio-row">
                <p><span>BMI: </span>45</p>
              </div>
              <div class="bio-row">
                <p><span>Phone: </span><?php echo $phone;  ?></p>
              </div>
            </div>
          </div>
        </div>
        <div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>