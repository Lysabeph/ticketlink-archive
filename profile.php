<?php
    require_once "php-bin/SessionFunctions.php";

    // If user is not logged in
    if (!isset($_SESSION['userData'])) {
        $_SESSION['userData'] = [
            'first_name'    => "Anonymous",
            'last_name'     => "n/a",
            'email'         => "n/a",
            'id'            => "0",
            'picture'       => array('url' => "avatar.gif")
        ];
        $_SESSION['login'] = "Not logged in";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/pagination.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/bss/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet"> 
    <link rel="stylesheet" href="css/core/index.css">
    <link rel="stylesheet" href="css/bss/bootflat.css">
    <title>TicketLink</title>
    
</head>
<body style="font-family: 'Montserrat', sans-serif; ">
    <?php include "modules/navbar.inc.php"; ?>

    <div class="wrapper page-header">
        <div class="container">
            <div class="col-mg-3">
                <h1 class="review" id="review-quote" >"Latest Review"</h1>
            </div>
            <h4 class="review" id="review-user" style="margin-top: -10px;">- From Johnson Stevens</h4>
            </br>
        </div>
    </div>
    <div class="sub-wrapper">
        <div class="container">
            <div class="row user-sub-bar-info">
                <div class="col-md-3">
                    <img src="avatar.gif" class="profile-pic" alt="">
                </div>
                <div class="col-md-5 ">
                    <span style="font-weight: 700; font-size: 24px;" >Rating: </span>
                    <span style="font-weight: 400; font-size: 24px;" >60%</span>
                    <span style="font-weight: 400; font-size: 16px;" >(83 reviews)</span>
                </div>
                <div class="col-md-4">
                    <span style="font-weight: 700; font-size: 24px;" >Join Date: </span>
                    <span style="font-weight: 400; font-size: 24px;" >13/12/2017</span>
                    <span style="font-weight: 400; font-size: 16px;" ></span>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container-fluid" style="background-color:#FFF">
        <div class="row justify-content-center visible-xs">
            <div class="col-lg-3 user-info col-xs-12">
                <div class="container">
                    <br/>
                    <h3 style="font-weight:300;">About Me</h3>
                    <p>Lorem ipsum dolor sit amet,  consectetur adipiscing elit.  
                    Etiam semper tellus gravida  pellentesque dictum. Nulla euismod 
                    pharetra egestas.</p>
                    <h3 style="font-weight:300;">Contact Me</h3>
                    Email: micahel@gmail.com
                    <br/>
                    Phone Number: 0161 044 531
                </div>
            </div>
            <div class="col-lg-9 col-xs-12">
                <div class="container">
                    <h1 id="user-fullname" style="margin-top: 10px;">Michael Stevens</h1>
                    <h3 id="username" style="margin-top: -15px; font-weight:300;">@vsauce</h3>
                    <div class="row visible-xs">
                        <div id="ticket-list" class="col-md-9 col-xs-12">
                            <br/>

                        </div>
                    </div>
                    <div class="pagination" id="pagination-ticket"></div>
                </div> <!-- Container --> 
            </div>
        </div>
    </div>

    

    <script src="js/generateTicket.js"></script>
    <script>
        var mobileView = false; 

        // Get page info to avoid using unnecessary AJAX

        // Shift objects depending on mobile and desktop view
        function shiftOnWidth() {
            var windowWidth = $(window).width();
            console.log(windowWidth);

            // Change to mobile view
            if (windowWidth < 768 && !mobileView) {
                mobileView = true;
                $("#review-quote").text("Wasa Wasa");
                $("#review-user").text("@vsauce");

                $("#user-fullname").text("Listings");
                $("#username").text("50 tickets");
            }
        }

        shiftOnWidth();

        $( window ).resize(function() {
            shiftOnWidth();
        });
    </script>

    <?php include "modules/footer.inc.php"; ?>
    <?php include "modules/user-modal.inc.php"; ?>
</body>
</html>