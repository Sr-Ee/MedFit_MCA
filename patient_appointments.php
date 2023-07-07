<?php
session_start();
$patientid = $_SESSION['patient_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
}
$con = mysqli_connect("localhost","root","","medfit");

$query1 = "SELECT * FROM `added_appointments_new` WHERE `patient_id` = '$patientid'";
$pat_result = mysqli_query($con,$query1);
  
  if(mysqli_num_rows($pat_result)>=1){

      while($row = mysqli_fetch_assoc($pat_result)){
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $pat_email = $row['email'];
          $pat_gender = $row['gender'];
          $pat_age = $row['age'];
          $slot_date = $row['slot_date'];
          $slot_time = $row['slot_time_part'];
          $pat_comp = $row['chief_complaints'];
          
      }
}
?>
<?php  include('C:/xampp/htdocs/MedFit_MCA/includes/pat_header.php'); ?>
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
            <a class="navbar-brand" href="welcome.php">MedFit</a>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    <?php echo $first_name.' '.$last_name; ?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="C:/xampp/htdocs/MedFit_MCA/doctor_profile.php"><i class="fa fa-fw fa-user"></i>
                            Profile</a>
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
        <?php  include('C:/xampp/htdocs/MedFit_MCA/includes/sidebar.php'); ?>
                <!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper">
      <div class="container-fluid">
        <h4>Your Appointments</h4>
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
                            <th>Slot Date</th>
                            <th>Slot Time</th>
                            <th>Complaints</th>
                            <th>Status</th>
                            <th>Consultation Type</th>
                            <th>EDIT DETAILS</th>
                            <th>CANCEL</th>
                        </tr>
                    </thead>
                    <!-- Placeholders -->
                    <tbody>
                        <?php
                        $con = mysqli_connect("localhost","root","","medfit");
                        $query = "SELECT * FROM `added_appointments_new` WHERE `patient_id`='$patientid'";
                        $select_appointment = mysqli_query($con,$query);
                        $id = 0;
                        while($row = mysqli_fetch_array($select_appointment)){
                            $id++;
                            $add_app_id = $row['id'];
                            $predate = $row['slot_date'];
                            $pretime = $row['slot_time_part'];
                            $fname = $row['first_name'];
                            $lname = $row['last_name'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $location = $row['location'];
                            $age = $row['age'];
                            $comp = $row['chief_complaints'];
                            $gender = $row['gender'];
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
                                echo "<td>$id</td>";
                                echo "<td>$fname $lname</td>";
                                echo "<td>$email </td>";
                                echo "<td>$mobile</td>";
                                echo "<td>$location</td>";
                                echo "<td>$age</td>";
                                echo "<td>$gender</td>";
                                echo "<td>$predate</td>";
                                echo "<td>$pretime</td>";
                                echo "<td>$comp</td>";
                                echo "<td>$app_status</td>";
                                

                                if($consult_type == "econsult"){
                                    echo "<td><a href='".$result->join_url."' target='_blank'>".$result->join_url."</a></td>";
                                }
                                else{
                                    echo "<td><a href='#'>Inclinic</a></td>";
                                }
                                echo "<td><a href='edit_appointments.php?add_app_id={$add_app_id}'>EDIT</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to cancel your appointment');\" href='patient_appointments.php?cancel={$add_app_id}'>CANCEL</a></td>";
                            echo "</tr>";

                        }

                    ?>

                        <?php

                        if(isset($_GET['cancel'])) {
                                        
                            $the_app_id1 = $_GET['cancel'];
                        
                            //$query = "DELETE FROM `added_appointments_new` WHERE `id` =' $the_app_id'";
                            $query = "UPDATE `added_appointments_new` SET `app_status` = 'cancelled' WHERE `id` ='$the_app_id1'";
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


?>
</div>
<!-- /#wrapper -->
<?php  include('C:/xampp/htdocs/MedFit_MCA/includes/pat_footer.php'); ?>
    
