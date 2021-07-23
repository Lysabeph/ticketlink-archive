<?php
require_once "ConnectToDatabase.php";


// Removes a given ticket from the database.
// Elasticsearch
function removeTicketFromDatabase($ticketID)
{
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => [
          "query" => [
              "term" => [
                  "TicketID" => $ticketID
              ]
          ]
      ]
  ];
  $response = $client->deleteByQuery($params);
} // End function: removeTicketFromDatabase
/*
// MySQL
function removeTicketFromDatabase($userID, $ticketID)
{
  $conn = openConnectionToDatabase();
  $stmt = $conn->prepare("DELETE FROM Tickets
                          WHERE TicketID = ? AND UserID = ?;");
  $stmt->bind_param("ii", $ticketID, $userID);
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: removeTicketFromDatabase
*/
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Remove all user Tickets
// Elasticsearch
function removeAllUserTicketsFromDatabase($userID)
{
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => [
          "query" => [
              "term" => [
                  "UserID" => $userID
            ]
         ]
      ]
  ];
  $response = $client->deleteByQuery($params);
} // End function: removeAllUserTicketsFromDatabase
/*
// MySQL
function removeAllUserTicketsFromDatabase($userID)
{
  $conn = openConnectionToDatabase();
  $stmt = $conn->prepare("DELETE FROM Tickets
                          WHERE UserID = ?;");
  $stmt->bind_param("i", $userID);
  $stmt->execute();
  closeConnectionToDatabase($conn);
} // End function: removeAllUserTicketsFromDatabase
*/
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Search a ticket in general
function searchTicket($searchValue)
{
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => [
          "query" => [
              "multi_match" => [
                "query" => $searchValue,
                 "fields" => ["TicketName", "Venue", "EventType",
                              "Artist", "Location"]
             ]
          ]
      ]
  ];

  $response = $client->search($params);
  return json_encode($response);
} // End function: searchTicket

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Creates a new ticket record

// Elasticsearch
function addTicketToDatabase($ticketName, $venue, $eventType, $artist,
                             $startDateTime, $finishDateTime, $price, $location,
                             $userID)
{
  // Stores a random number used as a ticket ID.
  $ticketID = newIDNumber();
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => ["TicketID"       => $ticketID,
                 "TicketName"     => $ticketName,
                 "Venue"          => $venue,
                 "EventType"      => $eventType,
                 "Artist"         => $artist,
                 "StartDateTime"  => $startDateTime,
                 "FinishDateTime" => $finishDateTime,
                 "Price"          => $price,
                 "Location"       => $location,
                 "UserID"         => $userID
               ]
  ];
  $response = $client->index($params);
  return json_encode($response);
} // End function: addTicketToDatabase
/*
// MySQL
function addTicketToDatabase($ticketName, $venue, $eventType, $artist,
                             $startDateTime, $finishDateTime, $price, $location,
                             $userID)
{
  // Stores the sql query to check if the given userID exists.
  $query = "SELECT count(1)
            FROM Users
            WHERE UserID='" . $userID . "';";

  // Stores the connection to the database.
  $conn = openConnectionToDatabase();
  $queryResult = $conn->query($query);
  $resultArray = $queryResult->fetch_assoc();

  if (!($resultArray["count(1)"] == "1"))
  {
    closeConnectionToDatabase($conn);
    error("User-does-not-exist");
  } // End if: $resultArray

  // Stores a random number used as a ticket ID.
  $ticketID = newIDNumber("Tickets");

  // Prepares the SQL query that will add a new ticket to the database.
  $stmt = $conn->prepare("INSERT INTO Tickets(TicketID, TicketName, Venue,
                                              EventType, Artist, StartDateTime,
                                              FinishDateTime, Price, Location,
                                              UserID)
                          VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

  // Stores the query with the values passed to the function.
  $stmt->bind_param("issssssdsi", $ticketID, $ticketName, $venue,
                    $eventType, $artist, $startDateTime, $finishDateTime,
                    $price, $location, $userID);

  // Runs the query and closes the database connection.
  $stmt->execute();

  closeConnectionToDatabase($conn);
} // End function: addTicketToDatabase
*/

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Get all user tickets
// Elasticsearch
function getAllUserTickets($userID)
{
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => [
          "query" => [
              "term" => [
                  "UserID" => $userID
              ]
          ]
      ]
  ];

  $response = $client->search($params);
  return json_encode($response);
} // End function: getAllUserTickets

/*
// MySQL
function getAllUserTickets($userID)
{
  $query = "SELECT TicketID, TicketName, Venue, EventType, Artist,
                   StartDateTime, FinishDateTime, Price, Location
            FROM Tickets
            WHERE UserID='" . $userID . "';";

  $conn = openConnectionToDatabase();
  $queryResult = $conn->query($query);
  closeConnectionToDatabase($conn);

  $resultArray = array();
  $count = 0;

  while ($record = mysqli_fetch_assoc($queryResult))
  {
    $resultArray[$count] = array(
      "TicketID"       => $record["TicketID"],
      "TicketName"     => $record["TicketName"],
      "Venue"          => $record["Venue"],
      "EventType"      => $record["EventType"],
      "Artist"         => $record["Artist"],
      "StartDateTime"  => $record["StartDateTime"],
      "FinishDateTime" => $record["FinishDateTime"],
      "Price"          => $record["Price"],
      "Location"       => $record["Location"]);

    $count++;
  }

  #print_r($resultArray);
  return json_encode($resultArray);
} // End function: getAllUserTickets
*/
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Get ticket information

//Elasticsearch
function getTicketInfo($ticketID)
{
  $params = [
      "index" => "tickets",
      "type" => "default",
      "body" => [
          "query" => [
              "term" => [
                  "TicketID" => $ticketID
              ]
          ]
      ]
  ];

  $response = $client->search($params);
  return json_encode($response);
} // End function: getTicketInfo
/*
// MySQL
function getTicketInfo($ticketID)
{
  $query = "SELECT TicketID, TicketName, Venue, EventType, Artist,
                   StartDateTime, FinishDateTime, Price, Location
            FROM Tickets
            WHERE TicketID='" . $ticketID . "';";

  $conn = openConnectionToDatabase();
  $queryResult = $conn->query($query);
  closeConnectionToDatabase($conn);

  $resultArray = $queryResult->fetch_assoc();
  return json_encode($resultArray);
} // End function: getTicketInfo
*/
?>
