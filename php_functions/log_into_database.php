<?php
function log_into_database() {
  $servername = "************";
  $username = "************";
  $password = "***********";
  $dbname = "**********";

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else {
    return $conn;
  }  
}
 ?>
