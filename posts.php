<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/posts.css">
    <link rel="stylesheet" href="./css/header.css">

    <title>Posts</title>

    <?php
      include './php_functions/log_into_database.php'
     ?>

  </head>
  <body>

    <div class="header">
      <a href="#default" class="logo">GRUMPF</a>
    <div class="header-right">
      <a href="./mainpage.php">Mainpage</a>
      <a href="./posts.php">Chat</a>
      <a href="nichts.html">Roadmap</a>
      <?php
        session_start();
        if (isset($_SESSION["logintoken"])) {
          echo "<a class='logout' href='./Register/logout.php'>Logout</a>";
        }
        else {
          echo "<a class='logout' href='./Register/login.php'>Login</a>";
        }
       ?>
     </div>
    </div>

  <div class="content">
    <form class="post_message" action="posts.php" method="post">
      <textarea class="message_field" rows="4" cols="50" name ="message"></textarea>
      <input type="submit" name="submit" value="Send message">
    </form>

    <?php
      $conn = log_into_database();

    if(isset($_POST["message"]) && !empty($_POST["message"])) {
      if (isset($_SESSION["logintoken"])) {

        $token = $_SESSION["logintoken"];
        $out_sql = "SELECT * FROM Userdata WHERE LoginToken = '$token'";
        $result = $conn->query($out_sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        }
        else {
          echo "No results!";
        }

        $user = $row["Username"];
        echo $row["Username"];
        $in_sql = "INSERT INTO Posts (User, Message)
        VALUES ('".$user."','".$_POST["message"]."')";

        if ($conn->query($in_sql) === TRUE) {
            echo "Message sent.";
            unset($_POST);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      }
      else {
        echo "You can't send messages, you are not logged in.";
      }
    }
  ?>

  <div class="message_body">
    <?php

    $servername = "mysqlsvr38.world4you.com";
    $username = "sql8774627";
    $password = "fb*wujt";
    $dbname = "7945756db1";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $out_sql = "SELECT * FROM Posts ORDER BY ID DESC LIMIT 20";
    $result = $conn->query($out_sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
       echo
       "<div class='message'>".
       $row["Timestamp"]. " - User: " . $row["User"]. "<br>" . $row["Message"].
       "<br>".
       "<img src='./Img/Like_Button.png'>".
       "</div>"
       ;
      }
    }
    else {
      echo "NO MESSAGES";
    }

    $conn->close();
     ?>
  </div>
</div>

  </body>
</html>
