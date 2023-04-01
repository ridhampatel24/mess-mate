<?php 
ob_start();
session_start();
include('DbConnection.php'); 
$conn = OpenCon();

date_default_timezone_set('Asia/Kolkata');
?>