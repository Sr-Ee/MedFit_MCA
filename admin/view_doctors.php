<?php
session_start();
$con = mysqli_connect("localhost","root","","medfit");
$adminid = $_SESSION['admin_id'];
$name_query = "SELECT * FROM `admins` WHERE `admin_id`='$adminid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['admin_fname'];
  $lname = $row['admin_lname'];
}

?>
<?php  include('C:/xampp/htdocs/MedFit_MCA/admin/includes/doc_header.php'); ?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MedFit</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b
                        class="caret"></b></a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $fname.' '.$lname; ?> <b
                        class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php  include('C:/xampp/htdocs/MedFit_MCA/admin/includes/sidebar.php'); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row" style="margin-top: 61px;">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                   
                                            $query = "SELECT * FROM `patient`";
                                            $select_all_app = mysqli_query($con,$query);
                                            // while($row = mysqli_fetch_assoc($select_all_app)){
                                            //     $add_app_id = $row['add_app_id'];
                                            // }
                                            $app_counts = mysqli_num_rows($select_all_app);

                                    ?>
                                        <div class='huge'><?php echo $app_counts; ?></div>
                                        <div>View All Patients</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- col-lg-3 -->

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                   
                                        $query = "SELECT * FROM `doctors`";
                                        $select_sche_app = mysqli_query($con,$query);
                                        // while($row = mysqli_fetch_assoc($select_sche_app)){
                                        //     $add_app_id = $row['add_app_id'];
                                        // }
                                        $sche_counts = mysqli_num_rows($select_sche_app);

                                    ?>
                                        <div class='huge'><?php echo $sche_counts; ?></div>
                                        <div>View All Doctors</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php?user_id=<?php echo $userid; ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div> <!-- col-lg-3 -->
                    </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php
                                   
                                            $query = "SELECT * FROM `admins`";
                                            $select_active_app = mysqli_query($con,$query);
                                            // while($row = mysqli_fetch_assoc($select_active_app)){
                                            //     $add_app_id = $row['add_app_id'];
                                            // }
                                            $active_counts = mysqli_num_rows($select_active_app);

                                        ?>
                                            <div class='huge'><?php echo $active_counts; ?></div>
                                            <div>View All Admins</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="profile_new.php?user_id=<?php echo $userid;  ?>">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
            <!-- /.row -->
            <table class="table table-bordered table-hover">
                <!-- Table Heading -->
                <thead>
                    <tr>
                        <th>Doctor ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Clinic Address</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Speciality</th>
                        <th>Clinic Name</th>
                        <th>MRN No</th>
                        <th>Verify Status</th>
                        <th>Approve</th>
                        <th>Unapprove</th>
                        
                    </tr>
                </thead>
                <!-- Placeholders -->
                <tbody>
                    <?php
                        $con = mysqli_connect("localhost","root","","medfit");
                        $query = "SELECT * FROM `doctors`";
                        $select_doctor = mysqli_query($con,$query);
                        $id = 0;
                        while($row = mysqli_fetch_array($select_doctor)){

                            $id++;
                            $doctor_id = $row['doctor_id'];
                            $fname = $row['first_name'];
                            $lname = $row['last_name'];
                            $email = $row['email'];
                            $mobile = $row['phone'];
                            $location = $row['clinic_address'];
                            $age = $row['age'];
                            $gender = $row['gender'];
                            $clinicname = $row['clinic_name'];
                            $mrn = $row['mrn'];
                            $speciality = $row['speciality'];
                            $verify_status = $row['verify_status'];
                            echo "<tr>";
                            ?>
                            <?php
                                 echo "<td>$id</td>";
                                 echo "<td>$fname $lname</td>";
                                 echo "<td>$email<br>
                                 <button name='submitbtn' id='submitbtn' class='btn btn-success'>Send</button></td>";
                                 echo "<td>$mobile</td>";
                                 echo "<td>$location</td>";
                                 echo "<td>$age</td>";
                                 echo "<td>$gender</td>";
                                 echo "<td>$speciality</td>";
                                 echo "<td>$clinicname</td>";
                                 echo "<td>$mrn</td>";
                                 echo "<td>$verify_status</td>";
                                 echo "<td><a href='view_doctors.php?verify=$doctor_id'>verify</a></td>";
                                 echo "<td><a href='view_doctors.php?unverify=$doctor_id'>unverify</a></td>";
                            echo "</tr>";
                        }
                    ?>

                    <?php  
                        $msg="";
                        if(isset($_GET['verify'])) {

                            $the_verify_id = $_GET['verify'];
                            $query = "UPDATE `doctors` SET `verify_status`='verified' WHERE `doctor_id`='$the_verify_id'";
                            $approve_doctor_query = mysqli_query($con,$query);
                            $msg = "Dr. $fname. .$lname verified successfully";
                            //header("Location: view_doctors.php");

                        }
                        if(isset($_GET['unverify'])) {

                            $the_verify_id = $_GET['unverify'];
                            $query = "UPDATE `doctors` SET `verify_status`='unverified' WHERE `doctor_id`='$the_verify_id'";
                            $unapprove_doctor_query = mysqli_query($con,$query);
                            //header("Location: view_doctors.php");
                            $msg = "Dr. $fname. .$lname unverified successfully";

                        }       
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php  
include('C:/xampp/htdocs/MedFit_MCA/doctor/EmailSendScript/smtp/PHPMailerAutoload.php');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Port = "465"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "medfit@coderscapital.tech";
	$mail->Password = 'Sunny29@1971';
	$mail->SetFrom("medfit@coderscapital.tech");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		//echo $mail->ErrorInfo;
	}else{
		//echo 'Sent';
	}
}

$msg="";
if(isset($_POST['submitbtn'])){
    $msg="Link Sent Sucessfully";
    $mailHtml = "Your MedFit Account has been verified Successfully, You can login now!!";
    smtp_mailer($email,'MedFit Account Verified!!',$mailHtml);
}else{
    $msg="Link Sending Failed";
}

?>
</div>
<!-- /#wrapper -->
<script>
    // JavaScript code
    function handleRadioClick() {
        const nowRadio = document.querySelector('input[value="now"]');
        if (nowRadio.checked) {
            const field1 = document.querySelector('#date-block');
            const field2 = document.querySelector('#time-block');
            field1.style.display = 'none';
            field2.style.display = 'none';
        } else {
            const field1 = document.querySelector('#date-block');
            const field2 = document.querySelector('#time-block');
            field1.style.display = 'inline-block';
            field2.style.display = 'inline-block';
        }
    }

</script>
<?php  include('C:/xampp/htdocs/MedFit_MCA/admin/includes/doc_footer.php'); ?>