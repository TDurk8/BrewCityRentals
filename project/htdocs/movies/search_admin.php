<?php
session_start();
$page_title="Brew City Rentals - Logout";

//include the header
	include ('../includes/header.php');

	require_once ('../../mysqli_connect.php');
	//formulate the search query
	if (!empty($_POST['id'])||!empty($_POST['title'])||!empty($_POST['year'])
		||!empty($_POST['genre'])){
		$id = mysqli_real_escape_string($dbc, $_POST['id']); 
		$title = mysqli_real_escape_string($dbc, $_POST['title']); 
		$year = mysqli_real_escape_string($dbc, $_POST['year']); 
		$genre = mysqli_real_escape_string($dbc, $_POST['genre']); 
		
		$query="SELECT * FROM MOVIE WHERE (title LIKE '%$title%')
		AND (year LIKE '%$year%')
		AND (genre LIKE '%$genre%')";
	}else {
		$query="SELECT * FROM MOVIE";
	}
	$result = @mysqli_query ($dbc, $query);
	
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		echo "<br><div><b>Your search returned $num entries.</b></div>
			  <div><a text-align='center' href=searchform.php>Search Again</a></div>
			  </br>";
		echo '<div class="resultview">
		<div class="resultheader">TITLE</div>
		<div class="resultheader">GENRE</div>
		<div class="resultheader"><div class="resultcenter">YEAR</div></div>
		<div class="resultheader"><div class="resultcenter">RUNTIME</div></div>
		<div class="resultheader"></div>
		<div class="resultheader"></div>'; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<div>".$row['title']."</div>"; 
			echo "<div>".$row['genre']."</div>"; 
			echo "<div class='resultcenter'>".$row['year']."</div>"; 
			echo "<div class='resultcenter'>".$row['runtime']." min</div>";
				if($_SESSION['role']=='admin'){
					echo "<div><a href=deleteconfirm.php?id=".$row['movie_id'].">Delete</a></div>"; 
					echo "<div><a href=updateform.php?id=".$row['movie_id'].">Update</a></div>"; 
				}
				else{
					echo "<div><a href=rentform.php?id=".$row['movie_id']."><img src=../images/rentnow.png alt=rentnow></a></div>"; 
					echo "<div></div>"; 
				}
		} // End of While statement
		echo "</div>"; 

		       
	} else { // If it did not run OK.
		echo '<p>Your search hits no result.</p>';
	}
	mysqli_close($dbc); // Close the database connection.
	echo ("</center></html>"); 
	//include the footer
	include ("../includes/footer.php");
?>