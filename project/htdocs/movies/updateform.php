<?php
session_start();
$page_title="Brew City Rentals - Edit Movie";
include ("../includes/header.php");
if (!isset($_SESSION['email']) || ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
	include ('../includes/footer.php');
	exit();
}else{
	require_once ('../../mysqli_connect.php');
	$id=$_GET['id']; 
	$query = "SELECT * FROM MOVIE WHERE movie_id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
			<form id ="gridview" action="update.php" method="post">
			<div></div><label>Title: </label><input name="title" size=50 value="<? echo $row['title']; ?>"><div></div>
			<div></div><label>Year: </label><input name="year" size=50 value="<? echo $row['year']; ?>"><div></div>
			<div></div><label>Genre: </label><input name="genre" size=50 value="<? echo $row['genre']; ?>"><div></div>
			<div></div><label>Runtime: </label><input name="runtime" size=50 value="<? echo $row['runtime']; ?>"><div></div>
			<div></div><div></div><div><input class="gridviewbutton" type=submit value=update>
			<input class="gridviewbutton" type=reset value=reset>
			<input type=hidden name="id" value="<? echo $row['movie_id']; ?>">
			</div>
			</form>
<?
		} //end while statement
	} //end if statement
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}
?>