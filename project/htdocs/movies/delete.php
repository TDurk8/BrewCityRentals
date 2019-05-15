<?php
session_start();
$page_title="Brew City Rentals - Delete Movie";
include ("../includes/header.php");

if (!isset($_SESSION['email'])|| ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
}else{

	require_once ('../../mysqli_connect.php');
	$id=$_GET['id']; 
	$query = "DELETE FROM MOVIE WHERE movie_id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	if ($result){
		echo "<h2 class='resultcenter'>The selected record has been deleted.</h2>"; 
	}else {
		echo "The selected record could not be deleted."; 
	}
	echo "<p class='resultcenter'><a href=../movies/searchform_admin.php>Edit another Movie?</a>"; 
	mysqli_close($dbc);
}
	//include the footer
	include ('../includes/footer.php');
?>
