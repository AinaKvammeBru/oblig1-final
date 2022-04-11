<?php
//start session
include 'header.php';
include '../php_files/db_connection.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $conn->prepare('SELECT name, email, userType FROM users WHERE userId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name, $email, $type);
$stmt->fetch();
$stmt->close();
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">

		<div class="profile-content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$name?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
          <tr>
						<td>User type:</td>
						<td><?=$type?></td>
					</tr>
				</table>
			</div>
		</div>
<form method="post">
  <button type="submit" name="userupdate">Update profile</button>
 </form>

 <?php
//update-form appears when user clicks on update button
  if (isset($_POST['userupdate'])) {

  echo '<form action="../php_files/user_changes.php" method="post">
   <input type="hidden" name="thisUI" value='.$_SESSION['id'].'>
   <input type="text" name="newname" placeholder="New name">
   <input type="text" name="newmail" placeholder="new e-mail">
   <input type="password" name="newpwd" placeholder="New password">
   <button type="submit" name="update-submit">Save</button>
  </form>';
  }

	//Display link to videos for teacher and admin
 $sql = "SELECT * FROM users WHERE userId = '".$_SESSION['id']."' AND userType='teacher' OR userId = '".$_SESSION['id']."' AND userType='admin'";
 $results = $conn->query($sql);
 if ($results->num_rows > 0) {
echo "<a href='my_videos.php'>My videos</a><br>";
}

//Display link to administrative page for admin users
$sql = "SELECT * FROM users WHERE userId = '".$_SESSION['id']."' AND userType='admin'";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
echo "<a href='admin.php'>Administrative page</a>";
}
    ?>


	</body>
</html>
