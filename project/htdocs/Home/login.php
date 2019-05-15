<?php
// Send NOTHING to the Web browser prior to the session_start() line!
// Check if the form has been submitted.
session_start();
if (isset($_POST['submitted'])) {
	require_once ('../../mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// Check for a password.
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	}
	if (empty($errors)) { // If everything's OK.
		/* Retrieve the user_id and first_name for 
		that email/password combination. */
		
		$query = "SELECT users.user_id, users.first_name,users.last_name,users.email,roles.role_name FROM users INNER JOIN roles ON users.role_id = roles.role_id WHERE users.email='$e' AND users.pass='$p'";
		$result = @mysqli_query ($dbc, $query); // Run the query.
		$row = mysqli_fetch_array ($result, MYSQLI_NUM);
		if ($row) { // A record was pulled from the database.
			//Set the session data:
			session_start(); 
			$_SESSION['user_id'] = $row[0]; 
			$_SESSION['first_name'] = $row[1];
			$_SESSION['last_name'] = $row[2];
			$_SESSION['email'] = $row[3];  
			$_SESSION['role'] = $row[4];

			// Redirect:
			header("Location:../Home/loggedin.php");
			exit(); // Quit the script.
		} else { // No record matched the query.
			$errors[] = 'The email address and password entered do not match those on file.'; // Public message.
		}
	} // End of if (empty($errors)) IF.
	mysqli_close($dbc); // Close the database connection.
} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page now.
$page_title="Brew City Rentals - Login";

include ('../includes/header.php');
if (!empty($errors)) { // Print any error messages.
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo " - $msg<br />\n";
	}
	echo '<br><br>Forgot Password? Click <a href="/capstone/htdocs/Home/forgot.php">HERE</a>';
	echo '</p><p>Please try again.</p>';
}

// Create the form.
?>

<h1> Brew City Rental Customer Login </h1>
<br>
<a href="../register.php">Not a member? Click here.</a>
<form id="gridview" action="login.php" method="post">
	<div></div><label>Email Address: </label><input type="text" name="email" size="20" maxlength="40" /><div></div>
	<div></div><label>Password: </label><input type="password" name="password" size="20" maxlength="20" /><div></div>
	<div></div><div></div><input class="gridviewbutton" type="submit" name="submit" value="Login" />
<input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
include ('../includes/footer.php');
?>
