<?php
//Check if the data from the login form was submitted, isset() will check if the data exists.
require 'db_connection.php';
session_start();
if ( !isset($_POST['lmail'], $_POST['password']) ) {
  require 'db_connection.php';
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}
// preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT userId, pwd FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['lmail']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();


  if ($stmt->num_rows > 0) {
  	$stmt->bind_result($id, $password);
  	$stmt->fetch();
  	// Account exists, now we verify the password.
  	// Note: remember to use password_hash in your registration file to store the hashed passwords.
  	if (password_verify($_POST['password'], $password)) {
  		// Verification success! User has loggedin!
  		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
  		session_regenerate_id();
  		$_SESSION['loggedin'] = TRUE;
  		$_SESSION['name'] = $_POST['lmail'];
  		$_SESSION['id'] = $id;
  		header('Location: ../output_files/index.php');
  	} else {
  		echo 'Incorrect password!';
  	}
  } else {
  	echo 'Incorrect username!';
  }


	$stmt->close();
}


 ?>
