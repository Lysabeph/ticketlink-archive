<?php

require_once "ConnectToDatabase.php";
function newIDNumber()
{
  //$conn = openConnectionToDatabase();
  do
  {
    $randomNumber = rand(10000000, 99999999);
/*
    $query = "SELECT count(*) as total FROM " . $table . " WHERE "
             . substr($table, 0, -1) . "ID=" . $randomNumber . ";";
    $queryResult = $conn->query($query);
    $numberInUse = $queryResult->fetch_assoc()['total'];
    //echo "Value: $randomNumber\n";
  */
    $params = [
        "index" => "tickets",
        "type" => "default",
        "body" => [
            "query" => [
                "term" => [
                    "TicketID" => $randomNumber
                ]
            ]
        ]
    ];

    $results = $client->search($params);
    $hits = $results['hits']['total'];
  } while ($hits > 0);

  //closeConnectionToDatabase($conn);

  return $randomNumber;
} // End function: newIDNumber


?>
