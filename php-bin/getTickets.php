<?php

// This PHP file is given a GET request and sends tickets in a json format
require_once "ConnectToDatabase.php";

// Maximum number of tickets that can be extracted at once
$number_of_tickets = 4;

// Initialize default variables
$type = "default"; 
$user = "";
$page = 1;

if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
}

// Open Connection
$conn = openConnectionToDatabase();

// Modify query depending on GET Params
$query = "SELECT TicketName, Artist, Venue FROM Tickets LIMIT "
    . (($page - 1) * 4 ) . ", 4";

// Get the tickets
$results = $conn->query($query);

$all_tickets = array();

for ($i = 0; $i < $number_of_tickets; $i++) {
    $ticket = $results->fetch_array(MYSQLI_ASSOC);
    array_push($all_tickets, $ticket);
}

// Return as json format
echo json_encode($all_tickets);

?>