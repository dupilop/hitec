<?php
session_start();
session_destroy();
header('location: login.php');
$_SESSION['sadminloggedin'] = false;
$_SESSION['adminloggedin'] = false;
$_SESSION['staffloggedin'] = false;
?>