<?php

// Get info
require_once "ConnectToDatabase.php";

// Session Management Functions
require_once "SessionFunctions.php";

if ($_POST)
{
  // If user is already logged in, go to the profile page
  if (check_user_logged_in()) {
    header("Location: ../profile.php");
  }

  $conn = openConnectionToDatabase();
  
  $email = $_POST['email'];
  $password = $_POST['pass'];

  // TODO : Password needs hashing
  $hashed_password = $password;

  // Get user from login details
  // Test 1 : Using Email
  $query = "SELECT * FROM `users` WHERE `Email`='" . $email . "' AND `LoginHash`='" . $hashed_password . "'";

  if ($result = $conn->query($query))
  {
    if ($user = $result->fetch_assoc()) {
      create_session($user['UserID']);
      echo "Logged in as " .$user['Username'];
      header("Location: ../profile.php");
    } else {
      // Test 2 : Using Username
      $query = "SELECT * FROM `users` WHERE `Username`='" . $email . "' AND `LoginHash`='" . $hashed_password . "'";

      if ($result = $conn->query($query))
      {
        if ($user = $result->fetch_assoc()) {
          create_session($user['UserID']);
          echo "Logged in as " .$user['Username'];
          header("Location: ../profile.php");
        } else {
          echo "Wrong details";
          header("Location: ../login.php");
        }
      } 
    }
  } 
} else {
  header("Location: ../login.php");
}

?>
