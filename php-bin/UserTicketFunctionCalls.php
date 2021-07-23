<!DOCTYPE html>
<html>
<head>

<?php

require_once "ConnectToDatabase.php";
require_once "GoToErrorPage.php";
require_once "IDGenerator.php";
require_once "TicketFunctions.php";
require_once "UserFunctions.php";


// Calls the function stored in functionName after checking its arguments have
// been POSTed and assigning them to array elements.
function callFunction($arguments)
{
  global $functionName;

  // Checks all the args have a POSTed value.
  for($argumentIndex = 0; $argumentIndex < count($arguments);
          $argumentIndex++)
  {
    if (isset($_POST[$arguments[$argumentIndex]]))
    {
      $arguments[$argumentIndex] = htmlspecialchars(
                                     $_POST[$arguments[$argumentIndex]]);
    } // End if: $args
    else
    {
      error("Missing-argument-<" . $arguments[$argumentIndex] . ">");
    } // End else
  } // End for: $argumentIndex

  call_user_func_array($functionName, $arguments);
  header("Location: success.html");
  die();
} // End function: callFunction


// Checks that a function was given.
if (isset($_POST["functionName"]))
{
  $functionName = htmlspecialchars($_POST["functionName"]);
} // End if
else
{
  error("Function-not-specified");
} // End else

// Calls the appropriate function with its required arguments.
switch ($functionName)
{
  // Ticket functions.
  case "addTicketToDatabase":
    callFunction(array("ticketName", "venue", "eventType", "artist",
                       "startDateTime", "finishDateTime", "price", "location",
                       "userID"));
    break;
  case "removeTicketFromDatabase":
    callFunction(array("userID", "ticketID"));
    break;
  case "removeAllUserTicketsFromDatabase":
    callFunction(array("userID"));
    break;
  case "getAllUserTickets":
    callFunction(array("userID"));
    break;
  case "getTicketInfo":
    callFunction(array("ticketID"));
    break;

  // User functions:
  case "removeUserFromDatabase":
    callFunction(array("userID"));
    break;
  case "changeEmailAddress":
    callFunction(array("userID", "email"));
    break;
  case "changePhoneNumber":
    callFunction(array("userID", "phoneNumber"));
    break;
  case "changeFacebookLink":
    callFunction(array("userID", "facebookLink"));
    break;
  case "checkUserNameAvailable":
    callFunction(array());
    break;
  case "changePassword":
    callFunction(array("userID", "password"));
  case "addUserToDatabase":
    callFunction(array("username", "password", "firstName", "surname", "email",
                       "phoneNumber", "facebookUsername"));
    break;
  case "addReviewToDatabase":
    callFunction(array("ticketSellerID", "reviewerID", "rating",
                       "reviewComment"));
    break;
  case "getUserInfo":
    callFunction(array("userID"));
    break;
  default:
    error("Function-not-found");
} // End swtich: $functionName

?>

</head>
</html>
