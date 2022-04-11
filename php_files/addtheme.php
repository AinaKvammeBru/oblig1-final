<?php
require 'db_connection.php';

if(isset($_POST['theme-submit'])){
//assign variables to input
$themeName = $_POST['themeName'];
$uId = $_POST['themeId'];

//check for empty field
  if (empty($themeName)){
    header("Location: ../output_files/my_videos.php?error=emptyfield");
    $errormsg = "Empty field!";
    exit();
    //only allow characters, numbers and whitespace.
  }elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $themeName)) {
      header("Location: ../output_files/my_videos.php?error=NotValid");
      exit();
  }
   else {
    //check if topic already exist
   $sql = "SELECT themeName FROM theme WHERE themeName='".$themeName."'";
   $result = $conn->query($sql);
   if($result->num_rows >= 1) {
     header("Location: ../output_files/my_videos.php?error=themeAlreadyExist");
     exit();
   }
  else {

    //is all goes well, insert into table
	$query = "INSERT INTO theme(themeName, uId) VALUES( '$themeName', '$uId')";
	$conn->query($query) or die($conn->error);
	header("Location: ../output_files/my_videos.php?newTheme=success");
 }
}
}




//comment submit
if(isset($_POST['comment-submit'])){
//assign variables to input
  $user = $_POST['uId'];
  $date = $_POST['cdate'];
  $comment = $_POST['comment'];
  $video = $_POST['vId'];



  if (empty($comment)) {
    header('Location: ../output_files/video_display.php?id=' . $video . ' emptyfields');
    exit();
  }
  else {
  $sql = "SELECT comment FROM comments WHERE comment=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('Location: ../output_files/video_display.php?id=' . $video . ' sqlError');
    exit();
  }
    else {
      $query = "INSERT INTO comments(uId, cdate, comment, vId) VALUES('$user', '$date', '$comment', '$video')";
       $conn->query($query) or die($conn->error);
       header('Location: ../output_files/video_display.php?id=' . $video . ' ');
    }
  }
}

function get_post($var, $conn){
	$var = stripslashes($_POST[$var]);
	$var = htmlentities($var);
	$var = strip_tags($var);
	$var = $conn->real_escape_string($var);

	return $var;
}
