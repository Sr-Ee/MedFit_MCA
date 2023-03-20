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
if(isset($_GET['add_app_id'])){

    $the_app_id = $_GET['add_app_id'];
}

$query = "SELECT * FROM `added_appointments` WHERE `add_app_id` = '$the_app_id'";
$select_app_by_id = mysqli_query($con,$query);

while($row = mysqli_fetch_array($select_app_by_id)){
    $add_app_id = $row['add_app_id'];
    $app_fname = $row['fname'];
    $app_lname = $row['lname'];
    $app_email = $row['email'];
    $app_mobile = $row['mobile'];
    $app_location = $row['location'];
    $app_age = $row['age'];
    $app_gender = $row['gender'];
    $app_predate = $row['preferred_date'];
    $app_pretime = $row['preferred_time'];
    $app_comp = $row['complaints'];
    $app_when = $row['when_status'];
    $app_app_status = $row['app_status'];
}

if(isset($_POST['update_app'])){
    $u_fname = $_POST['fname'];
    $u_lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $predate = $_POST['pre_date'];
    $pretime = $_POST['pretime'];
    $comp = $_POST['comp'];
    $app_status = $_POST['app_status'];

    $update_query = "UPDATE `added_appointments` SET `fname`='$u_fname',`lname`='$u_lname',`email`='$email',`mobile`='$mobile',`location`='$location',`age`='$age',`gender`='$gender',`preferred_date`='$predate',`preferred_time`='$pretime',`complaints`='$comp',`app_status`='$app_status' WHERE `add_app_id`='$the_app_id'";
    $update_post1 = mysqli_query($con,$update_query);
    $msg = "<p style='color:green;'>Appointment Edited Successfully!!</p>";

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
        <h2>Edit Appointments</h2>
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'></div>
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
                                    <div class='huge'>
                                    </div>
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
                                    <div class='huge'>
                                    </div>
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

                                    <div class='huge'></div>
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
                <form class="app" action="edit_appointments.php?add_app_id=<?php echo $add_app_id;  ?>" method="post" enctype="multipart/form-data">
                    <!-- Form start -->
                    <div class="row">
                        <!-- Text input-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="fname">First Name</label>
                                <input id="fname" name="fname" type="text" placeholder="Enter First Name"
                                value="<?php echo $app_fname; ?>" class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="lname">Last Name</label>
                                <input id="lname" name="lname" type="text" placeholder="Enter Last Name"
                                value="<?php echo $app_lname; ?>"   class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input id="email" name="email" type="text" placeholder="E-Mail"
                                value="<?php echo $app_email; ?>" class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="mobile">Mobile Number</label>
                                <input id="mobile" maxlength="10" name="mobile" type="number"
                                value="<?php echo $app_mobile; ?>" placeholder="Mobile Number" class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="location">Location</label>
                                <input id="location" name="location" type="text" placeholder="Location"
                                value="<?php echo $app_location; ?>"class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="age">Age</label>
                                <input id="age" name="age" type="number" placeholder="Age in years"
                                value="<?php echo $app_age; ?>" class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="gender">Gender</label>
                                <div class="maxl">
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="male" checked>
                                        <span> Male </span>
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="female">
                                        <span>Female </span>
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="female">
                                        <span>Other </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="col-md-6" id="date-block">
                            <div class="form-group">
                                <label class="control-label" for="pre_date">Preferred Date</label>
                                <input value="<?php echo $app_predate; ?>" id="pre_date" name="pre_date" type="date" placeholder="Preferred Date - DD/MM/YYYY"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="col-md-6" id="time-block">
                        <div class="form-group">
                                <label class="control-label" for="pretime">Preferred Date</label>
                                <input value="<?php echo $app_pretime; ?>" type="time" id="pretime" name="pretime" step="1">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="comp">Chief Complaints</label>
                                <input value="<?php echo $app_comp; ?>" id="comp" name="comp" type="text"
                                    placeholder="Enter complaints separated by space or commas"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6" id="app_status">
                            <div class="form-group">
                                <label class="control-label" for="app_status">Preferred Time</label>
                                <select value="<?php echo $app_app_status; ?>" id="app_status" name="app_status" class="form-control">
                                    <option value="Scheduled Appointment">Scheduled Appointment</option>
                                    <option value="Active Appointment">Active Appointment</option>
                                    <option value="Cancelled Appointment">Cancelled Appointment</option>
                                    <option value="Completed Appointment">Completed Appointment</option>
                                </select>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="update_app" name="update_app" class="btn btn-primary">Edit
                                    Appointment</button>
                            </div>
                        </div>
                    </div>
                    <?php echo $msg;  ?>
                </form>
            </div><!-- form ends here -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php  include('C:/xampp/htdocs/MedFit_MCA/doctor/includes/doc_footer.php'); ?>