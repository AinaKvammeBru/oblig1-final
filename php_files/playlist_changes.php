<?php
require 'db_connection.php';

//delete video
if (isset($_POST['remove-video-submit'])) {

$vid = $_POST['vId'];
$pid = $_POST['pId'];

$query = "DELETE FROM playlistentries WHERE videoId='$vid'";
$conn->query($query) or die('Query failed:' . $conn->error);
header('Location: ../output_files/edit_playlist.php?id=' . $pid . ' ');
exit();
}
