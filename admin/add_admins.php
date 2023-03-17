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
$msg="";
if(isset($_POST['submit']))
{
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    
    $location = $_POST['location'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
  
  
        $query = "INSERT INTO `admins` (`admin_fname`, `admin_lname`, `admin_email`,`admin_password` ,`admin_address`,`admin_gender`,`created_by`) VALUES ('$firstname', '$lastname', '$email','$password','$location', '$gender','$adminid');";
        mysqli_query($con,$query);

        $msg = "<p style='color:green;'>Admin Added Successfully!!</p>";
    
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $fname.' '.$lname; ?> 
                <b class="caret"></b></a>
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
    <h2>Add Admins</h2>
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

            <!-- form starts from here -->
            <div class="container form-box">
                <form class="app" action="add_admins.php" method="post">
                    <!-- Form start -->
                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Admin Name</label>
                                <input id="name" name="name" type="text" placeholder="Name"
                                    class="form-control input-md">
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="when">Time</label>
                                <div class="maxl">
                                    <label class="radio inline">
                                        <input onclick="handleRadioClick()" type="radio" name="when" id="when"
                                            value="now">
                                        <span> Now </span>
                                    </label>
                                    <label class="radio inline">
                                        <input onclick="handleRadioClick()" type="radio" name="when" id="when"
                                            value="later">
                                        <span> Later </span>
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <!-- Text input-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="fname">First Name</label>
                                <input id="fname" name="fname" type="text" placeholder="Enter First Name"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="lname">Last Name</label>
                                <input id="lname" name="lname" type="text" placeholder="Enter Last Name"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input id="email" name="email" type="text" placeholder="E-Mail"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input id="password" maxlength="10" name="password" type="password"
                                    placeholder="password" class="form-control input-md">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="location">Location</label>
                                <input id="location" name="location" type="text" placeholder="Location"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="age">Age</label>
                                <input id="age" name="age" type="number" placeholder="Age in years"
                                    class="form-control input-md">
                            </div>
                        </div> -->
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
                        <!-- <div class="col-md-6" id="date-block">
                            <div class="form-group">
                                <label class="control-label" for="pre_date">Preferred Date</label>
                                <input id="pre_date" name="pre_date" type="date" placeholder="Preferred Date - DD/MM/YYYY"
                                    class="form-control input-md">
                            </div>
                        </div> -->
                        <!-- Select Basic -->
                        <!-- <div class="col-md-6" id="time-block">
                            <div class="form-group">
                                <label class="control-label" for="pretime">Preferred Time</label>
                                <input type="time" id="pretime" name="pretime" step="1">
                            </div>
                        </div> -->
                        <!-- Select Basic -->
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="comp">Chief Complaints</label>
                                <input id="comp" name="comp" type="text"
                                    placeholder="Enter complaints separated by space or commas"
                                    class="form-control input-md">
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6" id="app_status">
                            <div class="form-group">
                                <label class="control-label" for="app_status">Schedule</label>
                                <select id="app_status" name="app_status" class="form-control">
                                    <option value="Scheduled Appointment">Scheduled Appointment</option>
                                    <option value="Active Appointment">Active Appointment</option>
                                    <option value="Cancelled Appointment">Cancelled Appointment</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- Button -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="submit" name="submit" class="btn btn-primary">Add Admin</button>
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
<!-- /#wrapper
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

</script> -->
<?php  include('C:/xampp/htdocs/MedFit_MCA/admin/includes/doc_footer.php'); ?>