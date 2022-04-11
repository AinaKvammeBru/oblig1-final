<?php

if (isset($_POST['register-submit'])) {
  require 'db_connection.php';

  $name = get_post('name', $conn);
  $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
  $teacher  = get_post('tId', $conn);


  if (empty($name) || empty($email) || empty($password)) {
    header("Location: ../output_files/index.php?error=emptyfields&uid=".$name."&mail=".$email);
    exit();
  } elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $name)) {
      header("Location: ../output_files/index.php?error=NotValidName");
      exit();
      //check that email is valid
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../output_files/index.php?error=NotValidEmail");
      exit();
  }
  else {
  $sql = "SELECT name FROM users WHERE name=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../output_files/index.php?error=sqlerror");
    exit();
  }
  else {
  $sql = "SELECT email FROM users WHERE email='".$email."'";
  $result = $conn->query($sql);
  if($result->num_rows >= 1) {
    header("Location: ../output_files/index.php?error=emailtaken");
    exit();
  }
  //check if user is teacher
    else if ((isset($_POST['teacher']) &&
      $_POST['teacher'] == 'Teacher')) {

      $conn->query("INSERT INTO users (name, email, pwd) VALUES ('$name', '$email', '$password')");
      $trequest = $conn->insert_id;
      $conn->query("INSERT INTO requests (uId) VALUES (".$trequest.")");
    	$conn->query($query) or die($conn->error);


      $sucess = "Thank you for joining us teacher";
      header("Location: ../output_files/index.php?sucess=".$sucess);

    }
    //if checkbox is not selected, student is deafult
    else {
      $query = "INSERT INTO users(name, email, pwd) VALUES('$name', '$email', '$password')";
    	 $conn->query($query) or die($conn->error);
       header("Location: ../output_files/index.php?sucess");
    }
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
