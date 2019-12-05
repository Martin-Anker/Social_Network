<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <?php
    session_start();
    include './../php_functions.log_into_database.php';
    ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/register.css">
    <title>Registrierung</title>
  </head>
  <body class="bg-img">
    <div class="container">
      <form class="main_form" action="register.php" method="post">

        <label for="username"><b>Username</b></label>
        <input type="text" name="username" value="" required>

        <label for="email"><b>E-Mail</b></label>
        <input type="email" name="email" value="" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" value="" required>

        <input class="btn" type="submit" name="submit" value="Registrieren">
      </form>
      <br>
      <a class ="login_link" href="./login.php">Du hast schon einen Account?</a>
    </div>
  </body>
</html>

<?php
if (isset($_POST["username"]) && !empty($_POST["username"])) {
  $conn = log_into_database();

  $registertoken = hash("sha256", time() . $_POST["username"]);
  $password_hashed = hash("sha256", $_POST["password"]);
  $sql = "INSERT INTO Userdata (Username, Email, Password, RegisterToken)
  VALUES ('".$_POST["username"]."','".$_POST["email"]."','".$password_hashed."','".$registertoken."')";
  if ($conn->query($sql) === TRUE) {
      mail ( $_POST["email"] , "Register Account" ,
      "Click on this link to verify your account: " . "http://www.grumpf.at/Social_Network/Register/verify.php?token=" . $registertoken);

    header("LOCATION: ./email_sent.php");
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

}
?>
