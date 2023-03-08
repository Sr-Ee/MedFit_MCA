<?php

if(isset($_GET['id'])){
include('db.php');
$id =mysqli_real_escape_string($con,$_GET['id']); //user cannot tamper url-id.
$result = mysqli_query($con,"update `patient` set `verification_status`='1' where `verification_id`='$id'");
echo "<br>";
if($result){
echo "Your account is verified";
}
else{
    echo "account not verified";
}
}   

?>
<a href="login.php" name="verify">Click here to login</a>
