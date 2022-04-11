<?php
include 'db_connection.php';

if (isset($_POST['admin-delete-theme-submit'])) {

$themeId = $_POST['themeId'];

$query = "DELETE FROM theme WHERE themeId='$themeId'";
$conn->query($query) or die('Query failed:' . $conn->error);
header("Location: ../output_files/admin_themes_videos.php?update=success");
exit();
}


//delete video
if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM videos WHERE videoId='$id'";
  $result = $conn->query($sql);
  header("Location: ../output_files/admin_themes_videos.php?delete=success");
  exit();
}
