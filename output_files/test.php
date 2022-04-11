<?php
include 'header.php';
include '../php_files/db_connection.php';
include '../php_files/Classes/db.class.php';
include '../php_files/Classes/video.class.php';
include '../php_files/Classes/showvideo.class.php';
include '../php_files/Classes/playlistentries.class.php';
include '../php_files/Classes/search.class.php';
include '../php_files/Classes/subscribe.class.php';

$stmt = $conn->prepare('SELECT name, pwd, email, userType FROM users WHERE userId = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name, $password, $email, $type);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Video System</title>
  </head>
  <body>
    <?php
        include '../php_files/db_connection.php';
    //check if user i logged in - then display:
        if (isset($_SESSION['loggedin'])) {
            echo '<div class="content">
              <h2>Hello</h2>
              <p>Welcome back '.$name.'</p>
              <p>Your subscriptions:</p>
            </div>';

            //search class with form
          $subscribes = new Subscribes();
          $subscribes->showAllSubscribes();
  echo "<hr>";
          //search class with form
        $search = new Search();
echo "<hr>";
//display all playlists
         $playlists = new Playlistentries();
         $playlists->showAllEntries();
echo "<hr>";
//display all videos from showvideo class
         $videos = new ViewVideos();
         $videos->showAllvideos();

}
        //if user is not logged in - display:
        else {
          include "register.php";
          echo '<div class="content">
            <h2>Hello</h2>
            <p>To see this content, you need to log in with your account, or sign up!</p>
          </div>';
        }
     ?>
  </body>
</html>7


//display buttons of themes
$sql = "SELECT * FROM subjects";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
 while($row = $results->fetch_assoc()){
echo '<form action="../php_files/Classes/theme.class.php" method="post">
    <input type="hidden" name="svalue" value="'.$row['subjectId'].'">
    <button type="submit" name="sname">'. $row['subjectName'].'</button>
    </form>';
}
}
