<?php
session_start();
$doctorid = $_SESSION['doctor_id'];
if(!isset($_SESSION['is_login'])){
  header("Location: doctorlogin.php");
  die();
}
?>