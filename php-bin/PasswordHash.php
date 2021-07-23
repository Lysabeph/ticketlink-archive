<?php


function passwordHash()
{
  // User password input
  $userpassword = $_POST['password'];

  // Password hash
  $hashedPwd = password_hash(userpassword, PASSWORD_DEFAULT, ['cost' => 11]);

  // Check if input is equal to hash
  if(password_verify($userpassword, $hashedPwd))
  {
    echo 'Valid password!';
  }
  else
  {
    echo 'Invalid password!';
  }

}

?>