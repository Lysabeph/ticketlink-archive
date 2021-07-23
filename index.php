<!DOCTYPE html>
<html lang="en-GB">

<head>
  <title>Ticket-link</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"
  charset="utf-8">
  <!-- Bootstrap -->
  <link href="css/bss/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/core/index.css" rel="stylesheet" media="screen">
  <link href="css/autocomplete.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="css/bss/bootflat.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet"> 
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/velocity.min.js"></script>

  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>

  <script>
    $(document).ready(function()
    {
       $('input.inputTicketSearch').typeahead(
       {
         name:   'inputTicketSearch',
         remote: 'inputTicketSearch.php?query=%QUERY'
       });
    })
  </script>

  <?php
    require_once "php-bin/ConnectToDatabase.php";

    // Tries to connect to the database.
    $conn = openConnectionToDatabase();

    $query = "SELECT TicketName, Artist, Venue FROM Tickets";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0)
    {
      // Stores the ticket names, artists and venues from the database.
      $rows = [];

      while($row = mysqli_fetch_array($result))
        for ($rowIndex = 0; $rowIndex < count($row)/2; $rowIndex ++)
          $rows[] = $row[$rowIndex];

      closeConnectionToDatabase($conn);

      // Stores json encoded array of the unique database info.
      $autocompleteArray = json_encode(array_values(array_unique($rows)));
    } // End if: mysqli_num_rows
    else
      $autocompleteArray = json_encode([]);
  ?>

</head>

