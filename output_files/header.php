
<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="style/stylesheet.css?">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video System</title>
  </head>
  <body>

<header>

  <nav>
    <div class="navbar">
    <a href="index.php">Video System</a>



  <?php
  //check if user i logged in - then display:
      if (isset($_SESSION['loggedin'])) {
          echo '<form action="../php_files/logout.php" method="post">
            <button type="submit" name="logout-submit">Logout</button>
            </form>';

      echo '<a href="profile.php">My profile➦</a>';
      }

      //if user is not logged in - display:
      else {
            echo '<a href="register.php">Not a member yet? Signup➦</a>';


            echo '<h1>Login</h1>
      			<form action="../php_files/login.php" method="post">
      				<label for="email">
      				</label>
      				<input type="text" name="lmail" placeholder="E-mail" id="lmail" required>
      				</label>
      				<input type="password" name="password" placeholder="Password" id="password" required>
      				<input type="submit" value="Login">
      			</form>';
      }
   ?>
</nav>
</header>


  </body>
</html>
