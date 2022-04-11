<?php
require 'db_connection.php';

if(isset($_POST['Subsubmit'])){
//assign variables to input
$teacherid = $_POST['teacherid'];
$subname = $_POST['subname'];
$subdescription = $_POST['subdescription'];


//check for empty field
	  if (empty($subname) || empty($subdescription)){
    header("Location: ../output_files/admin.php?error=emptyfield");
    $errormsg = "Empty field!";
    exit();
    //only allow characters, numbers and whitespace.
  }elseif (!preg_match("/^[a-zA-Z0-9-\s]*$/", $subname)) {
      header("Location: ../output_files/admin.php?error=NotValid");
      exit();
  }
   else {
    //check if topic already exist
   $sql = "SELECT subjectName FROM subjects WHERE subjectName='".$subname."'";
   $result = $conn->query($sql);
   if($result->num_rows >= 1) {
     header("Location: ../output_files/admin.php?error=subjectAlreadyExist");
     exit();
   }
  else {

    //is all goes well, insert into table
	$query = "INSERT INTO subjects(subjectName, description, teacherId) VALUES( '$subname', '$subdescription', '$teacherid')";
	$conn->query($query) or die($conn->error);
	header("Location: ../output_files/admin.php?newSubject=success");
 }
}
}
//delete subject - (admin rights)
if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM subjects WHERE subjectId='$id'";
  $result = $conn->query($sql);
  header("Location: ../output_files/admin.php?delete=success");
  exit();
}


 ?>
