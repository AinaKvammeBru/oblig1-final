<?php
include 'header.php';
include '../php_files/db_connection.php';
include '../php_files/Classes/db.class.php';
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
    //check if user i logged in - then display:
        if (isset($_SESSION['loggedin'])) {
            echo '<p>Welcome '.$name.'</p>';

            //search form
            echo '<h3>Search for videos and playlists</h3>
            <form method="post" enctype="multipart/form-data">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" name="search-submit">Search</button>
            </form>';
//if user uses search button display search results
if (isset($_POST['search-submit'])) {
  $search = new Search();
//else display subscribes
} else {
  echo '<h3>Your subscriptions:</h3>';
  $subscribes = new Subscribes();
  $subscribes->showAllSubscribes();
}
  }      //if user is not logged in - display:
        else {
          include "register.php";
          echo '<div class="content">
            <h2>Hello</h2>
            <p>To see this content, you need to log in with your account, or sign up!</p>
          </div>';
        }
     ?>
  </body>
</html>
