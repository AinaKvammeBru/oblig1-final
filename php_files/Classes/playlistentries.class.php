<?php
/*playlistentries class connected to databse class*/
class Playlistentries extends Dbh {

/*get the playlistentries from the database*/
  protected function getAllPlaylistEntries(){
  $sql= "SELECT *
            FROM playlists p
            JOIN playlistentries e ON p.playId = e.PlaylistId
            JOIN videos v ON v.videoId = e.VideoId
            ORDER BY p.playId;";
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
/*Function that uses the playlist entries obtained from getAllPlaylistEntries to return it in a table*/
  public function showAllEntries(){
    $datas= $this->getAllPlaylistEntries();
    if(is_array($datas)){/*if the data from getAllPlaylistEntries is an array echo the first half of the table*/
      echo "
      <h3>Playlist entries</h3>
      <table border='1px'>
      <tr>
      <th>Playlist Id</th>
      <th>Playlist Name</th>
      <th>Video Id</th>
      <th>Video Name</th>
      </tr>";
  foreach ($datas as $data) {/*For each row in playlistentries echo out playlistId, playlistname, videoId and videoname*/
    echo "<tr>
      <td>".$data['PlaylistId']."</td>
      <td>".$data['playName']."</td>
      <td>".$data['VideoId']."</td>
      <td>".$data['videoName']."</td>
    </tr>";
  }
}else{/*if the data from getAllPlaylistEntries is not array echo out the following statement "*/
  echo "there are no playlist entries in the database";
}
echo "</table>";
  }
/*get the playlists from the database*/
  protected function getPlaylists(){
    $Psql = "SELECT * FROM playlists";
    $resultlists = $this->connect()->query($Psql);
    $PnumRows = $resultlists->num_rows;

  if ($PnumRows>0) {
    while ($row=$resultlists->fetch_assoc()){
      $data[]=$row;
    }
    return $data;
  }  }
  /*A function that arranges the date from the getPlaylists function into a table*/
  public function showPlaylists(){
    $datas= $this->getPlaylists();
    if(is_array($datas)){
      echo "
      <h3>Playlists</h3><table border='1px'>
      <tr>
      <th>Playlist Id</th>
      <th>Playlist Name</th>
      <th>Playlist description</th>
      </tr>";
  foreach ($datas as $data) {/*each playlist row returns a playlist id, playlist name and a description*/
    echo "<tr>
      <td>".$data['playId']."</td>
      <td>".$data['playName']."</td>
      <td>".$data['description']."</td>
    </tr>";
  }
}else{
  echo "there are no playlists in the database";
}
echo "</table>";
  }

}


?>
