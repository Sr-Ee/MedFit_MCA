<?php
ob_start();
$conn = mysqli_connect("localhost","root","","medfit");

if(!$conn){
    die("Connection not established because of: ". mysqli_connect_error());
}
// else{
//     echo "Connection Established";
// }


?>