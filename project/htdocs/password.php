<?php # Script 9.7 - password.php
// This page lets a user change their password.
//check session first

session_start();
$page_title = 'Change Your Password';
include ('includes/header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('../mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.

		// Check that they've entered the right email address/password combination:
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=('$p') )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.
	
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=('$np') WHERE user_id=$row[0]";		
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your password has been updated. </p><p><br /></p>';	

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	
			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include ('includes/footer.php'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The email address and password do not match those on file.</p>';
		}
		
	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<h1>Change Your Password</h1>
<br>
<form id="gridview" action="password.php" method="post">
		<div></div><label>Email Address: </label>
		<input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /><div></div>
		<div></div><label>Current Password: </label>
		<input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /><div></div>
		<div></div><label>New Password: </label>
		<input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /><div></div>
		<div></div><label>Confirm Password: </label>
		<input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /><div></div>
		<div></div><div></div><input class="gridviewbutton" type="submit" name="submit" value="Submit" />
</form>

<?php include ('includes/footer.php'); ?>