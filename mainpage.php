<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/mainpage.css">
    <title>Mainpage</title>
    <?php
      session_start();
      if(!isset($_SESSION["logintoken"])) {
        header("LOCATION: ./Register/login.php");
      }

      $servername = "mysqlsvr38.world4you.com";
      $username = "sql8774627";
      $password = "fb*wujt";
      $dbname = "7945756db1";

      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

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

    <h1><?php
    $token = $_SESSION["logintoken"];
    $out_sql = "SELECT * FROM Userdata WHERE LoginToken = '$token'";
    $result = $conn->query($out_sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    }
    else {
      echo "You are not logged in.";
    }
    echo "Hallo " . $row["Username"]; ?></h1>

    <a href="./Register/logout.php">Logout</a>
    <a href="./posts.php">Chat</a>

  </body>
</html>
