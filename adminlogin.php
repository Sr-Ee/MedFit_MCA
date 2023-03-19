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

  .signup-form form {
    border-radius: 21px;  
  }

  </style>
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

  $sql = "SELECT * FROM `admins` WHERE `admin_email`='$email' AND `admin_password`='$password'";
  $login_query = mysqli_query($con,$sql);

  while($row=mysqli_fetch_assoc($login_query)){

		$adminid = $row['admin_id'];
		$fname = $row['admin_fname'];
		$lname = $row['admin_lname'];
		$email = $row['admin_email'];
		$gender = $row['admin_gender'];
		$pass = $row['admin_password'];
    $address = $row['admin_address'];
		// $verify_status = $row['verification_status'];
}

$num_rows = mysqli_num_rows($login_query);

if($num_rows == 1)
{
      //$msg = "<p style='color:red;'>Your email is verified successfully</p>";
			session_start();
			$_SESSION['admin_login'] = true; //user defined
			$_SESSION['name'] = $fname;
			$_SESSION['lname'] = $lname;
			$_SESSION['email'] = $email;
			$_SESSION['admin_id'] = $adminid;
			header("location: /MedFit_MCA/admin/index.php");
}
else
{
  $msg = "<p style='color:red;'>Email or Password is incorrect!</p>";
}


}

?>

  <div class="signup-form">
    <form action="adminlogin.php" method="post">
		<h2>MEDFIT LOGIN | ADMINS</h2>
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
	<!-- <div class="hint-text">Don't have an account? <a href="register.php">Register here</a></div> -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>