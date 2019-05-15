<?php 
session_start();
$page_title="Brew City Rentals - Search";
include ("../includes/header.php");


if (!isset($_SESSION['email'])|| ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
}else{
?>

	<h1>Search for Movie (Edit Mode)</h1>
	<br>
	<a href="../movies/add.php">Add movie to database here</a>
	<form id = "gridview" action="search.php" method="post">
		<div></div><label>Movie Title: </label>
			<input type="text" name="title" size="50" value="<?php echo $row['title'];?>"/><div></div>
		<div></div><label>Year of Release (>1980):  </label>
			<input type="text" name="year" size="50" value="<?php echo $row['year'];?>"/><div></div>
		<div></div><label>Movie Genre: </label>
			<input type="text" name="genre" value="<?php echo $row['genre'];?>"/><div></div>
			<div></div><div></div><div><input class="gridviewbutton" type="submit" value="search">
			<input class="gridviewbutton" type="reset" value="reset" width="50px"></div>
			<input type="hidden" name="id" value="<? echo $row['id'];?>"/>
	</form>

<?
}
	//include the footer
	include ("../includes/footer.php");

?> 