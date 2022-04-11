<?php

Class SubjectButton extends Dbh {
 public function subject() {

    if (isset($_POST['sname'])) {
      $sId = $_POST['svalue'];


     $sql = "SELECT * FROM subjects WHERE subjectId='$sId'";
     $result = $this->connect()->query($sql);
     $queryResult = mysqli_num_rows($result);
     if($queryResult > 0){
         while ($row = mysqli_fetch_assoc($result)){
         echo $row['subjectName'];
     }
   }
  }
 }
}
?>
