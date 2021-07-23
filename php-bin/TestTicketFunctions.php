<?php

include "ConnectToDatabase.php";
include "GoToErrorPage.php";
include "IDGenerator.php";
include "TicketFunctions.php";


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~ Test: addTicketToDatabase() ~~~~~~~~~~~~~~~~~~~~~~~~

$conn = openConnectionToDatabase();

$result = getAllUserTickets("74201104");
echo $result;
print_r(json_decode($result, true));
echo "~";

# 2nd arg of true turns it into an array.
foreach (json_decode($result, true) as $record)
{
  echo getTicketInfo($record["TicketID"]);
  print_r(json_decode(getTicketInfo($record["TicketID"])));
}

/*addTicketToDatabase("Sam's Sesh", "Sam's Place", "Partay", "",
                    "2018-03-09 16:30:00", "2018-03-09 17:00:00", 19.99,
                    "Manchester", 74201104);
 */

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~ Test: removeTicketFromDatabase() ~~~~~~~~~~~~~~~~~~~~~

#removeTicketFromDatabase(79487520,  62453954);

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~ Test: removeAllUserTicketsFromDatabase() ~~~~~~~~~~~~~~~~~~

#removeAllUserTicketsFromDatabase(40323499);

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

closeConnectionToDatabase($conn);

?>
