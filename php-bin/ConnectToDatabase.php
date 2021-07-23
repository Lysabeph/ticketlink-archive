<?php

use Elasticsearch\ClientBuilder;

require "vendor/autoload.php";

$hosts = [
  [
    "host" => "ticketlink-5176708725.eu-west-1.bonsaisearch.net",
    "port" => "443",
    "scheme" => "https",
    "user" => "2qk503ze47",
    "pass" => "gheja8axb4"
  ]
];

$client = ClientBuilder::create()
  ->setHosts($hosts)
  ->build();
  
// Returns a connection to the database.
function openConnectionToDatabase()
{
  include "config.inc.php";

  // Stores the connection to the database.
  $conn = new mysqli($database_host, $database_user, $database_pass,
                     $database_name);

  // Redirects to an error page if a database connection cannot be opened.
  if (mysqli_connect_errno())
  {
    error("Failed-to-connect");
  } // End if: mysqli_connect_errno

  return $conn;
} // End function: openConnectionToDatabase


// Closes a connection to the database.
function closeConnectionToDatabase($connection)
{
  $connection->close();
} // End function: closeConnectionToDatabase


?>
