<?php
require_once "ConnectToDatabase.php";


// Removes an existing user from the database with a given user ID.
function removeUserFromDatabase($userID)
{
  // Tries to connect to the database.
  $conn = openConnectionToDatabase();

  // sql to delete a record
  $stmt = $conn->prepare("DELETE FROM Users
                          WHERE UserID = ?;");

  $stmt->bind_param("i", $userID);

  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: removeUserFromDatabase

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// Changes the email address of a given user  to a given email address.
function changeEmailAddress($userID, $email)
{
  // Tries to connect to the database.
  $conn = openConnectionToDatabase();

  $stmt = $conn->prepare("UPDATE Users
                          SET Email = ?
                          WHERE UserID = ?;");

  $stmt->bind_param("si", $email, $userID);

  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: changeEmailAddress

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// Changes the phone number of a given user  to a given phone number.
function changePhoneNumber($userID, $phoneNumber)
{
  // Tries to connect to the database.
  $conn = openConnectionToDatabase();

  $stmt = $conn->prepare("UPDATE Users
                          SET PhoneNumber = ?
                          WHERE UserID = ?;");

  $stmt->bind_param("si", $phoneNumber, $userID);
  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: changePhoneNumber

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function changeFacebookToken($userID, $facebookLink)
{
  // Tries to connect to the database.
  $conn = openConnectionToDatabase();

  $stmt = $conn->prepare("UPDATE Users
                          SET FacebookToken = ?
                          WHERE UserID = ?;");

  $stmt->bind_param("si", $facebookLink, $userID);
  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} //changeFacebookLink

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function checkUsernameAvailable(){}

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function changePassword($userID, $password)
{
  $conn = openConnectionToDatabase();

  $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 11]);

  $stmt = $conn->prepare("UPDATE Users
                          SET LoginHash = ?
                          WHERE UserID = ?;");

  $stmt->bind_param("si", $password, $userID);
  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} //changePassword
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


function editBio($userID, $bio)
{
  $conn = openConnectionToDatabase();

  $stmt = $conn->prepare("UPDATE Users
                          SET Bio = ?
                          WHERE UserID = ?;");

  $stmt->bind_param("si", $bio, $userID);
  // Runs the query and closes the database connection.
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: editBio

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function addUserToDatabase($username, $password, $firstName, $surname, $email,
                           $phoneNumber, $facebookUsername)
{
  require_once "IDGenerator.php";

  $conn = openConnectionToDatabase();

  $userID = newIDNumber("Users");

  $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 11]);

  $stmt = $conn->prepare("INSERT INTO Users(UserID, Username, FirstName,
                                            Surname, LoginHash, Email,
                                            PhoneNumber, FacebookUsername)
                          VALUES(?, ?, ?, ?, ?, ?, ?, ?);");

  if (!$stmt)
  {
    closeConnectionToDatabase($conn);
    error("sql-prepare-failed");
  } // End if: $stmt
  else
  {
    // Stores the query with the values passed to the function.
    $stmt->bind_param("isssssis", $userID, $username, $firstName, $surname,
                                  $password, $email, $phoneNumber,
                                  $facebookUsername);

    // Runs the query and closes the database connection.
    $stmt->execute();
    closeConnectionToDatabase($conn);
  } // End else
} // End function: addUserToDatabase



// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function addReviewToDatabase($ticketSellerID, $reviewerID, $rating,
                             $reviewComment)
{
  $conn = openConnectionToDatabase();

  if ($rating <= 5 and $rating >= 0 and $ticketSellerID != $reviewerID)
    $addRecordstmt = $conn->prepare("INSERT INTO UserComments(
                                                   TicketSellerID, ReviewerID,
                                                   Rating, ReviewComment)
                                     VALUES(?, ?, ?, ?);");

    if (!$addRecordstmt)
    {
      closeConnectionToDatabase($conn);
      error("sql-prepare-failed");
    } // End if: $stmt
    else
    {
      // Stores the query with the values passed to the function.
      $addRecordstmt->bind_param("iiis", $ticketSellerID, $reviewerID, $rating,
                                         $reviewComment);

      // Runs the query and closes the database connection.
      $addRecordstmt->execute();

      $addRecordstmt->close();
    }  // End else


    if($addRecordstmt) //if preveious statement was executed
    {
      #calculate average and add 1 to number of reviews
      $avgRatingUserStmt = $conn->prepare("SELECT avg(Rating), count(Rating)
                                           FROM UserComments
                                           WHERE TicketSellerID=?
                                           GROUP BY TicketSellerID;");

      $avgRatingUserStmt->bind_param("i", $ticketSellerID);
      $avgRatingUserStmt->execute();
      $avgRatingUserStmt->bind_result($outputaverage,$outputscores);
      $avgRatingUserStmt->fetch();
      # Echo $outputaverage."-".$outputscores;             # for testing

      $avgRatingUserStmt->close();

      $updateUserStmt = $conn->prepare("UPDATE Users
                                        SET AverageRating = ?,
                                            NumberOfRatings = ?
                                        WHERE UserID = ?;");

      $updateUserStmt->bind_param("dii", $outputaverage, $outputscores,
                                         $ticketSellerID);

      $updateUserStmt->execute();
    } //if

   closeConnectionToDatabase($conn);
} //addReviewToDatabase


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function getUserInfo($userID)
{
  $query = "SELECT UserID, Username, FirstName, Surname, Email, PhoneNumber,
                   AverageRating
            FROM Users
            WHERE UserID='" . $userID . "';";

  $conn = openConnectionToDatabase();
  $queryResult = $conn->query($query);
  closeConnectionToDatabase($conn);

  $resultArray = $queryResult->fetch_assoc();
  return json_encode($resultArray);
} // End function: getUserInfo

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
?>
