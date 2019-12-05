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

    <title>Login</title>
  </head>
  <body>

    <?php
    print_header();
     ?>

    <form class="main" action="login.php" method="post">
      <input type="text" name="username" value="">
      <input type="password" name="password" value="">
      <input type="submit" name="submit" value="Login">
    </form>

<?php
  session_start();
  $conn = log_into_database();

  //If user is already logged in, send him to the mainpage
  if(isset($_SESSION["logintoken"])) {
    header("LOCATION: ./../mainpage.php");
  }

//Test if there is a user
if(isset($_POST["username"]) && !empty($_POST["username"])) {
  //Get result for posted Username
  $username = $_POST["username"];
  $sql = "SELECT * FROM Userdata WHERE Username = '$username'";
  $result = $conn->query($sql);
  //Test if there is more than 0 results for the given username
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  }
  else {
    //There is no User with that name
    echo "This user doesen't exits.";
  }

  //Test if username in the database matches the username in the form
  //then test if the sha256 hast of the password in the form matches the hast in the database
  if ($_POST["username"] == $row["Username"] && hash("sha256", $_POST["password"]) == $row["Password"]) {
    //generate login token with time, nonce and username
    $token = hash("sha256", time() . rand(1, 100) . $_POST["username"]);
    //Set Logintoken in the database to the new generated tokens
    $username = $_POST["username"];
    $token_sql = "UPDATE `Userdata` SET `LoginToken` = '$token' WHERE `Username` = '$username' ";

    //If everything worked the user gets transfered to the mainpage
    if ($conn->query($token_sql) === TRUE) {
      $_SESSION["logintoken"] = $token;
      header("LOCATION: ./../mainpage.php");
    }
    else {

      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  else {
    echo "Wrong Password.";
  }
}
  //Close Database Connection
  $conn->close();
 ?>
</body>
</html>
