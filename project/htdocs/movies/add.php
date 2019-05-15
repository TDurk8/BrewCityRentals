<?php
session_start();
$page_title="Brew City Rentals - Search";
include ("../includes/header.php");
if (!isset($_SESSION['email'])|| ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
}else{
	require_once ('../../mysqli_connect.php'); 
	
	if (isset($_POST['submitted'])){
		if(empty($_POST['title'])){
			$errors[]= 'Your forgot Title';
		}else{
			$title=$_POST['title'];
		}
		if(empty($_POST['year'])){
			$errors[]= 'Your forgot Year';
		}else{
			$year=$_POST['year'];
		}
		if(empty($_POST['runtime'])){
			$errors[]= 'Your forgot Runtime';
		}else{
			$runtime=$_POST['runtime'];
		}
		if(empty($_POST['genre'])){
			$errors[]= 'Your forgot Genre';
		}else{
			$genre=$_POST['genre'];
		}
		$query="INSERT INTO MOVIE (title, year, runtime,genre)
			Values ('$title', '$year', '$runtime', '$genre')"; 
		$result=@mysqli_query ($dbc, $query); 

		if ($result){
			echo "<p><b>A new movie has been added!</b></p><br>"; 
			$errors=NULL;
		}else{
			$errors[]=("Invalid format. Remove special characters.");
		}
	}
	mysqli_close($dbc);
	if (!empty($errors)) { // Print any error messages.
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo "$msg<br />";
		}
		echo '</p>';
		echo '<p>Please try again.</p>';
	}
?>

	<h1> Add Movie </h1>
	<br><a href="../movies/searchform_admin.php">Click here to edit existing movies.</a>
	<form id = "gridview" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
	<div></div><label>Movie Title: </label>
		<input type="text" name="title" value= "<?php echo $_POST['title']; ?>"/><div></div>
	<div></div><label>Year of Release:  </label>
		<input type="text" name="year" value= "<?php echo $_POST['year']; ?>"/><div></div>
	<div></div><label>Movie Genre: </label>
		<input type="text" name="genre" value= "<?php echo $_POST['genre']; ?>"/><div></div>
	<div></div><label>Runtime: </label>
		<input type="text" name="runtime" value= "<?php echo $_POST['runtime']; ?>"/><div></div>	
	<div></div><div></div><div><input class="gridviewbutton" type="submit" value="submit">
	<input class="gridviewbutton" type="reset" value="reset"></div>
	<input type=hidden name=submitted value=true>
	
	</form>
<?
	//include the footer
	include ("../includes/footer.php");
}
?>



