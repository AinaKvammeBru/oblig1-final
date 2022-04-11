<?php

class Subscribes extends Dbh {
//get the data from the database
  protected function getAllSubscribes(){
  $sql= "SELECT subscribes.id, subscribes.pId, playlists.playName, playlists.description, users.name, subjects.subjectName, theme.themeName
FROM subscribes
INNER JOIN playlists ON playlists.playId = subscribes.pId
INNER JOIN users ON users.userId = subscribes.uId
INNER JOIN subjects ON subjects.subjectId = playlists.subjectfId
INNER JOIN theme ON theme.themeId = playlists.themefId
WHERE subscribes.uId = '".$_SESSION['id']."'";
  $result= $this->connect()->query($sql);
  $numRows = $result->num_rows;
  if ($numRows>0) {
    while ($row=$result->fetch_assoc()){
      $data[]=$row;
    }
    return $data;
  }
  }



//display subscribes
  public function showAllSubscribes(){
    $datas= $this->getAllSubscribes();
    if(is_array($datas)){

  foreach ($datas as $data) {
    echo "<br/><h4>Playlist: ".$data['playName']."</h4>";
    echo "Description: ".$data['description']."<br/>";
    echo "Teacher: ".$data['name']."<br/>";
    echo "Subject: ".$data['subjectName']."<br/>";
    echo "Theme: ".$data['themeName']."<br/>";
    echo'
    <a href="playlist_display.php?id=' . $data['pId'] . '">Watch this playlist</a>'. "<br>";
  }
}else{
  echo "You havent subscribed to any playlists yet";
}
  }

}


?>
