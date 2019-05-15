<?php 
session_start();
$page_title="Brew City Rentals - Search";
include ("../includes/header.php");


if (!isset($_SESSION['email'])){
	echo "<h1>Only members of our free and exclusive club can search for movies.</h1>
	<br>
	<h2 align=center> Click below to join now!</h2>
	<br><br>";
	echo('<div align="center"><a href="/capstone/htdocs/register.php"><img src= "../images/register.png" alt="login"></a></div>');
}else{
?>
	<h1>Search for Movie</h1>
	<br>
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