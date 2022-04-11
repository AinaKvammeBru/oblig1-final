<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}

$query = 'CREATE DATABASE IF NOT EXISTS video_system_db';
$conn->query($query) or die('Query failed:' . $conn->error);

$conn->select_db('video_system_db') or die('Can not select database:' . $conn->error);

//create tables with attributes
$query = "CREATE TABLE IF NOT EXISTS users(
userId int(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
pwd VARCHAR(255) NOT NULL,
userType enum('student','teacher', 'admin') NOT NULL
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS requests(
rId int(11) PRIMARY KEY AUTO_INCREMENT,
uId int(11) NOT NULL,
CONSTRAINT FK_ruId FOREIGN KEY (uId)
REFERENCES users(userId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);


$query = "CREATE TABLE IF NOT EXISTS theme(
themeId int(11) PRIMARY KEY AUTO_INCREMENT,
themeName VARCHAR(255) NOT NULL,
uId int(11) NOT NULL,
CONSTRAINT FK_tuId FOREIGN KEY (uId)
REFERENCES users(userId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);


$query = "CREATE TABLE IF NOT EXISTS videos(
videoId int(11) PRIMARY KEY AUTO_INCREMENT,
videoName VARCHAR(50) NOT NULL,
description VARCHAR(255) NOT NULL,
thumnail VARCHAR(50),
videoDate date,
uId int(11),
themefId int(11),
content LONGBLOB NOT NULL,
mime VARCHAR(128) NOT NULL,
size INT(11) NOT NULL,
CONSTRAINT FK_videouserId FOREIGN KEY (uId)
REFERENCES users(userId),
CONSTRAINT FK_themeuserId FOREIGN KEY (themefId)
REFERENCES theme(themeId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);
$query = "CREATE TABLE IF NOT EXISTS subjects(
subjectId int(11) PRIMARY KEY AUTO_INCREMENT,
subjectName VARCHAR(60) NOT NULL,
description VARCHAR(255) NOT NULL,
teacherId INT(11) NOT NULL,
CONSTRAINT FK_teacherId FOREIGN KEY (teacherId)
REFERENCES users(userId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);



$query = "CREATE TABLE IF NOT EXISTS playlists(
playId int(11) PRIMARY KEY AUTO_INCREMENT,
playName VARCHAR(255) NOT NULL,
description VARCHAR(255) NOT NULL,
subjectfId INT(11) NOT NULL,
uId int(11) NOT NULL,
themefId int(11),
entryDate date,
CONSTRAINT FK_uId FOREIGN KEY (uId)
REFERENCES users(userId),
CONSTRAINT FK_subjectfId FOREIGN KEY (subjectfId)
REFERENCES subjects(subjectId),
CONSTRAINT FK_themepId FOREIGN KEY (themefId)
REFERENCES theme(themeId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS playlistentries (
PlaylistId INT(11) NOT NULL,
VideoId INT(11) NOT NULL,
CONSTRAINT PK_playlistentries PRIMARY KEY (PlaylistId,VideoId),
FOREIGN KEY (VideoId) REFERENCES videos(VideoId),
FOREIGN KEY (PlaylistId) REFERENCES playlists(PlayId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS subscribes (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
pId INT(11) NOT NULL,
uId INT(11) NOT NULL,
CONSTRAINT FK_playlistid FOREIGN KEY (pId)
REFERENCES playlists(playId),
CONSTRAINT FK_subuserId FOREIGN KEY (uId)
REFERENCES users(userId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS comments(
commentId int(11) PRIMARY KEY AUTO_INCREMENT,
uId int(11) NOT NULL,
vId int(11) NOT NULL,
cdate DATE,
comment VARCHAR(255) NOT NULL,
CONSTRAINT FK_cuId FOREIGN KEY (uId)
REFERENCES users(userId),
CONSTRAINT FK_cvId FOREIGN KEY (vId)
REFERENCES videos(videoId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS rating(
ratingId int(11) PRIMARY KEY AUTO_INCREMENT,
vId int(11) NOT NULL,
rating int(11),
CONSTRAINT FK_ratingvId FOREIGN KEY (vId)
REFERENCES videos(videoId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);

$query = "CREATE TABLE IF NOT EXISTS likes(
likeId int(11) PRIMARY KEY AUTO_INCREMENT,
vId int(11) NOT NULL,
uId int(11),
CONSTRAINT FK_luId FOREIGN KEY (uId)
REFERENCES users(userId),
CONSTRAINT FK_likevId FOREIGN KEY (vId)
REFERENCES videos(videoId)
)";
$conn->query($query) or die('Query failed:' . $conn->error);


//registrer a user and then set that user to admin
$query = "UPDATE users SET userType = 'admin' WHERE userId=1";
$conn->query($query) or die('Query failed:' . $conn->error);
?>
