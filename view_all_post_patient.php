<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="/MedFit_MCA/welcome.php">MedFit</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Hospitals</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
<div class="post-container">
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "medfit");
$patientid = $_SESSION['patient_id'];
$name_query = "SELECT * FROM `patient` WHERE `patient_id`='$patientid'";
$select_query = mysqli_query($con, $name_query);

$msg = "";

include('C:/xampp/htdocs/MedFit_MCA/blogs/includes/blog_header.php');

$post_query = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
$select_all_posts_query = mysqli_query($con, $post_query);

while ($row = mysqli_fetch_array($select_all_posts_query)) {
    $post_id = $row['post_id'];
    $doctor_idd = $row['doctor_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = strip_tags($row['post_tags']);
    $post_date = $row['post_date'];

    ?>
   
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $post_title; ?></h5>
                <p class="card-title"><?php echo $post_author; ?></p>

                <p class="card-text"><?php echo substr($post_content, 0, 100) . '...'; ?></p>
                <p class="card-text"><small class="text-body-secondary"><?php echo $post_date ?></small></p>
                <br>
                <a href="patient_post.php?post_id=<?php echo $post_id; ?>" class="btn btn-primary">Read More...</a>
            </div>
        </div>  
    <?php
}
include('C:/xampp/htdocs/MedFit_MCA/blogs/includes/blog_footer.php');
?>
</div>

