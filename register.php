<?php 
  require_once "php-bin/api_keys.php";
  require_once "php-bin/UserFunctions.php";

  // reCAPTCHA v2.0 by Google
  // Reference: https://developers.google.com/recaptcha/docs/verify
  // Verifys that a given Captcha is correct.
  function verifyCaptcha($secret)
  {
    // The recaptcha api creates a POST parameter sent to google.
    $recaptcha_token = $_POST['g-recaptcha-response'];

    // Set up a post request to ask google if a user is valid.
    $recaptcha_verify = array('secret' => $secret,
                              'response' => $recaptcha_token
                             );

    $ch = curl_init();

    // Setup the parameters for the POST request.
    curl_setopt($ch, CURLOPT_URL, 
                "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $recaptcha_verify);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Stop var_dumping info.
    
    // Execute the request and close.
    $google_response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return $google_response['success'];
  } // End function: verifyCaptcha

  // Stores any error message that may be received.
  $error_msg = "";

  // Displays a given error message.
  function displayError($error_msg)
  {
    // If there's no error, don't display anything 
    if (!$error_msg == "")
    {
      echo '<br/><div style="margin-top:-10px" class="alert alert-danger col-md-12" role="alert">';
      echo '<button type="button" class="close" data-dismiss="alert"
             aria-hidden="true">&times;</button>';
      echo '<strong>Uh oh!</strong> ';
      echo $error_msg;
      echo '</div>';
    } // End if: !$error_msg
  } // End function: displayError

  $error = false;
  
  if ($_POST)
  {
    $user_name  = htmlspecialchars($_POST['username']);
    $first_name = htmlspecialchars($_POST['firstName']);
    $last_name  = htmlspecialchars($_POST['surname']);
    $user_email = htmlspecialchars($_POST['email']);

    // TODO: Hash Password
    $password   = htmlspecialchars($_POST['password']);

    $captcha_correct = verifyCaptcha($captcha_secret_key);

    if (!$error && !$captcha_correct)
    {
      $error = true;
      $error_msg = "CAPTCHA was incorrect";
    } // End if: !$error && !$captcha_correct

    if (!$error && strlen($password) < 8)
    {
      $error = true;
      $error_msg = "Password cannot be shorter than 8 characters.";
    } // End if: !$error && $password len < 8

    if (!$error && strlen($password) > 32)
    {
      $error = true;
      $error_msg = "Password cannot be longer than 32 characters.";
    } // End if: !$error && $password len > 32

    // TODO: Check validity of over fields

    if (!$error)
    {
      addUserToDatabase($user_name, $password, $first_name, $last_name,
                        $user_email, "0", "");

      // TODO: Being user session

      // Relocate user
      // Would be best to relocate to their own profile
      header('location: ./profile.php');
    } // End if: !$error
  } // End if: $_POST

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

<body style="font-family: 'Montserrat', sans-serif;">
  <?php include "modules/navbar.inc.php"; ?>
  <div class="wrapper blue-gradient-background" style="background-color: #0288D1">
    <div class="container" style="">
      <h3 class="misc-title" style="font-weight:300;">User Registration</h3>
      <?php displayError($error_msg); ?>
    </div> 

    <div class="modal-dialog" style="box-shadow: 0px 0px 8px 0px rgba(68, 68, 68, 0.7);">
      <!-- Modal content-->
      <div class="modal-content">
        <center>
          <h2 class="login-title">Ticket<span class="blue-text">Link</span></h2>
        <br>
        </center>

        <?php include "modules/register.inc.php"; ?>
      </div>
    </div>

    <br/><br/><br/><br/><br/>
  </div>
  <?php include "modules/footer.inc.php"; ?>
  <?php include "modules/user-modal.inc.php"; ?>

  <script>
    function removeAlert()
    {
      console.log("hey");
      $(".alert").remove();
    } // End function: removeAlert

    $(".close").click(function()
    {
      $(".alert").css("display", "none");
    });
  </script>
</body>
</html>
