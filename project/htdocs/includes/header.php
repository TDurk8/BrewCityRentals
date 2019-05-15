<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $page_title; ?></title>	
	<link rel="stylesheet" href="/capstone/htdocs/includes/style.css" type="text/css" media="screen" />
</head>

<body>
	<div id="header">
		<h1>BREW CITY RENTALS</h1>
		<h2>Best Video Rental Store in Milwaukee!</h2>
<?
	if($_SESSION['role']=='admin'){
		echo ("<h3>Welcome " . $_SESSION['first_name'] . "(admin)</h3>");
	}
	else if(isset($_SESSION['email'])){
		echo ("<h3>Welcome " . $_SESSION['first_name']. "</h3>");
	}
?>
	</div>
<?

if (!isset($_SESSION['email'])){
	echo ('<div id="navigation">');
		echo ('<ul>');
			echo ('<li><a href="/capstone/htdocs/index.php">Home</a></li>');
			echo ('<li><a href="/capstone/htdocs/movies/searchform.php">Search</a></li>');
			echo ('<li><a href="/capstone/htdocs/specials.php">Specials</a></li>');
			echo ('<li><a href="/capstone/htdocs/register.php">Register</a></li>');
			echo ('<li><a href="/capstone/htdocs/Home/login.php">Login</a></li>');
		echo ('</ul>');
	echo ('</div>');
} else if ($_SESSION['role']=='admin') {
	echo ('<div id="navigation">');
		echo ('<ul>');
			echo ('<li><a href="/capstone/htdocs/index.php">Home</a></li>');
			echo ('<li><a href="/capstone/htdocs/movies/searchform_admin.php">Search</a></li>');
			echo ('<li><a href="/capstone/htdocs/specials.php">Specials</a></li>');
			echo ('<li><a href="/capstone/htdocs/admin.php"><div id="navadmin">ADMIN</div></a></li>');
			echo ('<li><a href=/capstone/htdocs/Home/logout.php>Logout</a></li>');
		echo ('</ul>');
	echo ('</div>');
} 
else {
	echo ('<div id="navigation">');
		echo ('<ul>');
			echo ('<li><a href="/capstone/htdocs/index.php">Home</a></li>');
			echo ('<li><a href="/capstone/htdocs/movies/searchform.php">Search</a></li>');
			echo ('<li><a href="/capstone/htdocs/specials.php">Specials</a></li>');
			echo ('<li><a href="/capstone/htdocs/password.php">Change Password</a></li>');
			echo ('<li><a href=/capstone/htdocs/Home/logout.php>Logout</a></li>');
		echo ('</ul>');
	echo ('</div>');
}
?>

<div id="content">


