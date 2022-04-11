<?php
include 'header.php';
include '../php_files/db_connection.php';
include '../php_files/CLasses/db.class.php';
include '../php_files/Classes/playlistentries.class.php';

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}

echo '<h2>Create new Theme!</h2>
<form action="../php_files/addtheme.php" method="post">
<input type="hidden" name="themeId" value='.$_SESSION['id'].'>
<label>Theme name: </label>
<input type="text" name="themeName" placeholder="Write wanted theme here.." required>
<button type="submit" name="theme-submit">Add!</button>
</form>';

echo "<h2>Your themes</h2>";
//display themes of the user who is logged in
     $queryadmin = "SELECT * FROM theme WHERE uId = '".$_SESSION['id']."'";

     $resultadmin = $conn->query($queryadmin);
     if ($resultadmin->num_rows > 0) {
     while($row = $resultadmin->fetch_assoc()){
     echo '<h3>'.$row["themeName"]. "<br>".'</h3>';
		 echo '<form action="../php_files/video_changes.php" method="post">
				<input type="hidden" name="themeId" value="'. $row['themeId'].'">
				<button type="submit" name="delete-theme-submit">Delete</button>
			 </form>';

    }
	} else {
		echo "You have not created a theme yet.";
	}



echo "<hr>";

/*Form that lets user upload video to database by the upload.php file when the button is clicked*/
echo '<h1>Upload video</h1>
<form action="../php_files/upload.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="videouId" value='.$_SESSION['id'].'>
<label>New video name:</label>
<input type="text" name="new-name" placeholder="Video name">
<input type="hidden" name="vdate" value='.date('Y-m-d').'>
<label>Video description:</label>
<input type="text" name="description" placeholder="description">
<label>Video theme:</label>
<select name="themeid">
 <option value="themeid">Choose theme</option>'
?>
 <?php
include "db_connection.php";
$timezone = date_default_timezone_get();
$select = "SELECT * FROM theme";
$resulttopics = $conn->query($select);
$result = $conn->query($query);
if ($resulttopics->num_rows > 0) {

		while($row = $resulttopics->fetch_assoc()){
			echo '<option value="'.$row["themeId"].'"> '.$row['themeName'].'</option>';
		}
	}
?> <?php
echo'</select>
<label>Video file:</label>
<input type="file" name="content">
<button type="submit" name="video-submit">UPLOAD</button>
</form>
';

echo "<hr>";
echo "<h2>Your videos</h2>";
//display videos of the user who is logged in
     $queryadmin = "SELECT * FROM videos WHERE uId = '".$_SESSION['id']."'";

     $resultadmin = $conn->query($queryadmin);
     if ($resultadmin->num_rows > 0) {
     while($row = $resultadmin->fetch_assoc()){
     echo '<h3><a href="video_display.php?id='.$row['videoId'].'">'.$row['videoName'].'</a></h3>';
     echo $row["description"]. "<br>";
     echo $row["uId"]. "<br>";
      echo'
      <a class="delete-video" href="../php_files/video_changes.php?id=' . $row['videoId'] . '">Delete</a>'. "<br>";

//edit video button
      echo '<form method="post">
			  <input type="hidden" name="videoId" value="'.$row["videoId"].'">
        <button type="submit" name="videoupdate">Edit</button>
       </form>';

       //form appears when edit button is clicked
         if (isset($_POST['videoupdate'])) {
					 $videoId = $_POST['videoId'];
					 if ($videoId == $row["videoId"]) {
						 echo '<form action="../php_files/video_changes.php" method="post">
		          <input type="hidden" name="vidId" value='.$row["videoId"].'>
							<label>New video name: </label>
		          <input type="text" name="newvidname" placeholder="New video name">
							<label>New video description: </label>
		          <input type="text" name="newdesc" placeholder="new describtion">
							<label>New video theme: </label>
							<select name="newthemeid">
							 <option value="newthemeid">Choose theme</option>'
							?>
							 <?php
							include "db_connection.php";
							$timezone = date_default_timezone_get();
							$select = "SELECT * FROM theme";
							$resulttopics = $conn->query($select);
							$result = $conn->query($query);
							if ($resulttopics->num_rows > 0) {

									while($row = $resulttopics->fetch_assoc()){
										echo '<option value="'.$row["themeId"].'"> '.$row['themeName'].'</option>';
									}
								}
							?> <?php
							echo'</select>
		          <button type="submit" name="video-update-submit">Save</button>

						 </form>';

    }

}
}
}else {
echo "You have not uploaded a video yet.";
}

