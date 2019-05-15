<?php 
// Include header.php
session_start();
$page_title="BCR - Register";
include("includes/header.php");

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {
	require_once ('../mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.

	// Check for a first name.
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$first_name = mysqli_real_escape_string($dbc, $_POST['first_name']);
	}

	// Check for a last name.
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$last_name = mysqli_real_escape_string($dbc, $_POST['last_name']);
	}

	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
	}

	// Check for a password and match against the confirmed password.
	if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$password = mysqli_real_escape_string($dbc, $_POST['password1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything's OK.
		// Register the user in the database.
		// Check for previous registration.
		$query = "SELECT user_id FROM users WHERE email='$email'";
		$result = mysqli_query($dbc, $query);
		if (mysqli_num_rows($result) == 0) { // if there is no such email address
			// Make the query.
			$query = "INSERT INTO users (first_name, last_name, email, pass, registration_date) 
			VALUES ('$first_name', '$last_name', '$email', '$password', NOW() )";		
			$result = mysqli_query ($dbc, $query); // Run the query.
			if ($result) { // If it ran OK.
				echo "<p>You are now registered. Please, login to use our great service.</p>";
				echo "<br><a href=/capstone/htdocs/Home/login.php>Login</a>";
				exit();
			} else { // If it did not run OK.
				$errors[] = 'You could not be registered due to a system error. We apologize for any inconvenience.'; // Public message.
				$errors[] = mysqli_error($dbc); // MySQL error message.
			}

		} else { // Email address is already taken.
			$errors[] = 'The email address has already been registered.';
		}

	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page now.
if (!empty($errors)) { // Print any error messages.
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo "$msg<br />";
	}
	echo '</p>';
	echo '<p>Please try again.</p>';
}

// Create the form.
?>

<h1>Register</h1>
<br>
<a href="Home/login.php">Already a member? Click here.</a>
<form id="gridview" action="register.php" method="post">
	<div></div><label>First Name: </label>
	<input type="text" name="first_name" size="15" maxlength="15" value="<?php echo $_POST['first_name']; ?>" /><div></div>
	<div></div><label>Last Name: </label>
	<input type="text" name="last_name" size="15" maxlength="30" value="<?php echo $_POST['last_name']; ?>" /><div></div>
	<div></div><label>Email Address: </label>
	<input type="text" name="email" size="20" maxlength="40" value="<?php echo $_POST['email']; ?>"  /><div></div>
	<div></div><label>Password: </label>
	<input type="password" name="password1" size="10" maxlength="20" /><div></div>
	<div></div><label>Confirm Password: </label>
	<input type="password" name="password2" size="10" maxlength="20" /><div></div>
	<div></div><div></div><input class="gridviewbutton" type="submit" name="submit" value="Register" />
	<input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
// Include footer.php
include("includes/footer.php");
?>
