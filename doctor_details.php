<?php
session_start();
$patientid = $_SESSION['patient_id'];
$con = mysqli_connect("localhost","root","","medfit");
$query1 = "SELECT * FROM `patient` WHERE `patient_id` = '$patientid'";
$pat_result = mysqli_query($con,$query1);
  
  if(mysqli_num_rows($pat_result)>=1){

      while($row = mysqli_fetch_assoc($pat_result)){
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $pat_email = $row['email'];
          $pat_gender = $row['gender'];
          $pat_phone = $row['phone'];
          $pat_address = $row['address'];
          $pat_age = $row['age'];
          
      }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<?php  
if(isset($_GET['doctor_id'])){

    $con = mysqli_connect("localhost","root","","medfit");
    $doctorid = $_GET['doctor_id'];
    $query = "SELECT * FROM `doctors` WHERE `doctor_id` = '$doctorid'";
    $result = mysqli_query($con,$query);
    
    if(mysqli_num_rows($result)>=1){

        while($row = mysqli_fetch_assoc($result)){
            $d_fname = $row['first_name'];
            $d_lname = $row['last_name'];
            $speciality = $row['speciality'];
            $clinic_name = $row['clinic_name'];
            $clinic_add = $row['clinic_address'];
            $city = $row['city'];
            $email = $row['email'];
            $mrn = $row['mrn'];
            $qualify = $row['qualification'];

        }

    }
}

$msg="";
if (isset($_POST['submit'])) {

// Function to check if a time slot is available
function isSlotAvailable($con, $doctorId, $slotTime)
{
    $sql = "SELECT COUNT(*) FROM `added_appointments_new` WHERE `doctor_id` = '$doctorId' AND `slot_time_part` = '$slotTime'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $count = mysqli_fetch_row($result)[0];
        if ($count == 0) {
            return true;
        }
    }

    return false;
}

function hasPatientBookedSlot($con, $doctorId, $patientId, $slotDate, $slotTime)
{
    $sql = "SELECT COUNT(*) FROM `added_appointments_new` WHERE `doctor_id` = '$doctorId' AND `patient_id` = '$patientId' AND `slot_date` = '$slotDate'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $count = mysqli_fetch_row($result)[0];
        if ($count > 0) {
            return true;
        }
    }

    return false;
}



// Function to book an appointment
function bookAppointment($con, $doctorId, $patientId, $forWhom, $slotDate, $slotTime, $firstName, $lastName, $email, $mobile, $location, $age, $chiefComplaints, $gender, $consultType)
{
    if (isSlotAvailable($con, $doctorId, $slotTime)) 
    {
        if (hasPatientBookedSlot($con, $doctorId, $patientId, $slotDate, $slotTime)) {
            echo "<p style='color:red;margin-top: 4rem;'>Sorry, you have already booked an appointment for the day</p>";
        } 
        else{
            $sql = "INSERT INTO `added_appointments_new` (doctor_id, patient_id, for_whom, slot_date, slot_time_part, first_name, last_name, email, mobile, location, age, chief_complaints, gender, consult_type)
                    VALUES ('$doctorId', '$patientId', '$forWhom','$slotDate','$slotTime', '$firstName', '$lastName', '$email', '$mobile', '$location', '$age', '$chiefComplaints', '$gender', '$consultType')";

            if (mysqli_query($con, $sql)) {
                echo "<p style='color:green;margin-top: 4rem;'>Appointment Booked Successfully!!</p>";
            } else {
                echo "<p style='color:red;margin-top: 4rem;'>An error occurred while booking the appointment.</p>";
            }
        }
        
    } 
    
    else {
        echo "<p style='color:red;margin-top: 4rem;'>Sorry, the selected slot is not available. Please choose a different time.</p>";
    }
}


    $patientid = $_SESSION['patient_id'];
    $doctorId = $_GET['doctor_id'];
    
    $slotDate = $_POST['slot_date'];
    $slotTime = $_POST['pretime'];
    $forWhom = $_POST['forwhom'];
    $firstName = $_POST['pfname'];
    $lastName = $_POST['plname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $chiefComplaints = $_POST['comp'];
    $gender = $_POST['gender'];
    $consultType = $_POST['consult_type'];

    
    bookAppointment($con, $doctorId, $patientid, $forWhom, $slotDate, $slotTime, $firstName, $lastName, $email, $mobile, $location, $age, $chiefComplaints, $gender, $consultType);
}

mysqli_close($con);
?>

<style>
    .app {
        border: 2px solid black;
        border-radius: 9px;
        padding: 22px;
        position: relative;
        bottom: 3rem;
    }

    .card {
        border: 2px solid grey;
        border-radius: 20px;
        height: 19rem;
        box-shadow: 1px 1px 28px 0px rgba(0, 0, 0, 0.75);
        transition: transform .2s;
    }

    .card:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .card-body h6 {
        text-transform: capitalize;
    }

    form {
        box-shadow: 1px 1px 28px 0px rgba(0, 0, 0, 0.75);

    }

    .profile-card {
        margin-top: 20px;
    }

    .btn {
        display: block;
        margin: 0 auto;
    }
