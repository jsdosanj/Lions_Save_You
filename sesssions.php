<?php
  session_start();

  if ($_SESSION['logged_in'] == TRUE) {
    echo "<h1>WELCOME TO THE LOGGED IN PORTION OF THE SITE WOOOOOOO";
    echo "<img src='https://media1.giphy.com/media/FXo3Din7pWybK/giphy.gif' />";
  } else {
    echo "<font color='red'>Error, you are not logged in!</font>";
  }

  //echo "By the way, your cookie name is " . $_COOKIE['first_name'];

  session_destroy(); // destroy the session automatically -- refresh page to see what happens
?>