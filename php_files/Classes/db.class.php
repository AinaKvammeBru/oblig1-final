<?php
//class for connecting to the databse adapted from https://youtu.be/rcNYXc-hG_I and https://www.w3schools.com/php/php_mysql_connect.asp
class Dbh {
  private $servername;
  private $username;
  private $password;
  private $dbname;
//function for connecting to the databse adapted from https://youtu.be/rcNYXc-hG_I and https://www.w3schools.com/php/php_mysql_connect.asp
  protected function connect(){
    $this->servername="localhost";
    $this->username="root";
    $this->password="";
    $this->dbname="video_system_db";

    $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    return $conn;
    if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
  }
}
?>
