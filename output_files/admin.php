<?php
//start session
include 'header.php';
include '../php_files/db_connection.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href='admin_themes_videos.php'>Adminstrate all themes and videos</a>


		<h2>Add subjects</h2>
    <?php
		//add sucject form
		 echo '
		 <form action="../php_files/subject.php" method="post" enctype="multipart/form-data">
		 <input type="hidden" name="teacherid" value='.$_SESSION['id'].'>
		 <label>Subject name: </label>
		 <input type="text" name="subname" placeholder="Write name of subject here">
		 <label>Subject description: </label>
		 <input type="text" name="subdescription" placeholder="Write description of subject here">
		 <button type="submit" name="Subsubmit">Add new subject</button>
		 </form>';

		 //display all subjects
		 echo "<h2>Subjects</h2>" . "<br>";
		 $query = "SELECT * FROM subjects";
     $result = $conn->query($query);
     if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
       echo $row["subjectId"]. "<br>";
       echo $row["subjectName"]. "<br>";
       echo $row["description"]. "<br>";
       echo'
       <a class="delete-user" href="../php_files/subject.php?id=' . $row['subjectId'] . '">Delete</a>'. "<br>";
		}
	}else {
		echo "No subjects have been added.";
	}

echo '<br><h2>Administrate users</h2>';
//get all users from database, but exclude self
    $queryadmin = "SELECT * FROM users WHERE  userId <> '".$_SESSION['id']."'";

    $resultadmin = $conn->query($queryadmin);
    if ($resultadmin->num_rows > 0) {
echo '<div id="admin-container">';
echo "<h2>Admin rights - delete/update users</h2>" . "<br>";
    while($row = $resultadmin->fetch_assoc()){
    echo '<h3>'.$row["name"]. "<br>".'</h3>';
    echo $row["userId"]. "<br>";
     echo $row["email"]. "<br>";
     echo $row["userType"]. "<br>";
     echo'
     <a class="delete-user" href="../php_files/user_changes.php?id=' . $row['userId'] . '">Delete</a>'. "<br>";

//is user is a teacher - make admin button appear
    if ($row["userType"] == 'teacher') {
       echo '<form action="../php_files/user_changes.php" method="post">
        <input type="hidden" name="userId" value="'. $row['userId'].'">
        <button type="submit" name="makeadmin-submit">Make admin</button>
       </form>';
     }
    }
    echo "<hr>";
  }else {
		echo "You are the only user in the database.";
	}


//Get values from requests table
   $queryadmin = "SELECT * FROM requests INNER JOIN users ON  users.userId=requests.uId WHERE uId <> '".$_SESSION['id']."'";
 echo "<h2>Requests to be teacher</h2>" . "<br>";
   $resultadmin = $conn->query($queryadmin);
   if ($resultadmin->num_rows > 0) {
echo '<div id="admin-container">';
echo "<h2>Requests to be teacher</h2>" . "<br>";
   while($row = $resultadmin->fetch_assoc()){
   echo '<h3>'.$row["name"]. "<br>".'</h3>';
   echo $row["rId"]. "<br>";
    echo $row["uId"]. "<br>";
    echo $row["name"]. "<br>";
    echo '<form action="../php_files/user_changes.php" method="post">
       <input type="hidden" name="userId" value="'. $row['uId'].'">
       <button type="submit" name="make_teacher_submit">Approve</button>
      </form>';

      echo '<form action="../php_files/user_changes.php" method="post">
         <input type="hidden" name="duserId" value="'. $row['uId'].'">
         <button type="submit" name="decline_teacher_submit">Decline</button>
        </form>';
   }
 }

?>

  </body>
</html>
