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
    <h1>Watch and comment!</h1>

    <?php
    $timezone = date_default_timezone_get();
    include '../php_files/db_connection.php';
		//få tak i video id fra href og print ut videonavn
    $vid = $_GET['id'];
    $select = "SELECT * FROM videos WHERE videoId='$vid'";
    $resulttopics = $conn->query($select);
    $result = $conn->query($query);
    if ($resulttopics->num_rows > 0) {

        while($row = $resulttopics->fetch_assoc()){
          echo '<h2>'.$row["videoName"].'</h2><br/>';
       }
      }


//check if user has liked video
		$queryadmin = "SELECT * FROM likes WHERE vId='".$vid."' AND uId = '".$_SESSION['id']."'";

		$resultadmin = $conn->query($queryadmin);
		if ($resultadmin->num_rows == 1) {
		echo "thank for liking";
		} else {
			echo '<form action="../php_files/rating.php" method="post">
						<input type="hidden" name="uId" value='.$_SESSION['id'].'>
						<input type="hidden" name="vId" value='.$vid.'>
						<button type="submit" name="Like-submit">Like</button>
						</form>';
			}

//show nr of likes the video have
			$select = "SELECT COUNT(uId)
      FROM likes WHERE vId='".$vid."'";
			$resulttopics = $conn->query($select);
			$result = $conn->query($query);
			if ($resulttopics->num_rows > 0) {

			while($row = $resulttopics->fetch_assoc()){
						echo $row["COUNT(uId)"]."<br/>";
								 }
							 }

//Comment form
    echo '<form action="../php_files/addtheme.php" method="post" id="cform">
    <input type="hidden" name="uId" value='.$_SESSION['id'].'>
    <input type="hidden" name="vId" value='.$vid.'>
		<input type="hidden" name="cdate" value='.date('Y-m-d').'>
    <textarea type="text" name="comment" rows="5" cols="50" placeholder="Write your comment!" form="cform"></textarea>
    <button type="submit" name="comment-submit">Post it!</button>
    </form>';

//display comments
    $select = "SELECT * FROM videos INNER JOIN comments ON comments.vId=videos.videoId
		INNER JOIN users ON users.userId=comments.uId
		WHERE vId='$vid' ORDER BY cdate DESC";
    $resulttopics = $conn->query($select);
    $result = $conn->query($query);
    if ($resulttopics->num_rows > 0) {

      while($row = $resulttopics->fetch_assoc()){
				echo $row["name"]."<br/>";
        echo $row["comment"]."<br/>";
				echo $row["cdate"]."<br/>";
      }
    }

//display average rating
		$select = "SELECT ROUND(AVG(rating)) FROM rating WHERE vId='$vid'";
		$resulttopics = $conn->query($select);
		$result = $conn->query($query);
		if ($resulttopics->num_rows > 0) {

			while($row = $resulttopics->fetch_assoc()){
			echo $row["ROUND(AVG(rating))"]."/5<br/>";
		}
	}

//rating form with a scale from 1-5
echo
   '<form action="../php_files/rating.php" method="post">
			 <input type="submit" name="button1"
							 value="1"/>
			 <input type="hidden" name="vId" value='.$vid.'>
			 <input type="submit" name="button2"
							 value="2"/>
			 <input type="hidden" name="vId" value='.$vid.'>
			 <input type="submit" name="button3"
							 value="3"/>
			 <input type="hidden" name="vId" value='.$vid.'>
			 <input type="submit" name="button4"
							 value="4"/>
			 <input type="hidden" name="vId" value='.$vid.'>
			 <input type="submit" name="button5"
							 value="5"/>
			 <input type="hidden" name="vId" value='.$vid.'>
	 </form>';

		 ?>

  </body>
</html>
