<?php
class Videos extends Dbh {
//get all videos from the database
  protected function getAllvideos(){
  $sql= "SELECT * FROM videos";
  /*call the connect function from the Dbh class*/
  $result= $this->connect()->query($sql);
  $numRows = $result->num_rows;
  if ($numRows>0) {
    while ($row=$result->fetch_assoc()){
      $data[]=$row;
    }
    return $data;
  }
  }
  //Echo out the video data from getAllvideos
  public function showAllvideos(){
    $datas= $this->getAllvideos();
    if(is_array($datas)){
  foreach ($datas as $data) {
    echo "<br/>Video Id: ".$data['videoId']."<br/>";
    echo "Video name: ".$data['videoName']."<br/>";
    echo "Teacher: ".$data['uId']."<br/>";
    echo "Video description: ".$data['description']."<br/>";
    echo "Video date: ".$data['videoDate']."<br/>";
    echo'<a href="video_display.php?id=' . $data['videoId'] . '">Click</a>'. "<br>";

  }
}else{//if there is nothing in the databse return echo out the following statement:
  echo "there are no videos in the database";
}
  }

  // function to show all videoes for admins and option for deleting
   function AdminshowAllvideos(){
    $datas= $this->getAllvideos();
    if(is_array($datas)){
  foreach ($datas as $data) {
    echo "<br/>Video Id: ".$data['videoId']."<br/>";
    echo "Video name: ".$data['videoName']."<br/>";
    echo "Teacher: ".$data['uId']."<br/>";
    echo "Video description: ".$data['description']."<br/>";
    echo "Video date: ".$data['videoDate']."<br/>";
    echo'<a class="delete-video" href="../php_files/admin_changes.php?id=' . $data['videoId'] . '">Delete</a>'. "<br>";

  }
  }else{
  echo "there are no videos in the database";
  }
  }


}

?>
