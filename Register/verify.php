<?php
  include './../php_functions/log_into_database.php';

  //Test if a token is send with the link (user clicked on verification link)
  if (isset($_GET["token"])) {
    //Log into the database
    $conn = log_into_database();

    $token = $_GET["token"];
    //Grab rows with the correct registertoken
    $find_token_sql = "SELECT * FROM Userdata WHERE `RegisterToken` = '$token' ";

    $result = $conn->query($find_token_sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }
    else {
      //Wrong Registertoken or user not found
      echo "No results";
    }

    //Test again if token in the link equals the Register Token in database
    if ($_GET["token"] == $row["RegisterToken"]) {
      //Set IsVerified to 1 if its true, use === instead of == to prevent type juggling problem
      $verify_sql = "UPDATE `Userdata` SET `IsVerified` = '1' WHERE `RegisterToken` = '$token' ";
      if ($conn->query($verify_sql) === TRUE) {
        //It worked, redirect to loginpage
        header("LOCATION: ./login.php");
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    else {
      //No user matches the token, or maybe there were 2 users with the same token?
      echo "Unexpected Error";
    }
  }
 ?>
