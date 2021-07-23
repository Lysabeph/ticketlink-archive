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
<body style="font-family: 'Montserrat', sans-serif;">
  <?php include "modules/navbar.inc.php"; ?>

  <div class="wrapper blue-gradient-background" style="background-color: #0288D1">

  <div class="container">
    <h3 class="misc-title" style="font-weight:300;">User Login</h2>
  </div>

  <div class="modal-dialog" style="box-shadow: 0px 0px 8px 0px rgba(68, 68, 68, 0.7);">
        <!-- Modal content-->
        <div class="modal-content">
            <center>
                <h2 class="login-title">Ticket<span class="blue-text">Link</span></h2>

            <br/>
            <img class="login-avatar" src="avatar.gif" style=""><br>
            </center>

            <?php include "modules/login.inc.php"; ?>

 
        </div>
    </div>

  <br/><br/><br/><br/><br/>
  </div>
  <?php include "modules/footer.inc.php"; ?>
  <?php include "modules/user-modal.inc.php"; ?>
</body>
</html>
