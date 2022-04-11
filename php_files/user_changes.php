<?php

require 'db_connection.php';

//check for userupdate-submit
if (isset($_POST['update-submit'])) {

//assign variables to input, hash password and filter email
  $newname = $_POST['newname'];
  $newemail = $_POST['newmail'];
  $newpassword = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
  $thisUI = $_POST['thisUI'];

//check for empty fields
    if (empty($newname) || empty($newemail) || empty($newpassword)) {
      header("Location: ../output_files/profile.php?emptyFields");
      exit();
      //check that input only contains letters or/and numbers
    } elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $newname)) {
        header("Location: ../output_files/profile.php?error=NotValid");
        exit();
        //check that email is valid
    } elseif (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../output_files/profile.php?error=NotValid");
        exit();
    } else {
      //check if wanted username already exists
     $sql = "SELECT email FROM users WHERE email='".$newemail."'";
     $result = $conn->query($sql);
     if($result->num_rows >= 1) {
       header("Location: ../output_files/profile.php?error=EmailTaken");
       exit();
     }
    else {
      //check for sql error
    $sql = "SELECT name FROM users WHERE name=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../output_files/profile.php?error=sqlerror");
      exit();
    }
      else {
        //if all goes well, update user to new values
        $query = "UPDATE users SET
        name='$newname', email='$newemail', pwd='$newpassword' WHERE userId='$thisUI'";
        $conn->query($query) or die($conn->error);

        header("Location: ../output_files/profile.php?update=success");

      }
    }
  }
}





if (isset($_POST['make_teacher_submit'])) {

$uid = $_POST['userId'];

$sql = "UPDATE users SET userType = 'teacher' WHERE userId='$uid'";

if ($conn->query($sql) === TRUE) {
  $conn->query("DELETE FROM requests WHERE uId='$uid'");
  $conn->query($query) or die($conn->error);
  header("Location: ../output_files/admin.php?update=success");
} else {
    echo "Error deleting record: " . $conn->error;
}
}



//delete user - (admin rights)
if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM users WHERE userId='$id'";
  $result = $conn->query($sql);
  header("Location: ../output_files/admin.php?delete=success");
  exit();
}

//update users to admin - (admin rights)
if (isset($_POST['makeadmin-submit'])) {

$uid = $_POST['userId'];

$query = "UPDATE users SET userType = 'admin' WHERE userId='$uid'";
$conn->query($query) or die('Query failed:' . $conn->error);
header("Location: ../output_files/admin.php?update=success");
exit();
}

//Decline teacher requests
if (isset($_POST['decline_teacher_submit'])) {

$ruid = $_POST['duserId'];

$query = "DELETE FROM requests WHERE uId='$ruid'";
$conn->query($query) or die('Query failed:' . $conn->error);
header("Location: ../output_files/admin.php?update=success");
exit();
}
 ?>
