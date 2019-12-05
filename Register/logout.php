<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <?php
    session_start();
    include './../php_functions/log_into_database.php';
    include './../php_functions/print_static_elements.php';
    ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../css/Register/header.css">
    <link rel="stylesheet" href="./../css/Register/login.css">

    <title>Logout</title>
  </head>

  <body>

  </body>
</html>

<?php

$conn = log_into_database();

//Test if an logintoken is set
if(isset($_SESSION["logintoken"])) {
  $token = $_SESSION["logintoken"];
  //Unset the token in the database
  $unset_sql = "UPDATE `Userdata` SET `LoginToken` = NULL WHERE LoginToken = '$token' ";

  if ($conn->query($unset_sql) === TRUE) {
    //Unset token from user
    unset($_SESSION["logintoken"]);
    //Print header after the logout process, but befor other text
    print_header();
    echo "Sie wurden ausgeloggt.";
  }
  else {
    //SQL Error, maybe the token from the user was incorrect or there is no token in the databse?
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
else {
  //There was no token passed from the user
  echo "You are not logged in.";
}

 ?>
