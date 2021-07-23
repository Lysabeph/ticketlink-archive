<?php

//CREDENTIALS FOR DB
require_once "ConnectToDatabase.php";


function getResults(){
  //LET'S INITIATE CONNECT TO DB
  // $connection = openConnectionToDatabase();
  $mysqli = openConnectionToDatabase();
  //CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY

  $queryMySqli = "SELECT TicketName, Artist, Venue FROM Tickets";
  $result = $mysqli->query($queryMySqli);
  if (mysqli_num_rows($result) > 0)
  {
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
      for ($rowIndex = 0; $rowIndex < count($row)/2; $rowIndex ++)
      {
        $rows[] = $row[$rowIndex];


      }
        // foreach ($row as $value)
        // {
        //   $rows[] = $row;
        // }
    }
  closeConnectionToDatabase($mysqli);
  echo json_encode($rows);
  }
}

$x = getResults();
print_r($x);

?>
