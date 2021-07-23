<?php require_once "php-bin/api_keys.php"; ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<form class="login-form" action="register.php" method="post" style="background-color:#FFF">
    <div class="input-group">
    <div class="input-group-prepend">
        <div class="input-group-text">@</div>
    </div>
    <input type="text" class="form-control" id="inputUsernameRegister"
            name="username" placeholder="Enter username">
    </div><br>
    <div class="row">
        <div class="col-md-6">
                <input type="text" class="form-control"
                        id="inputFirstnameRegister" name="firstName"
                        placeholder="Enter forename">
        </div>
        <div class="col-md-6 ">
                <input type="text" class="form-control input-space" id="inputSurnameRegister"
                        name="surname" placeholder="Enter surname"><br/>
        </div>
    </div>
    <input type="email" class="form-control" id="inputEmailRegister"
            name="email" placeholder="Enter email"><br/>
    <input type="password" class="form-control"
            id="inputPasswordRegister" name="password"
            placeholder="Enter password">
    <small id="passwordHelpBlock" class="form-text text-muted">
    Your password must be between 8-32 characters.
    </small>

    <br>
    <center>
        <div class="g-recaptcha"
                data-sitekey="<?php echo $captcha_api_key; ?>">
        </div>
    </center>
    <br/>
    <input type="submit" value="Register" class="login-button"><br><br> 
</form>