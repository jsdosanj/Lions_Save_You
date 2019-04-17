<?php
 // Handle signup
 if (isset($_POST['signupForm'])) {
 // connect to database
 $conn = mysqli_connect("localhost", "jsdosanjh", "password", "csi2520") or die("Database error: " . mysqli_error($conn));
 // first check to make sure nothing is blank
 $error_msg = ""; // output message to user and also our check for errors
 foreach ($_POST as $key=>$value) {
 if (empty($_POST[$key]))
 $error_msg = "All fields must be filled in!";
 }
 // No error found, pull in values
 if ($error_msg == "") {
 // Lightweight sanitization
 $fn = mysqli_real_escape_string($conn, $_POST['first_name']);
 $ln = mysqli_real_escape_string($conn, $_POST['last_name']);
 $un = mysqli_real_escape_string($conn, $_POST['username']);
 $em = mysqli_real_escape_string($conn, $_POST['email']);
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
 $query = "INSERT INTO tblUsers (username, first_name, last_name, email,
password) VALUES('" . $un . "', '" . $fn . "', '" . $ln . "', '" . $em . "', '" .
md5($pw1) . "')";
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
 }else{
	 echo"User Login";
//get Database connection
	 include("db_connect.php"); //Same as code below, You dont need
$conn = mysqli_connect("localhost", "trevor", "PasswordForServer", "csi2520") or die("Database error: " . mysqli_error($conn));
//Check Inputs
	$un  = mysqli_real_escape_string($conn, $_POST['username2']);
	 $pw  = mysqli_real_escape_string($conn, $_POST['password']);
//select User
	 $q = "SELECT * FROM tblUsers WHERE username = '$un'";
	 echo "<br>$q";

	 $res = mysqli_query($conn, $q);
	  if ($res->num_rows > 0) { // Username found
      $user = mysqli_fetch_array($res);
      echo "<br>User found! - [" . $user['username'] . "]";

       // Check password
      if (md5($_POST['password']) == $user['password']) { // login successful
	      echo "<h2>Welcome $un!</h2>";

	              // Set session vars
        $_SESSION['logged_in']  = TRUE;
        $_SESSION['username']   = $un;
        $_SESSION['first_name'] = $user['first_name'];
	$_SESSION['last_name']  = $user['last_name'];
	 } else { // password doesn't match
        echo "<h2>Error logging in!</h2>";
        session_destroy();
      }
	echo "<br><a href='tkehome.html'>Click me to move on</a>";
       } else { // username not found
      echo "User not found!";
    }
  }
?>