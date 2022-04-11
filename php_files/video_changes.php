<?php
require 'db_connection.php';

//check for userupdate-submit
if (isset($_POST['video-update-submit'])) {

//assign variables to input, hash password and filter email
  $newvidname = $_POST['newvidname'];
  $newdesc = $_POST['newdesc'];
  $vidId = $_POST['vidId'];
  $newthemeid = $_POST['newthemeid'];

//check for empty fields
    if (empty($newvidname) || empty($newdesc)) {
      header("Location: ../output_files/my_videos.php?emptyFields");
      exit();
      //check that input only contains letters or/and numbers
    } elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $newvidname)) {
        header("Location: ../output_files/my_videos.php?error=NotValid");
        exit();
        //check that email is valid
    } else  {
      //check for sql error
    $sql = "SELECT videoName FROM videos WHERE videoName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../output_files/profile.php?error=sqlerror");
      exit();

    } else {
        //if all goes well, update video with new values
        $query = "UPDATE videos SET
        videoName='$newvidname', description='$newdesc', themefId='$newthemeid' WHERE videoId='$vidId'";
        $conn->query($query) or die($conn->error);

        header("Location: ../output_files/my_videos.php?update=success");

      }
    }
  }



//delete theme
if (isset($_POST['delete-theme-submit'])) {

$themeId = $_POST['themeId'];

$query = "DELETE FROM theme WHERE themeId='$themeId'";
$conn->query($query) or die('Query failed:' . $conn->error);
header("Location: ../output_files/my_videos.php?themeDelete=success");
exit();
}



//delete video
if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM videos WHERE videoId='$id'";
  $result = $conn->query($sql);
  header("Location: ../output_files/my_videos.php?delete=success");
  exit();
}

//delete theme
if (isset($_POST['delete-playlist-submit'])) {

$playId = $_POST['playId'];

$query = "DELETE FROM playlists WHERE playId='$playId'";
$conn->query($query) or die('Query failed:' . $conn->error);
header("Location: ../output_files/my_videos.php?themeDelete=success");
exit();
}
