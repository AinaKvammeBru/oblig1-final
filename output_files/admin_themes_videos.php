<?php
//start session
include 'header.php';
include '../php_files/db_connection.php';
include '../php_files/Classes/db.class.php';
include '../php_files/Classes/video.class.php';

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

    <?php
    echo "<h1>All themes</h1>";
    $queryadmin = "SELECT * FROM theme";
    $resultadmin = $conn->query($queryadmin);
    if ($resultadmin->num_rows > 0) {
    while($row = $resultadmin->fetch_assoc()){
    echo '<h3>'.$row["themeName"]. "<br>".'</h3>';
    echo $row["uId"]. "<br>";
    echo '<form action="../php_files/admin_changes.php" method="post">
       <input type="hidden" name="themeId" value="'. $row['themeId'].'">
       <button type="submit" name="admin-delete-theme-submit">Delete</button>
      </form>';

     }
   }
    echo "<hr>";
    echo "<h1>All videos</h1>";
		/*New videoes class and call for AdminshowAllvideos function to return all videoes with option for deleting*/
		$videos = new Videos();
		$videos->AdminshowAllvideos();

?>
  </body>
</html>
