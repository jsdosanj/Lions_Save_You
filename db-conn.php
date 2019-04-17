<?php
  // $conn will be available after this script is included
  //                     server       username      password     database
  $conn = mysqli_connect("localhost", "fredericks", "T3mp12345", "csi2520") or die("Database error: " . mysqli_error($conn));
  $conn = mysqli_connect("localhost", "jsdosanjh", "password", "csi2520") or die("Database error: " . mysqli_error($conn));
?>