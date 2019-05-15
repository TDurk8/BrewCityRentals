<?php # index.php
session_start();
$page_title="Brew City Rentals - Home";
include ('includes/header.php');
?>

<?
	echo ('<img class="homepage" src="images/bcr-inside.jpg" alt=bcr>');
	echo ('<h1>History of Video Stores</h1>');
	echo ("<div class='homepagetext')<p>The world's oldest business that rents out copies of movies for private use was opened by Eckhard Baum in Kassel, Germany in the summer of 1975. Baum collected movies on Super 8 film as a hobby and lent pieces of his collection to friends and acquaintances. Because they showed great interest in his films, he came up with the idea of renting out films as a sideline. Over the years, videotapes and optical discs were added to the range. Baum still operates the business as of September 2015 and was portrayed in the June 2006 documentary film Eckis Welt by Olaf Saumer</p></div>");
	echo ('<h1>Brew City Rentals</h1>');
	echo ("<div class='homepagetext')<p>We are the last standing store in Milwaukee, offering the greatest variety of movies including those hard to get classics. Check out our inventory online or stop in at the store. We enjoy the same passion as you do about the cinema, so stop in and have a chat with our expert staff. If we don’t have it, it doesn’t exist!</p></div>");
if (!isset($_SESSION['email'])){

	echo ('<div id="button">');
		echo('<a href="/capstone/htdocs/Home/login.php"><img src="../htdocs/images/login.png" alt="login"></a>');
		echo('<a href="/capstone/htdocs/register.php"><img src="../htdocs/images/register.png" alt="register"></a>');
	echo ('</div>');
} else {
	echo ('<h1> Hey ' . $_SESSION['first_name']. ', Check out these movies!</h1>');
	echo ('<div id="gridview">');
		echo('<a href="/capstone/htdocs/movies/searchform.php"><img src="../htdocs/images/search.png"></a>');
	echo ('</div>');
} 
?>

<?php
include ('includes/footer.php');
?>
