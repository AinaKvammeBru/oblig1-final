<?php
include "db_connection.php";

if(isset($_POST['button1'])) {
  $vId = $_POST['vId'];
  $rating = $_POST['button1'];
  $query = "INSERT INTO rating(vId, rating) VALUES('$vId', '$rating')";
  $conn->query($query) or die($conn->error);
  header('Location: ../output_files/video_display.php?id=' . $vId . ' ');
}

if(isset($_POST['button2'])) {
  $vId = $_POST['vId'];
  $rating = $_POST['button2'];
  $query = "INSERT INTO rating(vId, rating) VALUES('$vId', '$rating')";
  $conn->query($query) or die($conn->error);
  header('Location: ../output_files/video_display.php?id=' . $vId . ' ');
}

if(isset($_POST['button3'])) {
  $vId = $_POST['vId'];
  $rating = $_POST['button3'];
  $query = "INSERT INTO rating(vId, rating) VALUES('$vId', '$rating')";
  $conn->query($query) or die($conn->error);
  header('Location: ../output_files/video_display.php?id=' . $vId . ' ');
}

if(isset($_POST['button4'])) {
  $vId = $_POST['vId'];
  $rating = $_POST['button4'];
  $query = "INSERT INTO rating(vId, rating) VALUES('$vId', '$rating')";
  $conn->query($query) or die($conn->error);
  header('Location: ../output_files/video_display.php?id=' . $vId . ' ');
}

if(isset($_POST['button5'])) {
  $vId = $_POST['vId'];
  $rating = $_POST['button5'];
  $query = "INSERT INTO rating(vId, rating) VALUES('$vId', '$rating')";
  $conn->query($query) or die($conn->error);
  header('Location: ../output_files/video_display.php?id=' . $vId . ' ');
}





//likes

if(isset($_POST['Like-submit'])){
//assign variables to input
  $vId = $_POST['vId'];
  $uId = $_POST['uId'];


    //is all goes well, insert into table
	$query = "INSERT INTO likes(vId, uId) VALUES( '$vId', '$uId')";
	$conn->query($query) or die($conn->error);
	header('Location: ../output_files/video_display.php?id=' . $vId . ' ');

}


 ?>
