<?php
session_start();
$con = mysqli_connect("localhost","root","","medfit");
$doctorid = $_SESSION['doctor_id'];
$name_query = "SELECT * FROM `doctors` WHERE `doctor_id`='$doctorid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['first_name'];
  $lname = $row['last_name'];
}


?>
<?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/doc_header.php'); ?>

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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $fname.' '.$lname; ?> <b
                        class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="C:/xampp/htdocs/MedFit_MCA/doctor_profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
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
        <?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/sidebar.php'); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
    <h2>Cancelled Appointments</h2>
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row" style="margin-top: 61px;">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                   
                                            $query = "SELECT * FROM `added_appointments` WHERE `doctor_id` = '$doctorid'";
                                            $select_all_app = mysqli_query($con,$query);
                                            while($row = mysqli_fetch_assoc($select_all_app)){
                                                $add_app_id = $row['add_app_id'];
                                            }
                                            $app_counts = mysqli_num_rows($select_all_app);

                                    ?>
                                        <div class='huge'><?php echo $app_counts; ?></div>
                                        <div>All Appointments</div>
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

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                   
                                        $query = "SELECT * FROM `added_appointments` WHERE `doctor_id` = '$doctorid' AND `app_status`='Scheduled Appointment'";
                                        $select_sche_app = mysqli_query($con,$query);
                                        while($row = mysqli_fetch_assoc($select_sche_app)){
                                            $add_app_id = $row['add_app_id'];
                                        }
                                        $sche_counts = mysqli_num_rows($select_sche_app);

                                    ?>
                                        <div class='huge'><?php echo $sche_counts; ?></div>
                                        <div>Scheduled Appointments</div>
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
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php
                                   
                                            $query = "SELECT * FROM `added_appointments` WHERE `doctor_id` = '$doctorid' AND `app_status`='Active Appointment'";
                                            $select_active_app = mysqli_query($con,$query);
                                            while($row = mysqli_fetch_assoc($select_active_app)){
                                                $add_app_id = $row['add_app_id'];
                                            }
                                            $active_counts = mysqli_num_rows($select_active_app);

                                        ?>
                                            <div class='huge'><?php echo $active_counts; ?></div>
                                            <div>Active Appointments</div>
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
                        </div> <!-- col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <?php
                                   
                                            $query = "SELECT * FROM `added_appointments` WHERE `doctor_id` = '$doctorid' AND `app_status`='Completed Appointment'";
                                            $select_cancel_app = mysqli_query($con,$query);
                                            while($row = mysqli_fetch_assoc($select_cancel_app)){
                                                $add_app_id = $row['add_app_id'];
                                            }
                                            $cancelled_counts = mysqli_num_rows($select_cancel_app);

                                        ?>
                                            <div class='huge'><?php echo $cancelled_counts; ?></div>
                                            <div>Completed Appointments</div>
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
                    </div>
            <!-- /.row -->
            <form action="" method="post">
            <table class="table table-bordered table-hover">
                <!-- Table Heading -->
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Location</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Prefered Date</th>
                        <th>Prefered Time</th>
                        <th>Complaints</th>
                        <!-- <th>Status</th> -->
                        <th>Consultation Type</th>
                        <!-- <th>EDIT</th> -->
                        <th>DELETE</th>
                    </tr>
                </thead>
                <!-- Placeholders -->
                <tbody>
                    <?php
                        $con = mysqli_connect("localhost","root","","medfit");
                        $query = "SELECT * FROM `added_appointments` WHERE `doctor_id`='$doctorid'";
                        $select_appointment = mysqli_query($con,$query);
                        $id = 0;
                        while($row = mysqli_fetch_array($select_appointment)){
                            $id++;
                            $add_app_id = $row['add_app_id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $location = $row['location'];
                            $age = $row['age'];
                            $gender = $row['gender'];
                            $predate = $row['preferred_date'];
                            $pretime = $row['preferred_time'];
                            $comp = $row['complaints'];
                            $when = $row['when_status'];
                            $consult_type = $row['consult_type'];
                            $app_status = $row['app_status'];

                            // Zoom Video Calling
                            require_once 'config.php';
                            require_once 'api.php';
                            $arr['topic'] = 'Meeting by ' . $fname;
                            $arr['start_date'] = date('$predate $pretime');
                            $arr['duration'] = 30;
                            $arr['password'] = 'sunny';
                            $arr['type'] = '2';
                            $result=createMeeting($arr);

                            echo "<tr>";
                            ?>
                            <?php
                            if($app_status == "Cancelled Appointment"){
                                echo "<td>$id</td>";
                                echo "<td>$fname $lname</td>";
                                echo "<td>$email 
                                <button name='submitbtn' id='submitbtn' class='btn btn-success'>Send</button></td>";
                                echo "<td>$mobile</td>";
                                echo "<td>$location</td>";
                                echo "<td>$age</td>";
                                echo "<td>$gender</td>";
                                echo "<td>$predate</td>";
                                echo "<td>$pretime</td>";
                                echo "<td>$comp</td>";
                                if($consult_type == "econsult"){
                                    echo "<td><a href='".$result->join_url."' target='_blank'>".$result->join_url."</a></td>";
                                }
                                else{
                                    echo "<td><a href='#'>Inclinic</a></td>";
                                }
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='view_appointments.php?delete={$add_app_id}'>DELETE</a></td>";
                            echo "</tr>";
                        }

                        }

                    ?>

                    <?php

                        if(isset($_GET['delete'])) {
                                        
                            $the_app_id = $_GET['delete'];
                        
                            $query = "DELETE FROM `added_appointments` WHERE `add_app_id` =' $the_app_id'";
                            $delete_query = mysqli_query($con,$query);
                        
                            //confirm($delete_query);
                            //header("Location: view_appointments.php");
                        }  

                    ?>
                </tbody>
            </table>
            </form>
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
    $mailHtml = "Your Zoom Link: <a href='".$result->join_url."' target='_blank'>".$result->join_url."</a>";
    smtp_mailer($email,'Zoom Link Sent',$mailHtml);
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
<?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/doc_footer.php'); ?>