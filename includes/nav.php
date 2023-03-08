<?php 
$con = mysqli_connect("localhost","root","","medfit");
$name_query = "SELECT * FROM `patient` WHERE `patient_id`='$patientid'";
$select_query = mysqli_query($con,$name_query);

while($row=mysqli_fetch_array($select_query)){
  $fname = $row['first_name'];
  $lname = $row['last_name'];
}

?>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/MedFit_MCA">MedFit</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/MedFit_MCA/welcome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Search Hospitals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/MedFit_MCA/doc_search.php">Search Doctors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/MedFit_MCA/profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">FitBit(Beta)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Book Appointments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/MedFit_MCA/logout.php">Logout</a>
        </li> 
      </ul>
      <div class="session-details"><?php echo $fname .' '.$lname;  ?></div>
    </div>
  </div>
</nav>