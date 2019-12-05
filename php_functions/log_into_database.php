<?php
function log_into_database() {
  $servername = "mysqlsvr38.world4you.com";
  $username = "sql8774627";
  $password = "fb*wujt";
  $dbname = "7945756db1";

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
