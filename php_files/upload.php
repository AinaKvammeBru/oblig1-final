<?php
require 'db_connection.php';
/*gets the form information from my_videos adapted from https://youtu.be/JaRq73y5MJk and https://www.codexworld.com/upload-store-image-file-in-database-using-php-mysql/*/
if (isset($_POST['video-submit'])) {
/*the variables unerneath takes the content filled in from the form with the video_submit if it is clicked and asigns it to a variable*/
    $content = $_FILES['content'];
    $description = $_POST['description'];
    $size = $_FILES['content']['size'];
    $filename = $_FILES['content']['name'];
    $fileerror = $_FILES['content']['error'];
    $filesize = $_FILES['content']['size'];
    $name = $_POST["new-name"];
    $vuId = $_POST['videouId'];
    $theme = $_POST['themeid'];
    $date = $_POST['vdate'];
    /*$type takes the pathinfo from the filename variable and finds the file extension*/
    $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    /*$allow is an array with the file extensions that are allowed for the video file*/
    $allow = array('avi', 'mp4');

if (!empty($content) || !empty($description) || !empty($name) ||!empty($theme)){/*if none of these variables are empty continue*/
    if (in_array( $type, $allow)) {/*if the file type is in the allowed array it can continue*/
      if($fileerror ===0){/*if there was no error uploading the file continue*/
          if ($filesize<20000000000) {/*if the file size is not above the allowed limit continue*/
              header("Location: ../output_files/my_videos.php?uploadsuccess");
              /*push the variables into the database with an sql query*/
              $query = "INSERT INTO videos(videoName, description, videoDate, uId, themefId, content, mime, size) VALUES ('$name', '$description','$date', '$vuId', '$theme', '$content', '$type', '$filesize');";
              $conn->query($query) or die('Query failed:' . $conn->error);

      }else{/*if the file size was to big change header to inform user*/
        /*if there was an error update the header to infrom the user there was an error*/
        header("Location: ../output_files/my_videos.php?erroruploadignfile");
      }
    }else{/*if there was an error update the header to infrom the user there was an error*/
      header("Location: index.php?wrongfiletype");
    }
}
}
else {/*if the file type was not in the $allow array update header to inform user*/
   header("Location: ../output_files/my_videos.php?wrongfiletype");
}
}
?>
