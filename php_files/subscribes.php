<?php
require 'db_connection.php';
if (isset($_POST['subscribe-submit'])) {

  $uId = $_POST['uId'];
  $pid = $_POST['pid'];

  $sql = "SELECT uId FROM subscribes WHERE pId='".$pid."' AND uId='".$uId."'";
  $result = $conn->query($sql);
  if($result->num_rows >= 1) {
    header('Location: ../output_files/playlist_display.php?id=' . $pid . ' ');
    exit();
  }
    else {
      $query = "INSERT INTO subscribes(pId, uId) VALUES('$pid', '$uId')";
    	 $conn->query($query) or die($conn->error);
       header('Location: ../output_files/playlist_display.php?id=' . $pid . ' ');
    }
  }

  if (isset($_POST['unsubscribe-submit'])) {

  $uId = $_POST['uId'];
  $pid = $_POST['pid'];

  $query = "DELETE FROM subscribes WHERE pId='".$pid."' AND uId='".$uId."'";
  $conn->query($query) or die('Query failed:' . $conn->error);
  header('Location: ../output_files/playlist_display.php?id=' . $pid . ' ');
  exit();
  }
