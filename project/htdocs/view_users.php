<?php # Script 10.5 - #5
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.
session_start();
$page_title = 'View the Current Users';
include ('includes/header.php');
echo '<h1>Registered Users</h1>';

if ($_SESSION['role']!='admin'){
	echo('<p><div class="error"> Must be admin to view this page</div></p>');
	include ('includes/footer.php');
	exit();
}
echo '<br><a href="register.php">Click here to add new user.</a>';
require ('../mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'rd':
		$order_by = 'registration_date ASC';
		break;
	default:
		$order_by = 'registration_date ASC';
		$sort = 'rd';
		break;
}
	
// Define the query:
$q = "SELECT last_name, first_name,email, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

	echo '<div class="userview">
			<div class="userheader" >LAST NAME</div>
			<div class="userheader">FIRST NAME</div>
			<div class="userheader">EMAIL</div>
			<div class="userheader"><div class="usercenter">DATE REGISTERED</div></div>
			<div class="userheader"></div>
			<div class="userheader"></div>';

// Fetch and print all the records....
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		   echo'<div>'. $row['last_name'] . '</div>
				<div>'. $row['first_name'] . '</div>
				<div>'. $row['email']. '</div>
				<div class="usercenter">'. $row['dr'] . '</div>
				<div><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></div>
				<div><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></div>
			';
		} // End of WHILE loop.
		echo '</div>'; //Close out gridview


mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
include ('includes/footer.php');
?>