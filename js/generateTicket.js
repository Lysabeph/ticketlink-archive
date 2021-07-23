function animateTicketIn(ticketNumber) {
    console.log(ticketNumber);
    $("#ticket-" + (ticketNumber+1)).animate({left: "+=50", opacity: 1},500);
}

function animateTicketOut(ticketNumber) {
    console.log(ticketNumber);
    $("#ticket-" + (ticketNumber+1)).animate({left: "+=50", opacity: 0},500);
    setTimeout(function(t) { 
        $("#ticket-" + (ticketNumber+1)).remove();
    }, 500, ticketNumber);
}

// Get Tickets
function getTicketPage(pageNumber) {
    $.get("php-bin/getTickets.php?page=" + pageNumber,
    function(data, status) {
        // Check that the tickets loaded correctly
        if (status != "success") {
            alert("Error loading tickets");
            return;
        }

        // Parse the JSON file given by the PHP response
        console.log(data);
        var tickets = JSON.parse(data);

        // Iterate through each ticket
        for (var t = 0; t < tickets.length; t++) {
            // If no ticket is given then ignore it
            if (tickets[t] == null)
                continue;

            var ticket_html = '<a href="#"><div style=" white-space: nowrap;" class="ticket"'
            + 'id="ticket-' + (t+1) + '" ><div class="ticket-header">'
            + '<span>' + tickets[t].Artist.toUpperCase() + '</span></div><div id="triangle-topleft"></div>'
            + '<div class="row"><div class="col-sm-3 ticket-date">'
            + '<h1 style="margin-bottom: -10px; margin-top: 10px;">2</h1>'
            + '<span style="font-weight: 400;" >MAR</span>'
            + '</div><div class="col-sm-9 ticket-info">'
            + '<span style="font-weight: 700;" >' + tickets[t].TicketName 
            + '</span><br /><span style="font-weight: 400;" >' + tickets[t].Venue 
            + '</span><br/><br/><span style="font-weight: 700;" >5pm - 11pm</span>'
            + '</div></div><h1 class="ticket-price">£19</h1></div></a><br/>';
            
            $(ticket_html).appendTo('#ticket-list');
            $("#ticket-" + (t+1)).css({ opacity: 0, left: "-=50" });

            setTimeout(function(t) { animateTicketIn(t); } , t*200, t);
            console.log( t*400);
        }
    });
}

var first_page_loaded = false;

$("#pagination-ticket").pagination({
    dataSource: [1, 2, 3, 4, 5, 6, 7, 8, 9],
    pageSize: 4,
    ulClassName: "pagination",
    callback: function(data, pagination) {
        console.log("data: " + data);
        console.log("page: " + pagination.pageNumber);

        // Remove existing tickets
        if (first_page_loaded) {
            for (var t = 0; t < 4; t++) {
                setTimeout(function(t) { animateTicketOut(t); } , t*100, t);
            }

            // Load the new page
            setTimeout(function(p) { getTicketPage(p); } , 550, pagination.pageNumber);
        } else {
            first_page_loaded = true;
        }
    }
});

getTicketPage(1);

/*/* OOF
function animateTicketIn(ticketNumber) {
    console.log(ticketNumber);
    $("#ticket-" + (ticketNumber+1)).animate({left: "+=50", opacity: 1},500);
}

function animateTicketOut(ticketNumber) {
    console.log(ticketNumber);
    $("#ticket-" + (ticketNumber+1)).animate({left: "+=50", opacity: 0},500);
    setTimeout(function(t) { 
        $("#ticket-" + (ticketNumber+1)).remove();
    }, 500, ticketNumber);
}

// Get Tickets
function getTicketPage(pageNumber) {
    $.get("php-bin/getTickets.php?page=" + pageNumber,
    function(data, status) {
        // Check that the tickets loaded correctly
        if (status != "success") {
            alert("Error loading tickets");
            return;
        }

        // Parse the JSON file given by the PHP response
        console.log(data);
        var tickets = JSON.parse(data);

        // Iterate through each ticket
        for (var t = 0; t < tickets.length; t++) {
            // If no ticket is given then ignore it
            if (tickets[t] == null)
                continue;

            var ticket_html = '<a href="#"><div style=" white-space: nowrap;" class="ticket"'
            + 'id="ticket-' + (t+1) + '" ><div class="ticket-header">'
            + '<span>' + tickets[t].Artist.toUpperCase() + '</span></div><div id="triangle-topleft"></div>'
            + '<div class="row"><div class="col-sm-3 ticket-date">'
            + '<h1 style="margin-bottom: -10px; margin-top: 10px;">2</h1>'
            + '<span style="font-weight: 400;" >MAR</span>'
            + '</div><div class="col-sm-9 ticket-info">'
            + '<span style="font-weight: 700;" >' + tickets[t].TicketName 
            + '</span><br /><span style="font-weight: 400;" >' + tickets[t].Venue 
            + '</span><br/><br/><span style="font-weight: 700;" >5pm - 11pm</span>'
            + '</div></div><h1 class="ticket-price">£19</h1></div></a><br/>';
            
            $(ticket_html).appendTo('#ticket-list');
            $("#ticket-" + (t+1)).css({ opacity: 0, left: "-=50" });

            setTimeout(function(t) { animateTicketIn(t); } , t*200, t);
            console.log( t*400);
        }
    });
}

var first_page_loaded = false;

$("#pagination-ticket").pagination({
    dataSource: [1, 2, 3, 4, 5, 6, 7, 8, 9],
    pageSize: 4,
    ulClassName: "pagination",
    callback: function(data, pagination) {
        console.log("page: " + pagination);

        // Remove existing tickets
        if (first_page_loaded) {
            for (var t = 0; t < 4; t++) {
                setTimeout(function(t) { animateTicketOut(t); } , t*100, t);
            }

            // Load the new page
            setTimeout(function(p) { getTicketPage(p); } , 550, pagination);
        } else {
            first_page_loaded = true;
        }
    }
})

getTicketPage(1);*/////
//*/