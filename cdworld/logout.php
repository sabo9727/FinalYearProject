<?php 
error_reporting(0);
session_start();
include('include/connect.php');

unset($_SESSION['customer_id']);
echo "<script>window.alert('Logout');window.location.assign('home_page.php')</script>";

 ?>