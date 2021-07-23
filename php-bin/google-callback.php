<?php 
    session_start();
    require_once 'googleapi/vendor/autoload.php';
    // Print debug info
    $debug = false;

    // Google API
    $Gclient = new Google_Client();
    $Gclient->setAuthConfig('google_secret.json');
    $Gclient->setRedirectUri('http://localhost/oauth-ticketlink/google-callback.php');
    $Gclient->addScope("https://www.googleapis.com/auth/plus.login");
    $Gclient->addScope("https://www.googleapis.com/auth/userinfo.email");

    // If we got a code from the Google Login
    if (isset($_GET['code'])) {
        $Gclient->authenticate($_GET['code']);
        $_SESSION['accessToken'] = $Gclient->getAccessToken();
        $_SESSION['login'] = "Google";

        // Google OAuth Object
        $GOAuth = new Google_Service_Oauth2($Gclient);

        // Get user info
        $user = $GOAuth->userinfo_v2_me->get();

        // If debug, print all user info
        if ($debug) {
            echo "<pre>";
            var_dump($user);
            exit();
        }

        // Modify it so it is similar to the FB user_data
        $user_data = [
            'first_name'    => $user['givenName'],
            'last_name'     => $user['familyName'],
            'email'         => $user['email'],
            'id'            => $user['id'],
            'picture'       => array('url' => $user['picture'])
        ];

        $_SESSION['userData'] = $user_data;

        // Head back to profile page
        header('Location: http://localhost/oauth-ticketlink/profile.php');
        exit();
    }

    // Check if the user is already signed in via google
    if (isset($_SESSION['accessToken']) && $_SESSION['login'] == "google") {
        header('Location: http://localhost/oauth-ticketlink/profile.php');
        exit();
    }
?>