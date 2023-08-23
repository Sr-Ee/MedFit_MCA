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
    $slot_time = $_POST['slot'];
    $query = "INSERT INTO `slot_settings`(`doctor_id`, `slot_time`) VALUES ('$doctorid','$slot_time');";
    mysqli_query($con,$query);
    $msg = "<p style='color:green;'>Slot Time Added Successfully!!</p>";
}
?>
<?php
if(isset($_GET['delete'])){
    $the_slot_id = $_GET['delete'];
    $query = "DELETE FROM `slot_settings`  WHERE `slot_id` = {$the_slot_id} ";
    $delete_query = mysqli_query($con,$query);
    header("location: appointment_settings.php");
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
        <h2>Add Appointments</h2>
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
                <form class="app" action="appointment_settings.php" method="post">
                    <!-- Form start -->
                    
                    <div class="row">
                        <!-- Text input-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="slot">Slot Time</label>
                                    <input id="slot" name="slot" type="text" placeholder="Enter Slot Time eg: 10:00 in 24 Hour format"
                                    class="form-control input-md" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Slot Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                <tbody>

                                <?php
                                    $query = "SELECT * FROM `slot_settings` WHERE `doctor_id` = '$doctorid'";
                                    $select_slot = mysqli_query($con,$query);  
                                                                            
                                    while($row = mysqli_fetch_assoc($select_slot)) {
                                    $slot_id = $row['slot_id'];
                                    $slot_time = $row['slot_time'];
                                    
                                    echo "<tr>";
                                        
                                    echo "<td>{$slot_id}</td>";
                                    echo "<td>{$slot_time}</td>";
                                    echo "<td><a href='appointment_settings.php?delete={$slot_id}'>Delete</a></td>";
                                    echo "</tr>";
                                    
                                    }

                                ?>
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>10:00</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>             -->
                               </tbody>
                            </div>
                        <!-- Button -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <button id="submit" name="submit" class="btn btn-primary">Add Slot Time</button>
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