<?php
  include('db-conn.php');

  $q = "SELECT * FROM tblUsers";
  $result = mysqli_query($conn, $q);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo $row['username'] . "<br>";
    }
  }
?>