</style>

<body>
    <?php require 'includes/nav.php' ?>
    <section class="">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0 profile-card">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="./img/doctor.webp" alt="Avatar" class="img-fluid my-5"
                                    style="height:12rem;" />
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Dr.
                                        <?php echo $d_fname.' '.$d_lname.' - '.$speciality.' - '.$clinic_name;?>
                                    </h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">
                                                <?php echo $email;  ?>
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>MRN</h6>
                                            <p class="text-muted">
                                                <?php echo $mrn; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <h6>Details</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Address</h6>
                                            <p class="text-muted">
                                                <?php echo $clinic_add;  ?>
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Qualification</h6>
                                            <p class="text-muted">
                                                <?php echo $qualify;  ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container form-box">
        <form class="app" action='doctor_details.php?doctor_id=<?php echo $doctorid; ?>' method="post">
            <!-- Form start -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="forwhom">Book Appointment for?</label>
                        <div class="maxl">
                            <label class="radio inline">
                                <input type="radio" name="forwhom" id="forwhom" value="yourself">
                                <span> Yourself </span>
                            </label>
                            <label class="radio inline">
                                <input onclick="handleRadioClick()" type="radio" name="forwhom" id="forwhom"
                                    value="family member">
                                <span>Family Member </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="pfname">First Name</label>
                        <input id="pfname" name="pfname" type="text" placeholder="First Name"
                            class="form-control input-md" value="<?php echo $first_name;  ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="plname">Last Name</label>
                        <input id="plname" name="plname" type="text" placeholder="Last Name"
                            class="form-control input-md" value="<?php echo $last_name;  ?>">
                    </div>
                </div>
                <!-- Text input-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md"
                            value="<?php echo $pat_email;  ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="mobile">Mobile Number</label>
                        <input id="mobile" name="mobile" type="number" placeholder="Mobile Number"
                            class="form-control input-md" value="<?php echo $pat_phone;  ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="location">Location</label>
                        <input id="location" name="location" type="text" placeholder="Location"
                            class="form-control input-md" value="<?php echo $pat_address;  ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="age">Age</label>
                        <input id="age" name="age" type="number" placeholder="Age in years"
                            class="form-control input-md" value="<?php echo $pat_age;  ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="comp">Chief Complaints</label>
                        <input id="comp" name="comp" type="text"
                            placeholder="Enter complaints separated by space or commas" class="form-control input-md"
                            required>
                    </div>
                </div>
                <!-- Text input-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="slot_date">Preferred Date</label>
                        <input id="date" min="<?php echo date(" Y-m-d"); ?>" name="slot_date" type="date"
                        placeholder="Preferred
                        Date - DD/MM/YYYY" class="form-control input-md" required>
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="slot">Slot Time:</label>
                        <select name="pretime" id="pretime" class="form-control">
                            <?php 
                                    $query = "SELECT * FROM `slot_settings` WHERE `doctor_id` = {$_GET['doctor_id']}";
                                    $select_slot = mysqli_query($con,$query);
                                    while($row = mysqli_fetch_assoc($select_slot)) {
                                        $slot_id = $row['slot_id'];
                                        $slot_time = $row['slot_time'];
                                            
                                            echo "<option value='$slot_time'>{$slot_time}</option>";
                                         
                                        }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="<?php echo $pat_gender;  ?>">Male</option>
                            <option value="<?php echo $pat_gender;  ?>">Female</option>
                            <option value="<?php echo $pat_gender;  ?>">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="consult_type">Consultation Type</label>
                        <select id="consult_type" name="consult_type" class="form-control">
                            <option value="econsult">E-Consult</option>
                            <option value="inclinic">Inclinic</option>
                        </select>
                    </div>
                </div>
                <!-- Button -->
                <div class="col-md-12">
                    <div class="form-group">
                        <button id="submit" name="submit" class="btn btn-primary">Confirm Appointment</button>
                    </div>
                </div>
            </div>
            <?php echo $msg; ?>
        </form>
    </div>
    <script>


        // JavaScript code
        function handleRadioClick() {
            const nowRadio = document.querySelector('input[value="family member"]');
            if (nowRadio.checked) {
                const field1 = document.querySelector('#name');
                const field2 = document.querySelector('#mobile');
                const field3 = document.querySelector('#location');
                const field4 = document.querySelector('#age');
                field1.value = '';
                field2.value = '';
                field3.value = '';
                field4.value = '';
            } else {
                const field1 = document.querySelector('#date-block');
                const field2 = document.querySelector('#time-block');
                field1.style.display = 'inline-block';
                field2.style.display = 'inline-block';
            }
        }
        flatpickr("#myTimePicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minTime: "now",
        });




    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>