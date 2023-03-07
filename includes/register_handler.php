<?php
session_start();
$msg="";
$error_array = array();
if(isset($_POST['submit'])){

    include 'C:/xampp/htdocs//includes/db.php';  
   
    $_SESSION['is_register'] = true;
            
    $fname = strip_tags(mysqli_real_escape_string($conn,$_POST['first_name'])); //Retrieve form values. //Remove HTML Tags
    $fname = str_replace(' ','',$fname); //Space is replaced with nothing
    $fname = ucfirst(strtolower($fname)); //Capitalize first letter.
    $_SESSION['reg_fname'] = $fname; //Stores first name into the session
    
    $lname = strip_tags(mysqli_real_escape_string($conn,$_POST['last_name'])); //Retrieve form values. //Remove HTML Tags
    $lname = str_replace(' ','',$lname); //Space is replaced with nothing
    $lname = ucfirst(strtolower($lname)); //Capitalize first letter.
    $_SESSION['reg_lname'] = $lname; //Stores first name into the session.


    $email = strip_tags(mysqli_real_escape_string($conn,$_POST['email']));
    $_SESSION['reg_email'] = $email;

    $user_gender = strip_tags(mysqli_real_escape_string($conn,$_POST['gender']));
    $_SESSION['reg_gender'] = $user_gender;

    $phone_num = strip_tags(mysqli_real_escape_string($conn,$_POST['phone']));
    $_SESSION['reg_phone'] = $phone_num;

    $age = strip_tags(mysqli_real_escape_string($conn,$_POST['age']));
    $_SESSION['reg_age'] = $age;

    $user_role = strip_tags(mysqli_real_escape_string($conn,$_POST['role']));
    $_SESSION['reg_role'] = $user_role;

    $address = strip_tags(mysqli_real_escape_string($conn,$_POST['address']));
    $_SESSION['reg_address'] = $address;
   
    $password = strip_tags(mysqli_real_escape_string($conn,$_POST['password']));
    $_SESSION['reg_pass'] = $password;
    
    $c_password = strip_tags(mysqli_real_escape_string($conn,$_POST['confirm_password']));
    $_SESSION['reg_cpass'] = $c_password;

    $clinic_address = strip_tags(mysqli_real_escape_string($conn,$_POST['clinic_address']));
    $_SESSION['reg_clinic'] = $clinic_address;

    $mrn = strip_tags(mysqli_real_escape_string($conn,$_POST['mrn']));
    $_SESSION['reg_mrn'] = $mrn;

    //Date
    $signup_date = date("Y-m-d"); //Current date

    if(preg_match("/\s/",$fname))
    {
        array_push($error_array,"Your First Name should not contain any Spaces. <br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2)
    {
        array_push($error_array,"Your First Name must be between 2 and 25 characters <br>");
    }
    
    if(strlen($lname) > 25 || strlen($lname) < 2)
    {
        array_push($error_array,"Your Last Name must be between 2 and 25 characters <br>");
    }


    if($user_role === "patient"){

       if(preg_match("/^[a-z][a-zA-Z0-9$]+(@gmail.com)/ix",$email)){
       //if(preg_match("/^[a-z][a-zA-Z0-9$]+(@gmail.com)/ix",$college_email)){

            $sql = "SELECT `email` FROM `patient` WHERE `email` = '$email'";
            $e_check = mysqli_query($conn,$sql);

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0)
            {
                array_push($error_array, "Email already in use <br>");
            }


       }

       else{
          array_push($error_array, "Invalid Format!<br>");
       }

    }  //patient bracket
    else{

        if(preg_match("/^[a-z][a-zA-Z0-9$]+(@gmail.com)/ix",$email)){
        //if(preg_match("/^[a-z][a-zA-Z0-9$]+(@gmail.com)/ix",$college_email)){

            $sql = "SELECT `email` FROM `doctors` WHERE `email` = '$email'";
            $e_check = mysqli_query($conn,$sql);

            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0)
            {
                array_push($error_array, "Email already in use <br>");
            }


       }

       else{
          array_push($error_array, "Invalid Format!<br>");
       }

    }
    
    //Password validation
    if($password != $c_password)
    {
        array_push($error_array, "Password don't match <br>");
    }
    else{

        if(preg_match('/[^A-Za-z0-9@#]/',$password)) //validate password
        {
            array_push($error_array,"Your password can only contain english characters or numbers <br>");
        }
    }
    
    if(strlen($password > 30 || strlen($password) < 5)){
        array_push($error_array,"Your password must be between 5 and 30 characters <br>");
    }


    if(strlen($phone_num) > 10){

        array_push($error_array,"Phone Number should consist of only 10 digits <br>");
    }


    if(empty($error_array)){

        if($user_role === "patient"){
            $password = md5($password); //encrypts the password before sending to database.

            $verification_id =  rand(111111111,999999999);
            $query = "INSERT INTO `patient` (`first_name`, `last_name`, `email`, `gender`, `phone`, `age`, `password`, `address`, `dt`, `role`, `profile_pic`) VALUES ('$fname', '$lname', '$email', '$gender', '$phone', '$age', '$password', '$address', current_timestamp(), '$role', 'java.png');";
            $register_query = mysqli_query($conn,$query);
            if(!$register_query){
                die("Query Failed" . mysqli_error($conn));
            }
            else{
    
                $msg = "<p style='color:green;'>We have just sent a verification link to <strong>{$email}</strong><br>Please checkyour inbox and click on the link
                to get started. If you can't find this email, just request a new one here</p>";
    
                $mailHtml = "Please Confirm your account registration by clicking the button or link below: <a href='http://localhost/col_social_network/check.php?id={$verification_id}'>
                http://localhost/col_social_network/check.php?id={$verification_id}</a>";
    
                smtp_mailer($email,'Account Verification',$mailHtml);
            }
    
            //  //Reset Session
            //  $_SESSION['reg_fname'] = "";
            //  $_SESSION['reg_lname'] = "";
            //  $_SESSION['reg_email'] = "";
    
            //  header("Location: register.php");

        }
        else{
            $password = md5($password); //encrypts the password before sending to database.

            $verification_id =  rand(111111111,999999999);
            $query = "INSERT INTO `doctors` (`first_name`, `last_name`, `email`, `speciality`, `clinic_address`, `mrn`, `age`, `role`, `profile_pic`) VALUES ('$fname', '$lname', '$email', '$speciality', '$clinic_address', '$mrn', '$age', '$role', '$profile_pic');";
            $register_query = mysqli_query($conn,$query);
            if(!$register_query){
                die("Query Failed" . mysqli_error($conn));
            }
            else{
    
                $msg = "<p style='color:green;'>We have just sent a verification link to <strong>{$email}</strong><br>Please checkyour inbox and click on the link
                to get started. If you can't find this email, just request a new one here</p>";
    
                $mailHtml = "Please Confirm your account registration by clicking the button or link below: <a href='http://localhost/col_social_network/check.php?id={$verification_id}'>
                http://localhost/col_social_network/check.php?id={$verification_id}</a>";
    
                smtp_mailer($email,'Account Verification',$mailHtml);
            }
    
            //  //Reset Session
            //  $_SESSION['reg_fname'] = "";
            //  $_SESSION['reg_lname'] = "";
            //  $_SESSION['reg_email'] = "";
    
            //  header("Location: register.php");
        }

       

    }

}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function smtp_mailer($to,$subject,$msg)
{
  try{
    require 'C:/xampp/htdocs/MedFit_MCA/php_mailer/vendor/autoload.php';
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 1;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sunnyshmca04@gmail.com';                     // SMTP username
    $mail->Password   = 'Srh28@2000';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('sunnyshmca04@gmail.com');
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