<?php
session_start();
$patientid = $_SESSION['patient_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: login.php");
  die();
}
$msg="";
if(isset($_POST['str'])){
    $ch = curl_init();
    $str = $_POST['str'];
   
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $postdata = array(
        "model"=> "text-davinci-001",
      "prompt"=> $str,
      "temperature"=> 0.4,
      "max_tokens"=> 64,
      "top_p"=> 1,
      "frequency_penalty"=> 0,
      "presence_penalty"=> 0);
    $postdata = json_encode($postdata);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization:Bearer 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';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $result=json_decode($result,true);
    $msg = $result['choices'][0]['text'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap');
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
    .container{
        display: flex;
        justify-content: center;
    }
    form{
        margin-top: 5rem;
        width: 44rem;
       
    }
    h2{
        color: #fff;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        font-size: 3.3rem;
        position: relative;
        top: 4rem;
    }

    .response{
        width: 44rem;
        margin-left: 26rem;
        margin-top: 28px;

    }
    .response label{
        color: #fff;
        font-weight:bold;
        
    }
    textarea{
        height: 210px;
    }

</style>

<body>
    <?php require 'includes/nav.php' ?>
    <h2>MedBot</h2>
    <div class="container">
    
        <form class="d-flex" role="search" action="medbot.php" method="post">
            <input class="form-control me-2" type="search" placeholder="Search" name="str" aria-label="Search">
            <button class="btn btn-success" type="submit" name="submit" id="submit">Search</button>
        </form>
        
    </div>
    <div class="mb-3 response">
    <label for="exampleFormControlTextarea1" class="form-label">Response</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $msg; ?></textarea>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>