<body style="font-family: 'Montserrat', sans-serif;">
  <?php require_once "modules/navbar.inc.php"; ?>
  <div id="wrapper">
    <div id="header">
      <div class="naviagation-menu container-fluid">
      </div>
    </div>
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3 text-center">
            <h1 class="display-2">Find a Ticket!</h1>
            <!-- Form takes user input and sends to ticket-seach page and also redirects -->
            <form autocomplete="off" action="ticket-search.php" method="post">
              <div class="autocomplete">
                <input class="form-control form-control-lg"
                       id="inputTicketSearch"
                       placeholder="Artist, Event or Venue" type="text" name="ticketInput"><br>
              </div>
              <button type="submit" class="btn-lg btn-success ">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include "modules/footer.inc.php"; ?>
    <?php include "modules/user-modal.inc.php"; ?>
  </div>

  <script type="text/javascript">


  // Displays an autocomplete 'box' below the search box that can be used to
  // fill in search values.
  function autocomplete(inputTextFromUser, ticketInfoArray)
  {
    // The autocomplete function takes one argument, the text field element.
    var currentFocus;

    // Execute a function when the text field changes.
    inputTextFromUser.addEventListener("input", function(e)
    {
      // Stores the text entered by the user into the input box.
      var inputTextValue = this.value;

      // Closes any already open lists of autocompleted values.
      closeAllLists();

      if (!inputTextValue)
        return false;

      currentFocus = -1;

      // Stores a DIV element that will contain the autocomplete options.
      var autocompleteContainerDIV = document.createElement("DIV");

      autocompleteContainerDIV.setAttribute("id", this.id + "autocomplete-list");
      autocompleteContainerDIV.setAttribute("class", "autocomplete-items");

      // Appends autocompleteContainerDIV as a child of the autocomplete
      // container.
      this.parentNode.appendChild(autocompleteContainerDIV);

      for (ticketInfoIndex = 0; ticketInfoIndex < ticketInfoArray.length; ticketInfoIndex++)
      {
        // If user text == start of autocomplete option.
        if (ticketInfoArray[ticketInfoIndex].substr(0, inputTextValue.length).toUpperCase() == inputTextValue.toUpperCase())
        {
          // Stores a DIV element for each option matching the user input.
          autocompleteMatchingOptionDIV = document.createElement("DIV");

           // Makes the matching letters bold.
          autocompleteMatchingOptionDIV.innerHTML = "<strong>" + ticketInfoArray[ticketInfoIndex].substr(0, inputTextValue.length) + "</strong>";
          autocompleteMatchingOptionDIV.innerHTML += ticketInfoArray[ticketInfoIndex].substr(inputTextValue.length);

          // Inserts an input field that holds the value of the current array
          // item.
          autocompleteMatchingOptionDIV.innerHTML += "<input type='hidden' value='" + ticketInfoArray[ticketInfoIndex] + "'>";

          // Execute a function when the item value is clicked.
          autocompleteMatchingOptionDIV.addEventListener("click", function(e)
          {
            // Insert the value for the autocomplete text field.
            inputTextFromUser.value = this.getElementsByTagName("input")[0].value;
            closeAllLists();
          } /* End function */ );

          autocompleteContainerDIV.appendChild(autocompleteMatchingOptionDIV);
        } // End if: ticketInfoArray
      } // End for: ticketInfoIndex
    } /* End function */ );

    // Execute a function when a key is pressed down on the keyboard.
    inputTextFromUser.addEventListener("keydown", function(e)
    {
      // Stores autocompleteContainerDIV from the autocomplete previous.
      var autocompleteContainerDIV = document.getElementById(this.id + "autocomplete-list");

      if (autocompleteContainerDIV)
        autocompleteContainerDIV = autocompleteContainerDIV.getElementsByTagName("div");

      // Moves the highlighted autocomplete option when the down key is pressed.
      if (e.keyCode == 40)
      {
        currentFocus++;
        addActive(autocompleteContainerDIV);
      } // End if: e.keyCode
      // Moves the highlighted autocomplete option when the up key is pressed.
      else if (e.keyCode == 38)
      {
        currentFocus--;
        addActive(autocompleteContainerDIV);
      } // End else if: e.keyCode
      // Selects the autocomplete option if the enter key is hit.
      else if (e.keyCode == 13)
      {
        // Prevents the form from being submitted.
        e.preventDefault();

        // Simulates a mouse click on the selected autocomplete option.
        if (currentFocus > -1 && autocompleteContainerDIV)
          autocompleteContainerDIV[currentFocus].click();
      } // End else if: e.keyCode
    } /* End function */ );


    // Changes an autocomplete item to 'active'.
    function addActive(autocompleteItems)
    {
      if (!autocompleteItems)
        return false;

      removeActive(autocompleteItems);

      if (currentFocus >= autocompleteItems.length)
        currentFocus = 0;
      else if (currentFocus < 0)
        currentFocus = (autocompleteItems.length - 1);

      autocompleteItems[currentFocus].classList.add("autocomplete-active");
    } // End function: addActive


    // Unsets any autocomplete items set to 'active'.
    function removeActive(autocompleteItems)
    {
      for (var autocompleteOptionIndex = 0; autocompleteOptionIndex < autocompleteItems.length; autocompleteOptionIndex++)
        autocompleteItems[autocompleteOptionIndex].classList.remove("autocomplete-active");
    } // End function: removeActive


    // Closes all autocomplete lists except the one given.
    function closeAllLists(listToIgnore)
    {
      // Stores all of the autocomplete item lists.
      var autocompleteList = document.getElementsByClassName("autocomplete-items");

      for (var autocompleteListIndex = 0; autocompleteListIndex < autocompleteList.length; autocompleteListIndex++)
        if (listToIgnore != autocompleteList[autocompleteListIndex] && listToIgnore != inputTextFromUser)
          autocompleteList[autocompleteListIndex].parentNode.removeChild(autocompleteList[autocompleteListIndex]);
    } // End function: closeAllLists


    // Removes the autocomplete option box when the user clicks somewhere else
    // on the page.
    document.addEventListener("click", function (e)
    {
        closeAllLists(e.target);
    } /* End function */ );
  } // End function: autocomplete


  // Stores the phh array containing the ticket names, artists and venues in a
  // javascript array.
  var jsonArray = <?= $autocompleteArray ?>;

  // Initiates the autocomplete function.
  autocomplete(document.getElementById("inputTicketSearch"), jsonArray);
  </script>

</body>

</html>
