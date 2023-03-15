<?php
session_start();

session_unset();

session_destroy();
header("Location: /MedFit_MCA/doctorlogin.php");

?>