<?php

require_once "ConnectToDatabase.php"

//LET'S INITIATE CONNECT TO DB
$connection = mysql_connect(DBSERVER, DBUSER, DBPASS) 
$result = mysql_select_db(DBNAME) or die("Can't select database. Please check DB name and try again");

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysql_query ("SELECT TicketName, Venue, Artist FROM Tickets WHERE TicketName LIKE '%{$query}%' OR Venue LIKE '%{$query}%' OR Artist LIKE '%{$query}%'");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['TicketName'].', '.$row['Artist'].', '.$row['Venue'],
            'value' => $row['TicketName'], 
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>

