<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register_style.css"> <!-- register style sheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "medfit";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
  die("Sorry we failed to connect :".mysqli_connect_error());
}
else{
  echo "Connection successful";
}
?>
    <form name="myform" action="forum.php" method="post">
<br><br><h2>Create your blog</h2> <br><br>     
<select class="form-select" aria-label="Default select example" name="category" >
  <option selected>Select your Category</option>
  <option value="Health">Health</option>
  <option value="Fitness">Fitness</option>
  <option value="Sports">Sports</option>
  <option value="Decease">Decease</option>
</select><br>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Topic</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="title" name="title">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Write your content below</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="info" id="info"></textarea>
</div>
<div class="col-12">
    <button type="submit" class="btn btn-primary" id="liveAlertBtn">Post</button>
  </div>
</form>

  <?php
    $info="";
    
      $category = $_POST["category"];
      $info = $_POST["info"];
      $topic = $_POST["title"];

      

      if($category!="Select your Category" && $info !="" && $topic != "")
      {
        
      if(strlen($info) > 20)
      {
      $query = "INSERT INTO `forum` (`category`,`topic`, `info`) VALUES ('$category','$topic', '$info');";
      mysqli_query($conn,$query);
      echo '<script type ="text/JavaScript">';  
      echo 'alert("Your Blog has been posted successfully")';  
      echo '</script>'; 
      }
      else{
        echo '<script type ="text/JavaScript">';  
        echo 'alert("You must write more that 20 letters")';  
        echo '</script>'; 
      }
      
    }
    else{
        echo '<script type ="text/JavaScript">';  
      echo 'alert("Please Select a category and write your post before posting")';  
      echo '</script>'; 
    }
  ?>
   <!-- <script>
    const alertTrigger = document.getElementById('liveAlertBtn')
    const title = document.getElementById('title')
    const info = document.getElementById('info')
    
    
if(title.value !="Select your Category")
{

if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    alert('You have successfully posted your Blog' + title.value)
  })
}
}
 </script> -->
</body>
</html>