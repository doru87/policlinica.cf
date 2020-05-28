<?php
session_start();
unset($_SESSION['doctor_email']);
unset($_SESSION['doctor_id']);
unset($_SESSION['doctor_nume']);
header("Location:/policlinica/user-login.php");
?>
