<?php
include 'header.php';
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


echo "<br/>";
    $select = "SELECT playlistentries.PlaylistId, playlistentries.videoId, videos.videoName, videos.description
    FROM playlistentries
		INNER JOIN videos on videos.videoId=playlistentries.videoId
    WHERE playlistId='$pid'";
    $resulttopics = $conn->query($select);
    $result = $conn->query($select);
    if ($result->num_rows > 0) {

        while($row = $resulttopics->fetch_assoc()){
          echo $row["videoName"]."<br/>";
					echo $row["description"]."<br/>";

          echo'<form action="../php_files/playlist_changes.php" method="post">
    						<input type="hidden" name="vId" value='.$row["videoId"].'>
                <input type="hidden" name="pId" value='.$pid.'>
    						<button type="submit" name="remove-video-submit">Remove video</button>
    						</form>';
       }
      }

		 ?>

  </body>
</html>