//make playlist
              echo '<h2>Make a playlist</h2>
              <br>
              <form action="../php_files/playlist.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="Puid" value='.$_SESSION['id'].'>
							<label>Playlist name: </label>
              <input type="text" name="Pname" placeholder="Write playlist name here">
							<label>Playlist description: </label>
              <input type="text" name="Pdescription" placeholder="Write description of playlist here">
							<label>Playlist subject: </label>
              <select  name="Psubject">
                <option value="Psubject">choose subject</option>'
                  ?> <?php
                include "db_connection.php";
                  $select = "SELECT * FROM subjects";
                  $resultvideoId = $conn->query($select);
                  $result = $conn->query($query);
                    if ($resultvideoId->num_rows > 0) {
                      while($row = $resultvideoId->fetch_assoc()){
                      echo '<option value="'.$row["subjectId"].'"> '.$row['subjectName'].'</option>';
                 }
          }?> <?php
                echo '</select>
								<label>Playlist theme: </label>
                <select  name="Ptheme">
                  <option value="Ptheme">choose theme</option>'
                  ?> <?php
                include "db_connection.php";
                  $select = "SELECT * FROM theme";
                  $resultvideoId = $conn->query($select);
                  $result = $conn->query($query);
                    if ($resultvideoId->num_rows > 0) {
                      while($row = $resultvideoId->fetch_assoc()){
                        echo '<option value="'.$row["themeId"].'"> '.$row['themeName'].'</option>';
              }
          }?> <?php
                echo '</select>
								<input type="hidden" name="playdate" value='.date('Y-m-d').'>
                <button type="submit" name="Psubmit">Make a new playlist</button>
              </form>';

/*new playlistentries clas and call function showPlaylists function*/
$playlists = new Playlistentries();
$playlists -> showPlaylists();

//add videos to playlist
echo  '<h2>Add videos to playlist</h2>
             <form action="../php_files/playlist.php" method="post" enctype="multipart/form-data">
           <select  name="PEplayId">
            <option value="PEplayId">Chose playlist</option>';
            ?> <?php
              include "db_connection.php";
              $select = "SELECT * FROM playlists";
              $resultlists = $conn->query($select);
              $result = $conn->query($query);
              if ($resultlists->num_rows > 0) {
                while($row = $resultlists->fetch_assoc()){
                  echo '<option value="'.$row["playId"].'"> '.$row['playName'].'</option>';
            }
        }?> <?php
              echo '</select>
              <select  name="PEvidoeId">
              <option value="PEvidoeId">Chose video</option>'
                ?> <?php
              include "db_connection.php";
              $select = "SELECT * FROM videos WHERE uId = '".$_SESSION['id']."'";
              $resultvideoId = $conn->query($select);
              $result = $conn->query($query);
              if ($resultvideoId->num_rows > 0) {
                while($row = $resultvideoId->fetch_assoc()){
                  echo '<option value="'.$row["videoId"].'"> '.$row['videoName'].'</option>';
            }
         }?> <?php
              echo '</select>
              <button type="submit" name="VPsubmit">Add videos to playlist</button>
              </form>';



							echo "<hr>";
							echo "<h2>Your playlists</h2>";
							//display playlists of the user who is logged in
							     $queryadmin = "SELECT * FROM playlists WHERE uId = '".$_SESSION['id']."'";

							     $resultadmin = $conn->query($queryadmin);
							     if ($resultadmin->num_rows > 0) {
							     while($row = $resultadmin->fetch_assoc()){
									 echo '<h3><a href="playlist_display.php?id='.$row['playId'].'">'.$row['playName'].'</a></h3>';
							     echo $row["description"]. "<br>";
									 echo '<form action="../php_files/video_changes.php" method="post">
										 <input type="hidden" name="playId" value="'. $row['playId'].'">
										 <button type="submit" name="delete-playlist-submit">Delete</button>
										</form>';

							//edit playlist link
							echo'
							<a href="edit_playlist.php?id=' . $row['playId'] . '">Edit playlist</a>'. "<br>";
							}
							}else {
							echo "You have not created a playlist yet.";
							}
