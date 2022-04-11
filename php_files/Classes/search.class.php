<?php
// Search class connected to databse class
Class Search extends Dbh {
  //function that echos out a search bar
 public function search() {
// if search_submit button is clicked
    if (isset($_POST['search-submit'])) {
      //$search = lowercase  string of what was writen in search bar
      $search = strtolower($_POST['search']);

//if empty echo search field is empty
  if (empty($search)){
  echo "Search field is empty";
}else{  /* if $search is not empty send sql query to find likeness to $search*/
    $sql = "SELECT * FROM videos v, subjects s, theme t, users u, playlists p WHERE v.uId = s.teacherId AND v.themefId = t.themeId AND t.uId = p.uId AND t.themeId = p.themefId AND p.subjectfId = s.subjectId AND (v.videoName LIKE '%{$search}%' OR s.subjectName LIKE '%{$search}%' OR p.playName LIKE '%{$search}%' OR u.name LIKE '%{$search}%');";
    /*call the connect function from the Dbh class*/
    $result = $this->connect()->query($sql);
    /*$queryResult returns the number of rows in the result  from the sql query*/
    $queryResult = mysqli_num_rows($result);
   echo "You searched for: ".$search."<br> There are ".$queryResult." results.<br>";
   echo "<table border='1px'>
     <tr>
       <th>Search results: <th>
     </tr>";
     /*If the $queryResult is greater than 0 until each row returned from the sql has echoed a table row*/
        if($queryResult > 0){
            while ($row = mysqli_fetch_assoc($result)){
              echo "<tr><td>
              Video name: <a href='video_display.php?id=".$row['videoId']."'>".$row['videoName']."</a></br>Playlist name: <a href='playlist_display.php?id=".$row['playId']."'>".$row['playName']."</a></br>Teacher: ".$row['name']."</br>Subject: ".$row['subjectName']."</br>Theme: ".$row['themeName']."</td>
              <td></td></tr>";

             }
        }else{ /*if $queryResult empty then echo out "there were no results"*/
          echo "<tr><td>There were no results.</td></tr>";
        }
      }
      echo " </table>";
    }
    }


}
?>
