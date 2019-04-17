<?php
session_start(); // start session

$_SESSION['days_left'] = 2;
echo "<h1>There are: " . $_SESSION['days_left'] . " days left</h1>";
echo "<a href='session2.php?days=1'>make 1 day left</a>";
?>