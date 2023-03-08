<?php
//ob_start();
session_start();
$msg = "";
include('db.php');
if(isset($_POST['submit']))
{
    
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $password = $_POST['password'];
    $c_password = $_POST['confirmpassword'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    //check for duplicate email-id
    $check = mysqli_num_rows(mysqli_query($con,"SELECT * FROM PATIENT WHERE EMAIL='$email'"));
    if($check>0){
        $msg = "<p style='color:red;'>Email-id already exists</p>";
    }
    else{

        $verification_id=rand(111111111,999999999);
        $query = "INSERT INTO `patient` (`first_name`, `last_name`, `email`, `gender`, `phone`, `age`, `password`, `dt`, `profile_pic`, `verification_status`,`verification_id`) VALUES ('$fname', '$lname', '$email', '$gender', '$phone', '$age', '$password', current_timestamp(), 'java.png', '0',$verification_id);";
        mysqli_query($con,$query);

       
    
        $msg = "<p style='color:green;'>We have just sent a verification link to <strong>{$email}</strong><br>Please checkyour inbox and click on the link
                to get started. If you can't find this email, just request a new one here</p>";

        $mailHtml = "Please Confirm your account registration by clicking the button or link below: <a href='http://localhost/MedFit_MCA/check.php?id={$verification_id}'>
            http://localhost/MedFit_MCA/check.php?id={$verification_id}</a>";
        
        smtp_mailer($email,'Account Verification',$mailHtml);

    }

}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function smtp_mailer($to,$subject,$msg){
      try{
        require 'C:/xampp/htdocs/MedFit_MCA/php_mailer/vendor/autoload.php';
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = 1;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'sunny@coderscapital.tech';                     // SMTP username
        $mail->Password   = 'Sunny@123';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('sunny@coderscapital.tech');
        $mail->addAddress($to);     // Add a recipient
    
        //$body = '<p><strong> Hello </strong> This is my first Email</p>';
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
    
        $mail->Body    = $msg;
        //$mail->AltBody = strip_tags($body);
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register_style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
            <h3>Welcome</h3>
            <p>You are 30 seconds away from living healthy life</p>
            <a href="/login"><input type="submit" name="" value="Login" /><br /></a>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="./patient_register.php" role="tab"
                        aria-controls="home" aria-selected="true">Register</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Apply as a Patient</h3>
                    <form action="patient_register.php" method="POST">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <input type="text" class="form-control" placeholder="First Name *" value=""
                                        name="firstname" id="firstname" ng-required="true" />
                                </div>
                                <div class="form-group my-2">
                                    <input type="text" class="form-control" placeholder="Last Name *" value=""
                                        name="lastname" id="lastname" />
                                </div>
                                <div class="form-group my-2">
                                    <input type="password" class="form-control" placeholder="Password *" value=""
                                        name="password" id="password" />
                                </div>
                                <div class="form-group my-2">
                                    <input type="password" class="form-control" placeholder="Confirm Password *"
                                        value="" name="confirmpassword" id="confirmpassword" />
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group my-2">
                                    <input type="number" class="form-control" placeholder="Your Age *" value=""
                                        name="age" id="age" />
                                </div>
                                <div class="form-group">
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="gender" id="gender" value="male" checked>
                                            <span> Male </span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" id="gender" value="female">
                                            <span>Female </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <input type="email" class="form-control" placeholder="Your Email *" value=""
                                        name="email" id="email" />
                                </div>
                                <div class="form-group my-2">
                                    <input type="text" name="phone" class="form-control" placeholder="Your Phone *"
                                        value="" id="phone" />
                                </div>
                                <input type="submit" id="submit" name="submit" value="Register Now"
                                    class="btn btn-primary">

                            </div>
                            <?php
                            echo $msg;
                           ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>