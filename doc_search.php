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
    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .container {
        max-width: 61rem;
        margin-top: 4rem;
        position: relative;

    }

    h3 {
        text-align: center;
    }

    #docsearch {
        border: 2px solid black;
    }

    .filters {

        display: flex;
        flex-direction: column;
        position: absolute;
        left: 46rem;
        top: 0rem;
        justify-content: space-between;
        align-items: center;
        height: 12rem;
        width: 10rem;
        border: 2px solid;

    }

    .header {
        background-color: #3e57db;
        color: #fff;
        padding: 30px 20px;
        border-radius: 25px;
    }

    .header input {
        background-color: rgba(0, 0, 0, 0.3);
        border: 0;
        border-radius: 50px;
        color: #fff;
        font-size: 14px;
        padding: 10px 15px;
        width: 100%;
    }

    .header input:focus {
        outline: none;
    }

    .session-details {
        font-size: 20px;
        color: white;
        position: relative;
        right: 36px;
    }
</style>

<body>
    <?php 
if(isset($_POST['submit']))
{
    $con = mysqli_connect("localhost","root","","medfit");
    $user_query = mysqli_query($con,"SELECT * FROM `doctors`");
    
    if(!$user_query){
        die("QUERY FAILED" . mysqli_error($con));
    }
    
    while($row = mysqli_fetch_array($user_query)){
    
        $search_user_id = $row['doctor_id'];
    }
    
}
?>
    <?php require 'includes/nav.php' ?>
    <div class="container">
        <form action="doctor_details.php?doctor_id=<?php echo $search_user_id ?>">
            <header class="header">
                <h4 class="title">Live Doctor's Filter</h4>
                <small class="subtitle">Search Doctor's by Name, Symptoms, Location, Clinics</small>
                <input type="text" id="search" name="search" placeholder="Search..." autocomplete="off">
            </header>
        </form>
        <div class="col-md-5">
            <div class="list-group" id="show-list"></div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $("#search").keyup(function () {

                var searchText = $(this).val();

                if (searchText != '') {

                    $.ajax({    
                        url: 'doc_searchaction.php',
                        method: 'POST',
                        data: { query: searchText },
                        success: function (response) {
                            $("#show-list").html(response);
                        }
                    })
                }
                else {
                    $("#show-list").html('');
                }
            });

            $(document).on('click', 'a', function () {

                $("#search").val($(this).text());
                $("#show-list").html('');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>