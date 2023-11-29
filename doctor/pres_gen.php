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
$msg="";
if(isset($_POST['submit']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO `added_patients` (`doctor_id`,`fname`,`lname`,`email`, `mobile`, `location`, `age`, `gender`) VALUES ('$doctorid','$fname', '$lname', '$email', '$mobile', '$location', '$age', '$gender');";
    mysqli_query($con,$query);

    $msg = "<p style='color:green;'>Patient Added Successfully!!</p>";
   
    

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
        <?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/sidebar.php'); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
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
            
            <!-- form starts from here -->
            <div class="container form-box">
                <form class="app" method="post" action="prescription.php">
                    <!-- Form start -->
                    <div class="row">
                        <!-- Text input-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name of Patient:</label>
                                <input class="form-control input-md" type="text" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input class="form-control input-md" type="text" id="age" name="age" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Gender:</label>
                                <input class="form-control input-md" type="text" id="gender" name="gender" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="mail">Email:</label>
                                <input class="form-control input-md" type="text" id="mail" name="mail" required>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comp">Chief Complaints:</label>
                                <textarea class="form-control input-md" id="comp" name="comp" rows="2" cols="40"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exam">Examination: </label>
                                <textarea class="form-control input-md" id="exam" name="exam" rows="2" cols="40"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis:</label>
                                <input class="form-control input-md" type="text" id="diagnosis" name="diagnosis" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medication">Medication:</label>
                                <textarea class="form-control input-md" id="medication" name="medication" rows="2" cols="40" placeholder="Medicine Name - Strength - Dose"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medication">Investigation:</label>
                                <textarea class="form-control input-md" id="investigation" name="investigation" rows="2" cols="40"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="advice">Advice:</label>
                                <textarea class="form-control input-md" id="advice" name="advice" rows="2" cols="40" ></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bloodPressure" class="control-label">Blood Pressure:</label>
                                <input type="number" id="systolicBP" name="systolicBP" placeholder="Systolic (mmHg)" class="form-control input-md" required><br>
                                <input type="number" id="diastolicBP" name="diastolicBP" placeholder="Diastolic (mmHg)" class="form-control input-md" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heartRate" class="control-label">Heart Rate:</label>
                                <input type="number" id="heartRate" name="heartRate" placeholder="Heart Rate (bpm)" class="form-control input-md" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heartRate" class="control-label">Temperature:</label>
                                <input type="number" id="temperature" name="temperature" placeholder="Temperature (Celsius)" class="form-control input-md" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="respiratoryRate" class="control-label">Respiratory Rate:</label>
                                <input type="number" id="respiratoryRate" name="respiratoryRate" placeholder="Respiratory Rate (breaths per minute)" class="form-control input-md" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weight" class="control-label">Weight (kg):</label>
                                <input class="form-control input-md" type="number" id="weight" name="weight" step="0.1" placeholder="Weight (kg)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="height">Height (cm):</label>
                                <input class="form-control input-md" type="number" id="height" name="height" step="0.1" placeholder="Height (cm)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bmi">Body Mass Index (BMI):</label>
                                <input class="form-control input-md" type="number" id="bmi" name="bmi" step="0.01" placeholder="BMI" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bloodSugar">Fasting Blood Sugar (mg/dL):</label>
                                <input class="form-control input-md" type="number" id="bloodSugar" name="bloodSugar" placeholder="Blood Sugar (mg/dL)" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="oxygenSaturation">Oxygen Saturation (%):</label>
                                <input class="form-control input-md" type="number" id="oxygenSaturation" name="oxygenSaturation" placeholder="OS in %" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="allergies">Allergies:</label>
                                <input class="form-control input-md" type="text" id="allergies" name="allergies">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="medications">Current Medications:</label>
                                <textarea class="form-control input-md" id="medications" name="medications" rows="4" cols="50"></textarea>
                                <br>
                                <label for="medicalHistory">Medical History:</label>
                                <textarea class="form-control input-md" id="medicalHistory" name="medicalHistory" rows="4" cols="50"></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="symptoms">Presenting Symptoms:</label>
                                <textarea class="form-control input-md" id="symptoms" name="symptoms" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input class="form-control input-md" type="date" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control input-md" type="time" id="time" name="time" required>
                            </div>
                        </div>


                        <!-- Button -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="submit" name="submit" class="btn btn-primary">Generate Prescription</button>
                            </div>
                            <!-- <div class="form-group">
                                <button id="submit1" name="submit1" class="btn btn-primary">Mail</button>
                            </div> -->
                        </div>
                    </div>
                    <?php  echo $msg; ?>
                </form>
            </div><!-- form ends here -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

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