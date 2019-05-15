<?php
session_start();
$page_title="Brew City Rentals - Delete Movie";
include ("../includes/header.php");


if (!isset($_SESSION['email'])|| ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
}else{
	require_once ('../../mysqli_connect.php');
	$id=$_GET['id'];  
	$query = "SELECT * FROM MOVIE WHERE movie_id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "<br><h2 class='resultcenter'>Are you sure that you want to delete this record?</h2><br>";
/* 			echo ('<div class="resultcenter">');
				echo "<br><h2>Are you sure that you want to delete this record?</h2>";
				echo "<p><h2><br>TITLE: ".$row['title']."<br>YEAR: ".$row['year']."<br>RUNTIME: ".$row['runtime']."<br>GENRE: ".$row['genre']."</h2></p>"; 
				echo "<a href=delete.php?id=".$id.">YES</a> 
			    <a href=../movies/searchform_admin.php>NO</a>";   
				echo "<input type='text' name='yes' value='yes'/>";
				echo "<input type='text' name='no' value='no'/ onclick=\"window.location.href = '../movies/searchform_admin.php'\" />";
			echo ('</div>'); */
		echo ('<form id = "gridview" action="" method="post">
			<div></div><label>Movie Title: </label>'.$row['title'].'<div></div>
			<div></div><label>Year of Release:  </label>'.$row['year'].'<div></div>
			<div></div><label>Movie Genre: </label>'.$row['genre'].'<div></div>
			<div></div><label>Runtime: </label>'.$row['title'].'<div></div>	
			<div></div><div class="deletebutton"><a href=delete.php?id='.$id.'>yes</a></div><div class="deletebutton"><a href=../movies/searchform_admin.php>no</a></div>
		</form>');
		} // End of While statement
    
	}else{ // If it did not run OK.
		echo '<p>There is no such record.</p>';
	}
	mysqli_close($dbc); // Close the database connection.
	//include the footer
		include ('../includes/footer.php');
}
?>
