<?php 
session_start();
$page_title="Brew City Rentals - Search";
include ("../includes/header.php");


if (!isset($_SESSION['email'])){
	echo "<h1>Only members can reserve movies for rental.</h1>
	<br>
	<h2 align=center> Click below to join now!</h2>
	<br><br>";
	echo('<div align="center"><a href="/capstone/htdocs/register.php"><img src= "../images/register.png" alt="login"></a></div>');
}else{
	require_once ('../../mysqli_connect.php');
	$movieid=$_GET['id'];
	$userid=$_SESSION['user_id'];
	$releasedate = date("Y-m-d", strtotime(' + 1 days'));
	
	$query="SELECT * FROM MOVIE WHERE movie_id=".$movieid;
	$result= @mysqli_query ($dbc,$query);
	    while ($row = $result->fetch_row()) {
		$title =$row[1];
		$year =$row[2];
		$runtime =$row[3];
		$genre =$row[4];
    }
	$query="SELECT * FROM users where user_id =".$userid;
	$result= @mysqli_query ($dbc,$query);
	    while ($row = $result->fetch_row()) {
		$fName =$row[1];
		$lName =$row[2];
		$email =$row[3];
    }
?>
	<h1 class="usercenter">Reserve Movie</h1>

	<div class="custtitle"><h1>Customer Info</h1></div>
	<div class="movtitle"><h1>Movie Title</h1></div>
	
	<div class="custinfogrid">
		<div class="cust a">User ID:</div>
		<div class="cust b"><?php echo $userid ?></div>
		<div class="cust c">First Name:</div>
		<div class="cust d"><?php echo $fName ?></div>
		<div class="cust e">Last Name:</div>
		<div class="cust f"><?php echo $lName ?></div>
		<div class="cust g">Email:</div>
		<div class="cust h"><?php echo $email ?></div>
		
	</div>
	<div class="movieinfogrid">
		<div class="mov a">Title:</div>
		<div class="mov b"><?php echo $title ?></div>
		<div class="mov c">Year:</div>
		<div class="mov d"><?php echo $year ?></div>
		<div class="mov e">Runtime:</div>
		<div class="mov f"><?php echo $runtime ?></div>
		<div class="mov g">Genre:</div>
		<div class="mov h"><?php echo $genre ?></div>
	</div>
	<div>
		<br>
		<p><h2> Clicking the button below will reserve your movie for one business day. We will release your movie on <?php echo $releasedate ?> at 4pm to allow other customers the opportunity to rent this film. Thank you for renting from Brew City Rentals!</h2></p>
	</div>
	<div class=usercenter><a href="completeorder.php"><img src="../images/ordernow.png" alt = "order now"></a>

<?
}
	//include the footer
	include ("../includes/footer.php");

?> 