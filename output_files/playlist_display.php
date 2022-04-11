<?php
include 'header.php';

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
    $timezone = date_default_timezone_get();
    include '../php_files/db_connection.php';

		//få tak i playlistname fra href og print ut
		$pid = $_GET['id'];
		$select = "SELECT * FROM playlists WHERE playId='$pid'";
    $resulttopics = $conn->query($select);
    $result = $conn->query($query);
    if ($resulttopics->num_rows > 0) {

        while($row = $resulttopics->fetch_assoc()){
          echo '<h2>'.$row["playName"].'</h2><br/>';
       }
      }


    		$queryadmin = "SELECT uId FROM subscribes WHERE pId='".$pid."' AND uId='".$_SESSION['id']."'";

    		$resultadmin = $conn->query($queryadmin);
    		if ($resultadmin->num_rows == 1) {
          echo '<form action="../php_files/subscribes.php" method="post">
               <input type="hidden" name="uId" value='.$_SESSION['id'].'>
               <input type="hidden" name="pid" value='.$pid.'>
             <button type="submit" name="unsubscribe-submit">Unsubscribe</button>
            </form>';
    		} else {
          echo '<form action="../php_files/subscribes.php" method="post">
                <input type="hidden" name="uId" value='.$_SESSION['id'].'>
                <input type="hidden" name="pid" value='.$pid.'>
           <button type="submit" name="subscribe-submit">Subscribe</button>
          </form>';
    			}

echo "<br/>";
$select = "SELECT playlistentries.PlaylistId, playlistentries.videoId, videos.videoName, videos.description, videos.content
FROM playlistentries
INNER JOIN videos on videos.videoId=playlistentries.videoId
WHERE playlistId='$pid'";
$resulttopics = $conn->query($select);
$result = $conn->query($select);
if ($result->num_rows > 0) {

		while($row = $resulttopics->fetch_assoc()){
			echo $row["videoName"]."<br/>";
			echo $row["description"]."<br/>";
			    echo "Video: "."<video width='330' height='240'><source src=".$row['content']."></video><br/>";
       }
      }

		 ?>

  </body>
</html>
