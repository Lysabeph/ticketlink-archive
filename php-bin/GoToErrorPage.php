<?php


// Redirects the user to an error page.
function error($msg)
{
  header("Location: error.html?" . $msg);
  die();
} // End function: error


?>
