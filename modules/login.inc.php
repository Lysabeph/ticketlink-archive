<?php 
  require_once "php-bin/api_keys.php";

  // Facebook API
  $redirect_url   = "http://localhost/ticketlink/php-bin/fb-callback.php";
  $fb_permissions = ['email'];
  $login_url      = $helper->getLoginUrl($redirect_url, $fb_permissions);

  // Google API
  $Gclient->setRedirectUri('http://localhost/ticketlink/php-bin/google-callback.php');
  $Gclient->addScope("https://www.googleapis.com/auth/plus.login");
  $Gclient->addScope("https://www.googleapis.com/auth/userinfo.email");
  $google_login_url = $Gclient->createAuthUrl();

?>

<form class="login-form" action="php-bin/user-login.php" method="post">
    <div class="container">
        <center>
            <small class="form-text text-muted" style="margin-top:-20px">Did you link your account with Facebook or Google?</small>
            <input type="button" onclick="facebookLogin()" value="Log In With Facebook" class="btn btn-primary" style="width:210px;">
            <input type="button" onclick="googleLogin()" value="Log In With Google" class="btn" style="width:210px; background-color:#E64A19; color:#FFF">
        </center>
    </div> 
    <br />
    <input placeholder="Username or Email" type="text" name="email" class="form-control"><br>
    <input placeholder="Password" type="password" name="pass" class="form-control"><br>
    <input type="submit" value="Log In" class="login-button"><br><br>
</form>

<script>
function facebookLogin() {
    window.location = '<?php echo $login_url; ?>';
}

function googleLogin() {
    window.location = '<?php echo $google_login_url; ?>';
}
</script>