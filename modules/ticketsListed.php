<!-- Uses ajax to populate a section of array -->
<script type="text/javascript">
// Page onload
$( document ).ready(function() {

	$.ajax({
	  	type: "GET",
	  	url: 'php-bin/getTickets.php',
	  	dataType: 'json',
	  	success: function(data)
	  	{
	  		// var ticket_array = $.parseJSON(data);
	  		// console.log(ticket_array);
	  		console.log(data);
	  		for (var i = 0; i < data.length; i++)
				{
					$("#tickets").append (
						"<h3>" + data[i].TicketName + "</h3>");
									if (data[i] != null)
				{
					console.log(data[i].TicketName)
					$("#tickets").append (
						`              <div class="row">
                <div class="col-sm-6">
                  <p>TICKETNAME</p>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <p>SELLERNAME</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <p>STARTDATE</p>
                </div>
                <div class="col-sm-3">
                  <p>EVENT TYPE</p>
                  <p>VENUE</p>
                </div>
                <div class="col-sm-3">
                  <p>200</p>
                </div>
                <div class="col-sm-3">
                  <img src="http://via.placeholder.com/50x50">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <p>STARTDATE</p>
                </div>
                <div class="col-sm-3">
                  <p>LOCATION</p>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <p>USERNAME</p>
                  <p class="pull-left text-muted">No REviews</p>
                </div>
              </div>`
						);
				} // if 
				} // for
	  	}, // success
	  	error: function(data, textStatus, jqXHR)
	  	{
	  		console.log(data);
	  		alert(jqXHR.responseText);
	  	} // error
	  });
});

</script>
<div>
	<div>
	  <div id="tickets"></div>
	</div>
</div>