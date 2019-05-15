<?php 

// This page lets the user logout.
session_start(); 
$page_title="Brew City Rentals - Complete Order";
// If no session variable exists, redirect the user.
if (!isset($_SESSION['email'])) {
	header("Location: /capstone/htdocs/index.php");
	exit(); // Quit the script.
} else { // Cancel the session.
	header("Refresh: 3; url=/capstone/htdocs/index.php");
}

// Include the header code.
include ('../includes/header.php');

// Print a customized message.
echo "<br><h1>Brew City Rentals thanks you for your patronage!</h1>";
echo "<h2>Your movie has been reserved</h2>";

include ('../includes/footer.php');
?>
