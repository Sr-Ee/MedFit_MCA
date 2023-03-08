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
                                <h6>Dr. Sunny Sharma - Dentist, Dental Surgeon </h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">info@example.com</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Phone</h6>
                                        <p class="text-muted">123 456 789</p>
                                    </div>
                                </div>
                                <h6>Details</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Address</h6>
                                        <p class="text-muted">Thane, Maharashtra</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Qualification</h6>
                                        <p class="text-muted">BDS</p>
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
    <form class="app">
        <!-- Form start -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md">
                </div>
            </div>
            <!-- Text input-->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md">
                </div>
            </div>
            <!-- Text input-->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="date">Preferred Date</label>
                    <input id="date" name="date" type="text" placeholder="Preferred Date" class="form-control input-md">
                </div>
            </div>
            <!-- Select Basic -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="time">Preferred Time</label>
                    <select id="time" name="time" class="form-control">
                        <option value="8:00 to 9:00">8:00 to 9:00</option>
                        <option value="9:00 to 10:00">9:00 to 10:00</option>
                        <option value="10:00 to 1:00">10:00 to 1:00</option>
                    </select>
                </div>
            </div>
            <!-- Select Basic -->
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="appointmentfor">Appointment For</label>
                    <select id="appointmentfor" name="appointmentfor" class="form-control">
                        <option value="Service#1">Service#1</option>
                        <option value="Service#2">Service#2</option>
                        <option value="Service#3">Service#3</option>
                        <option value="Service#4">Service#4</option>
                    </select>
                </div>
            </div>
            <!-- Button -->
            <div class="col-md-12">
                <div class="form-group">
                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Make An Appointment</button>
                </div>
            </div>
        </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>