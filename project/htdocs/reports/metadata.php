<?php
session_start();
$page_title="Brew City Rentals - Metadata Report";
include ("../includes/header.php");

if (!isset($_SESSION['email'])|| ($_SESSION['role']!='admin')){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
}else{
	require_once ('../../mysqli_connect.php');
	//MOVIE count
	$query = "SELECT COUNT(*) FROM `MOVIE`"; 
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$movietotal=$row[0];
		}
	//Genre Variety count
	$query = "SELECT count(DISTINCT genre) from MOVIE"; 
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$genretotal=$row[0];
		}
	//Average Time 
	$query = "SELECT round(avg(runtime),0) from MOVIE"; 
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$avgtime=$row[0];
		}
		//Average Time 
	$query = "SELECT genre, count(genre) FROM `MOVIE` GROUP BY genre ORDER BY COUNT(genre)DESC LIMIT 5"; 
	$result = @mysqli_query ($dbc, $query);
	while ($row = $result->fetch_row()) {
		$moviegenres[]=$row[0];
		}
	//User Count
	$query = "SELECT COUNT(*) FROM `users`"; 
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$usertotal=$row[0];
		}
	//Tim Count
	$query = "Select DISTINCT(first_name) from users where first_name LIKE '%tim%'"; 
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$timvariety[]=$row;
		}
	//User Count
	$query = "SELECT count(users.role_id), roles.role_name FROM `users` 
			  JOIN roles WHERE users.role_id = roles.role_id
			  GROUP BY roles.role_name
			  ORDER BY COUNT(users.role_id) DESC";
	$result = @mysqli_query ($dbc, $query);
		while ($row = $result->fetch_row()) {
		$roletotal[]=$row;
		}

	echo "
	<div class='metamovie'><h2>Movie Metadata</h2>
	<div class='item 1'><label >Total Movies: </label>".$movietotal."</div>
	<div class='item 2'><label>Variety of Genres:</label>".$genretotal."</div>
	<div class='item 3'><label>Top 5 Genres:</label>
	<ol>";
	foreach ($moviegenres as $msg) { 
		echo "<li>$msg</li>";
	}
	echo"</ol></div>
	<div class='item 4'><label>Average Runtime: </label>".$avgtime." minutes</div>
	</div>";
	
	echo"<div class='metamovie'><p><h2>Customer Metadata</h2>
	<div class='item 5'><label >Total Users: </label>".$usertotal."</div>
	<div class='item 6'><label>Role Variety</label>
	<ol>";
	foreach ($roletotal as $role) { 
		echo "<li>$role[1] = $role[0]</li>";
	}
	echo"</ol></div>
	<div class='item 6'><label>User Names Containing 'TIM'</label>
	<ul>";
	foreach ($timvariety as $usertim) { 
		echo "<li>$usertim[0]</li>";
	}
	echo"</ul></div>";
	mysqli_close($dbc);
}
	//include the footer
	include ('../includes/footer.php');
?>
