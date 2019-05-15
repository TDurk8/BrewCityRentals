<?php 

// This page lets the user logout.
session_start(); 
$page_title="Brew City Rentals - Logout";
// If no session variable exists, redirect the user.
if (!isset($_SESSION['email'])) {
	header("Location: /capstone/htdocs/index.php");
	exit(); // Quit the script.
} else { // Cancel the session.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	header("Refresh: 1; url=/capstone/htdocs/Home/login.php");
}

// Include the header code.
include ('../includes/header.php');

// Print a customized message.
echo "<h1>Logged Out! Redirecting...</h1>";

include ('../includes/footer.php');
?>
