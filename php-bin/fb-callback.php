<?php
    require_once "config.php";
    // Print exceptions if debug is true
    $debug = true;

    try {
        $access_token = $helper->getAccessToken();

    } catch (\Facebook\Exceptions\FacebookResponseException $err) {
        if ($debug)
            echo "FB Response Exception: " . $err->getMessage();
        exit();

    } catch (\Facebook\Exceptions\FacebookSDKException $err) {
        if ($debug)
            echo "FB SDK Exception: " . $err->getMessage();
        exit();
    }

    if(!$access_token) {
        header('location: index.php');
        exit();
    }

    $OAuthClient = $FB->getOAuth2Client();
    if (!$access_token->isLongLived()) {
        $access_token = $OAuthClient->getLongLivedAccessToken($access_token);
    }

    $response = $FB->get("/me?fields=id,first_name,last_name,email,picture.type(large)", $access_token);
    $user_data = $response->getGraphNode()->asArray();

    $_SESSION['userData'] = $user_data;
    $_SESSION['accessToken'] = (string)$access_token;
    $_SESSION['login'] = "Facebook";

    // For debugging
    //var_dump($user_data);

    header('location:profile.php');
    exit();
?>
