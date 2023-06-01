<?php
session_start();
$con = mysqli_connect("localhost","root","","medfit");
$patientid = $_SESSION['patient_id'];
$name_query = "SELECT * FROM `patient` WHERE `patient_id`='$patientid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['first_name'];
  $lname = $row['last_name'];
}
$msg="";
if(isset($_GET['post_id'])){
    
    $con = mysqli_connect("localhost","root","","medfit");
    $post_id = $_GET['post_id'];
    $query = "SELECT * FROM `posts` WHERE `post_id` = '$post_id'";
    $result = mysqli_query($con,$query);
    
    if(mysqli_num_rows($result)>=1){

        while($row = mysqli_fetch_assoc($result)){
            $post_id = $row['post_id'];
            $doctor_idd = $row['doctor_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_links = $row['plinks'];
            $post_tags = strip_tags($row['post_tags']);
            $post_date = $row['post_date'];

        }

    }
}

?>
<?php  include('C:/xampp/htdocs/MedFit_MCA/blogs/includes/post_header.php'); ?>

<div class="container">
<div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $post_title; ?></h5>
                <p class="card-title"><?php echo $post_author; ?></p>
                <p class="card-text"><small class="text-body-secondary"><?php echo $post_date ?></small></p>
                <br>
                <p class="card-text"><?php echo $post_content; ?></p>
                <!-- <a href='" . strip_tags($post_links) . "'>echo $post_links;</a> -->
                <a target="_blank" class="card-text" href=<?php echo $post_links  ?>> click here for more details </a> 
            </div>
        </div>  
</div>

<?php  include('C:/xampp/htdocs/MedFit_MCA/blogs/includes/blog_footer.php'); ?>