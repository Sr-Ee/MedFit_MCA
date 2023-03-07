<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient | Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register_style.css"> <!-- register style sheet -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  </head>
  <body>
    <!-- navbar -->
    <?php require 'includes/nav.php' ?>
    <div class="alert alert-success" role="alert">
        Success! Your account has been created and now you can login.
    </div>
    <div class="signup-form">
    <form action="/MedFit_MCA/patient_register.php" method="post" style='width:28em;'>
		<h2>MEDFIT SIGNUP</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control alldivspos" name="first_name" placeholder="First Name" required="required" value="<?php  if(isset($_SESSION['reg_fname']))  
                echo $_SESSION['reg_fname'];  ?>"></div>
			</div>        	
        </div>
        <div class="form-group">
			<div class="row">
                <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required" value="<?php if(isset($_SESSION['reg_lname']))  
                echo $_SESSION['reg_lname']; ?>"></div>
			</div>       	
        </div>
        <div class="form-group">
            <select name="role" id="role" class="form-control" required>
                <option value="" selected disabled hidden>Select your role</option>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
            </select>
        </div>    
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Enter your email" required="required" value="<?php if(isset($_SESSION['reg_email']))  
            echo $_SESSION['reg_email'];  ?>">
        </div>
        <div class="form-group">
            <select name="gender" id="gender" class="form-control" required>
                <option value="" selected disabled hidden>Select your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="phone" placeholder="Enter your phone number" pattern="\d*" maxlength="10" required="required" value="<?php  if(isset($_SESSION['reg_phone']))  
               echo $_SESSION['reg_phone']; ?>">
        </div>
        <div class="form-group">
        	<input type="number" class="form-control" name="age" placeholder="Enter your age" pattern="\d*" maxlength="5" required="required" value="<?php  if(isset($_SESSION['reg_phone']))  
               echo $_SESSION['reg_age']; ?>">
        </div> 
       

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" rows="5" cols="20"></textarea>
        </div>
        
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
        </div>     
        <!-- 		    
        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div> -->
        
		<div class="form-group">
            <div class="text-center">
                <!-- <a href="register1.php" class="btn">NEXT</a> -->
                <input type="submit" name="submit" value="SIGN UP" class="btn btn-primary btn-lg">
        </div>
        </div>
        <br>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>