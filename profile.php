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
          $height = $row['height'];
          $weight = $row['weight'];
          $profile_pic = $row['profile_pic'];
          
      }

}
$msg="";
if(isset($_POST['submit'])){
  $p_height = $_POST['height'];
  $p_weight = $_POST['weight'];
  $p_age = $_POST['age'];
  $p_location = $_POST['location'];
  $p_email = $_POST['email'];
  $image = basename($_FILES['image']['name']);
  $image_temp = $_FILES['image']['tmp_name']; //temporary location in the server.

  $destination = "./img/" . $image;

  move_uploaded_file($image_temp,$destination);
  
  if(empty($profile_pic)){
          
    $query = "SELECT * FROM `patient` WHERE `patient_id` = '$patientid'";
    $select_image = mysqli_query($con,$query);
    while($row=mysqli_fetch_array($select_image)){
      $profile_pic = $row['profile_pic'];
    } 
}else {
  $profile_pic = $image;
}

  $update_query = "UPDATE `PATIENT` SET `HEIGHT`='$p_height',`WEIGHT`='$p_weight',`AGE`='$p_age',`ADDRESS`='$p_location',`EMAIL`='$p_email',`PROFILE_PIC`='$profile_pic' WHERE `PATIENT_ID`='$patientid'";
  $update_profile1 = mysqli_query($con,$update_query);
  if(!$update_profile1){
    die("Query Failed" . mysqli_error($con));
  }
  else{
    $msg = "<p style='color:red;'>Profile Updated Successfully!!</p>";
  }
}

?>
  <div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="profile-nav col-md-3">
        <div class="panel">
          <div class="user-heading round">
            <a href="#">
              <img src='./img/<?php echo $profile_pic;  ?>' alt="">
            </a>
            <h1>
              <?php echo $fname.'  '.$lname;  ?>
            </h1>
            <p>
              <?php echo $email;  ?>
            </p>
          </div>

          <ul class="nav nav-pills nav-stacked">
            <li><a href="patient_appointments.php"> <i class="fa fa-calendar"></i> Your Appointments <span
                  class="label label-warning pull-right r-activity"></span></a></li>
          </ul>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Edit Profile
          </button>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <form action="profile.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="height" class="form-label">Height</label>
                      <input value="<?php echo $height; ?>" type="text" name="height" class="form-control" id="height" aria-describedby="emailHelp" placeholder="eg: 171 cms">                     
                    </div>
                    <div class="mb-3">
                      <label for="weight" class="form-label">Weight</label>
                      <input value="<?php echo $weight; ?>" type="text" name="weight" class="form-control" id="weight" aria-describedby="emailHelp" placeholder="eg: 60 kg">                    
                    </div>
                    <div class="mb-3">
                      <label for="age" class="form-label">Age</label>
                      <input value="<?php echo $age; ?>" type="text" name="age" class="form-control" id="age" aria-describedby="emailHelp">                    
                    </div>
                    <div class="mb-3">
                      <label for="fname" class="form-label">Address</label>
                      <input value="<?php echo $address; ?>" type="text" name="location" class="form-control" id="location" aria-describedby="emailHelp">                    
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input value="<?php echo $email; ?>" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                      <label for="image" class="form-label">Update Profile Picture</label>
                      <img width="100" src="./img/<?php echo $profile_pic; ?>" alt="">
                      <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
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
                <p><span>First Name: </span>
                  <?php echo $fname;  ?>
                </p>
              </div>
              <div class="bio-row">
                <p><span>Last Name: </span>
                  <?php echo $lname;  ?>
                </p>
              </div>
              <div class="bio-row">
                <p><span>Address: </span>
                  <?php echo $address;  ?>
                </p>
              </div>
              <div class="bio-row">
                <p><span>Age: </span>
                  <?php echo $age;  ?>
                </p>
              </div>
              <div class="bio-row">
                <p><span>Height: </span> <?php echo $height;  ?> cms</p>
              </div>
              <div class="bio-row">
                <p><span>Weight: </span><?php echo $weight;  ?> kg</p>
              </div>
              <div class="bio-row">
                <p><span>BMI: </span>45</p>
              </div>
              <div class="bio-row">
                <p><span>Phone: </span>
                  <?php echo $phone;  ?>
                </p>
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