<?php
require 'db_connection.php';

if(isset($_POST['Psubmit'])){
//assign variables to input
$Puid = $_POST['Puid'];
$Pname = $_POST['Pname'];
$Pdescription = $_POST['Pdescription'];
$Psubject = $_POST['Psubject'];
$Ptheme = $_POST['Ptheme'];
$playdate = $_POST['playdate'];


//check for empty field
  if (empty($Pname)){
    header("Location: ../output_files/my_videos.php?error=emptyfield");
    $errormsg = "Empty field!";
    exit();
    //only allow characters, numbers and whitespace.
  }elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $Pname)) {
      header("Location: ../output_files/my_videos.php?error=NotValid");
      exit();
  }
   else {
    //check if topic already exist
   $sql = "SELECT playName FROM playlists WHERE playName='".$Pname."'";
   $result = $conn->query($sql);
   if($result->num_rows >= 1) {
     header("Location: ../output_files/my_videos.php?error=playlistAlreadyExist");
     exit();
   }
  else {

    //is all goes well, insert into table
	$query = "INSERT INTO playlists(playName, description, subjectfId, themefId, uId, entryDate) VALUES( '$Pname', '$Pdescription', '$Psubject','$Ptheme', '$Puid', '$playdate')";
	$conn->query($query) or die($conn->error);
	header("Location: ../output_files/my_videos.php?newPlaylist=success");
 }
}
}




if(isset($_POST['VPsubmit'])){
$PEplayId = $_POST['PEplayId'];
$PEvidoeId = $_POST['PEvidoeId'];

if (empty($PEvidoeId) || empty($PEplayId)){
  header("Location: ./output_files/my_videos.php?error=emptyfield");
  $errormsg = "Empty field!";
  exit();
  //only allow characters, numbers and whitespace.
}
else {
 //check if video already exist in playlist
	$sql = "SELECT VideoId, PlaylistId FROM playlistentries WHERE VideoId='".$PEvidoeId."' AND PlaylistId='".$PEplayId."'";
  $result = $conn->query($sql);
if($result->num_rows >= 1) {
  header("Location: ../output_files/my_videos.php?error=videoAlreadyExists");
  exit();
}
else {
  //if all goes well, insert into table
$query = "INSERT INTO playlistentries(PlaylistId, VideoId) VALUES( '$PEplayId', '$PEvidoeId')";
$conn->query($query) or die($conn->error);
header("Location: ../output_files/my_videos.php?newVideoAdded=success");

}
}
}
 ?>
