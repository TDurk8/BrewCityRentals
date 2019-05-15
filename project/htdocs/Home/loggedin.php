<?php
session_start(); 
$page_title="Brew City Rentals - Login";

// Print a customized message:
if (isset($_SESSION['email'])){
	//header("Location: /capstone/htdocs/Home/login.php");
//} else {
	header("Location: /capstone/htdocs/specials.php");
} 
include ('../includes/header.php'); // Include the header file.
include ('../includes/footer.php'); // Include the footer file.
?>