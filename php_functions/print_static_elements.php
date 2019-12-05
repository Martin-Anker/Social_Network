<?php
function print_header() {
  echo '<div class="header">
    <a href="#default" class="logo">GRUMPF</a>
  <div class="header-right">
    <a href="./..//mainpage.php">Mainpage</a>
    <a href="./../posts.php">Chat</a>
    <a href="./../nichts.html">Roadmap</a>';

      if (isset($_SESSION["logintoken"])) {
        echo "<a class='logout' href='./logout.php'>Logout</a>";
      }
      else {
        echo "<a class='logout' href='./login.php'>Login</a>";
      }
    echo '
   </div>
  </div>';
}
 ?>
