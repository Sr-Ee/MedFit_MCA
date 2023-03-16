<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
<?php
ob_start();
session_start();
$msg = "";

if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])){

  include 'db.php';
  $email = $_POST['email'];
	$_SESSION['log_email'] = $email;
	$password = $_POST['password'];
	//$password = md5($password);

  $sql = "SELECT * FROM `doctors` WHERE `email`='$email' AND `password`='$password'";
  $login_query = mysqli_query($con,$sql);

  while($row=mysqli_fetch_assoc($login_query)){

		$doctorid = $row['doctor_id'];
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		$email = $row['email'];
		$gender = $row['gender'];
		$phone = $row['phone'];
		$age = $row['age'];
		$pass = $row['password'];
    $mrn = $row['mrn'];
    $speciality = $row['speciality'];
    $address = $row['clinic_address'];
    $verify_status = $row['verify_status'];
		// $verify_status = $row['verification_status'];

	}

$num_rows = mysqli_num_rows($login_query);

if($num_rows == 1 && $verify_status == "verified")
{
      //$msg = "<p style='color:red;'>Your email is verified successfully</p>";
			session_start();
			$_SESSION['doctoris_login'] = true; //user defined
			$_SESSION['name'] = $fname;
			$_SESSION['lname'] = $lname;
			$_SESSION['email'] = $email;
			$_SESSION['doctor_id'] = $doctorid;
			header("location: /MedFit_MCA/doctor/index.php");
}
else if($verify_status == "unverified"){
  
    $msg = "<p style='color:red;'>Please wait for the moderators to verify your account!!</p>";
}
else
{
  $msg = "<p style='color:red;'>Email or Password is incorrect!</p>";
}


}

?>

  <div class="signup-form">
    <form action="doctorlogin.php" method="post">
		<h2>MEDFIT LOGIN | DOCTORS</h2>
		<p>Enter credentials to login</p>
        <hr>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Enter your Registered Email" required="required" value="<?php  if(isset($_SESSION['log_email']))  
                echo $_SESSION['log_email'];  ?>">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
      
        
		<div class="form-group">
            <div class="text-center">
                <!-- <a href="register1.php" class="btn">NEXT</a> -->
                <input type="submit" name="login" value="LOGIN " class="btn btn-primary btn-lg">
        </div>
        </div>
		<?php  echo  $msg; ?>
    </form>
	<div class="hint-text">Don't have an account? <a href="register.php">Register here</a></div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>