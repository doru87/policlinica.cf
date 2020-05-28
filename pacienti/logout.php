<?php
session_start();
unset($_SESSION['utilizator_email']);
unset($_SESSION['id']);
unset($_SESSION['nume_intreg']);
header("Location:/policlinica/user-login.php");
?>
