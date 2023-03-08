<?php
session_start();
$patientid = $_SESSION['patient_id'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    .app{
        border: 2px solid black;
        border-radius: 9px;
        padding: 22px;
        margin-top: -31px;
    }

    .card {
        border: 2px solid grey;
        border-radius: 20px;
        height: 18rem;
        transition: transform .2s;
    }
    .card:hover{
        transform: scale(1.1); 
        cursor: pointer;
    }
    .profile-card{
        margin-top: -24px;
    }
    .btn{
        display: block;
        margin: 0 auto;
    }
</style>
<?php require 'includes/nav.php' ?>
<?php  

if(isset($_GET['hospital_id'])){
    
    $con = mysqli_connect("localhost","root","","medfit");
    $hospitalid = $_GET['hospital_id'];
    $query = "SELECT * FROM `hospital` WHERE `hospital_id` = '$hospitalid'";
    $result = mysqli_query($con,$query);
    
    if(mysqli_num_rows($result)>=1){

        while($row = mysqli_fetch_assoc($result)){
            $hospitalname = $row['hospital_name'];
            $address = $row['address'];
            $speciality = $row['speciality'];
            $opentime = $row['open_time'];
            $endtime = $row['end_time'];
            $nonurses = $row['no_nurses'];
            $nodoctors = $row['no_doctors'];
            $beds = $row['beds'];

        }

    }
}

?>
<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0 profile-card">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                            <h5>Sanjay Singhania</h5>
                            <p>Fitness Freak</p>
                            <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6><?php echo $hospitalname?>  </h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Address</h6>
                                        <p class="text-muted"><?php echo $address;  ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Speciality</h6>
                                        <p class="text-muted"><?php echo $speciality;  ?></p>
                                    </div>
                                </div>
                                <h6>Details</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Beds</h6>
                                        <p class="text-muted"><?php echo $beds;  ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>No of Doctors</h6>
                                        <p class="text-muted"><?php echo $nodoctors;  ?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>No of nurses</h6>
                                        <p class="text-muted"><?php echo $nonurses;  ?></p>
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




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>