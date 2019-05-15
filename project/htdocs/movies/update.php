<?php
session_start();
//check the session
if (!isset($_SESSION['email'])){
	echo "You are not logged in!";
	exit();
}else{
	//include the header
	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');
	#execute UPDATE statement

	$id = mysqli_real_escape_string($dbc, $_POST['id']); 
	$title = mysqli_real_escape_string($dbc, $_POST['title']); 
	$year = mysqli_real_escape_string($dbc, $_POST['year']); 
	$genre = mysqli_real_escape_string($dbc, $_POST['genre']); 
	$runtime = mysqli_real_escape_string($dbc, $_POST['runtime']); 
	
	$query = "UPDATE MOVIE SET title='$title',year='$year',genre='$genre', runtime='$runtime' WHERE movie_id='$id'"; 
	$result = @mysqli_query ($dbc, $query); 
	if ($result){
		echo "<center><p><b>The selected record has been updated.</b></p>"; 
		echo "<br><a href=/capstone/htdocs/movies/searchform_admin.php>Edit Another?</a></center>"; 
	}else {
		echo "<p>The record could not be updated due to a system error" . mysqli_error() . "</p>"; 
	}
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}

?>
