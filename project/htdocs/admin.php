<?php 

// This page lets the user logout.
session_start(); 
$page_title="Brew City Rentals - ADMIN";
include ('includes/header.php');

// If no session variable exists, redirect the user.
if (!isset($_SESSION['email']) || ($_SESSION['role']!='admin')) {
	echo('<p><div class="error"> Must be admin to view this page</div></p>');

} else { // Cancel the session.
	echo('<h1>Movies</h1>');
	echo('<h3><a href="movies/add.php" alt="add movie">Add</a></h3>');
	echo('<h3><a href="movies/searchform_admin.php" alt="add or edit movie" > Update/Delete</a></h3>');
	echo('<h1>Users</h1>');
	echo('<h3><a href="register.php">Add</a></h3>');
	echo('<h3><a href="view_users.php">Update/Delete</a></h3>');
	echo('<h1>Reports</h1>');
	echo('<h3><a href="reports/metadata.php">Metadata</a></h3>');
	echo('<h3>For server error files and audit Logs, please remotely connect to server to view</h3>');

} 

include ('includes/footer.php');
?>