<?php # index.php
session_start();
$page_title="Brew City Rentals - Specials";
include ('includes/header.php');
?>

<?	
	require_once ('../mysqli_connect.php');
	$query="SELECT * FROM MOVIE WHERE movie_id='19012' LIMIT 1";
	$result= @mysqli_query ($dbc,$query);
	    while ($row = $result->fetch_row()) {
        $id =$row[0];
		$title =$row[1];
		$year =$row[2];
		$runtime =$row[3];
		$genre =$row[4];
    }
	mysqli_close($dbc);
	echo ('<h1 align=right>BCR\'s Monthly Special - May 2019</h1>');
	echo ('<div class="special"><img src=images/spacejam.jpg alt="greatest movie of all time"></div>');
	echo ('<div class="banner"><img class="banner" src=images/special.png alt=special></div>');
	echo (' <div class="specialview">
				<div class="specialheader">Sku# </div>
				<div class="specialtext">' . $id .'</div>
				<div class="specialheader">Title: </div>
				<div class="specialtext">' . $title .'</div>
				<div class="specialheader">Year: </div>
				<div class="specialtext">' . $year .'</div>
				<div class="specialheader">Genre: </div>
				<div class="specialtext">' . $genre .'</div>
				<div class="specialheader">Runtime: </div>
				<div class="specialtext">' . $runtime .' minutes</div>
			</div>');
	echo('<div style="clear:both;"></div>');
if (!isset($_SESSION['email'])){

	echo ('<div id="button">');
		echo('<h1 align=center>This exclusive is for members only. Register for free!</h1>');
			echo('<a href="/capstone/htdocs/register.php"><img class=banner src="../htdocs/images/register.png" alt="register"></a>');
	echo ('</div>');
} else {
		echo('<a href="/capstone/htdocs/movies/rent.php?id='.$id.'"><img class=banner src="../htdocs/images/ordernow.png"></a>');
} 
?>

<?php
include ('includes/footer.php');
?>
