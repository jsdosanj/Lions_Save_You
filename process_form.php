<?php
  // Handle login
  if (isset($_POST['signupForm'])) {
    // connect to database
    $conn = mysqli_connect("localhost", "<YOUR DATABASE USER>", "<YOUR DATABASE PASSWORD", "csi2520") or die("Database error: " . mysqli_error($conn));

    // first check to make sure nothing is blank
    $error_msg = "";  // output message to user and also our check for errors
    foreach ($_POST as $key=>$value) {
      if (empty($_POST[$key]))
        $error_msg = "All fields must be filled in!";
    }

    // No error found, pull in values
    if ($error_msg == "") {
      // Lightweight sanitization
      $fn  = mysqli_real_escape_string($conn, $_POST['firstName']);
      $ln  = mysqli_real_escape_string($conn, $_POST['lastName']);
      $un  = mysqli_real_escape_string($conn, $_POST['userName']);
      $em  = mysqli_real_escape_string($conn, $_POST['emailAddress']);
      $pw1 = mysqli_real_escape_string($conn, $_POST['password1']);
      $pw2 = mysqli_real_escape_string($conn, $_POST['password2']);
      
      // regular expressions
      if (!preg_match("/^[a-zA-Z ]+$/", $fn)) 
        $error_msg = "First name only can have letters/spaces";
      if (!preg_match("/^[a-zA-Z ]+$/", $ln)) 
        $error_msg = "Last name only can have letters/spaces";
      if (!filter_var($em, FILTER_VALIDATE_EMAIL))
        $error_msg = "Invalid email address"; 
      if ((strlen($pw1) < 6) || (strlen($pw1) > 50))
        $error_msg = "Invalid password length";
      if ($pw1 != $pw2)
        $error_msg = "Passwords don't match";
      
      if ($error_msg == "") { // no error found
        // Insert into database
        $query = "INSERT INTO tblUsers (username, first_name, last_name, email, password) VALUES('" . $un . "', '" . $fn . "', '" . $ln . "', '" . $em . "', '" . md5($pw1) . "')";
        echo $query; // debugging - check query

        // Perform insertion
        if (mysqli_query($conn, $query))
          echo "<h1>Successfully added $un to database!</h1>";
        else
          echo "<font color='red'>Error adding user.</font>";

      } else { // error in validation
        echo "<font color='red'>$error_msg</font>";
      }
    } else { // error in missing field data
        echo "<font color='red'>$error_msg</font>";
    }
  }
?>
