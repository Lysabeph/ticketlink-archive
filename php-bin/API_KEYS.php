<?php 
require_once "Facebook/autoload.php";
require_once 'php-bin/googleapi/vendor/autoload.php';
require_once "ConnectToDatabase.php";

// Establish Connection
$conn = openConnectionToDatabase();

$query = "SELECT * FROM `api_keys` WHERE 1";
$result = $conn->query($query);

$keys = $result->fetch_assoc();

// GET API KEYS
$google_api_config = $keys["Google_API_CONFIG"];
$facebook_api_key = $keys["Facebook_API_KEY"];
$facebook_api_secret = $keys["Facebook_API_SECRET"];
$captcha_api_key = $keys["Captcha_API_KEY"];
$captcha_secret_key = $keys["Captcha_API_KEY"]; 

// Close the connection
closeConnectionToDatabase($conn);

// Create Facebook API Interface
$FB = new \Facebook\Facebook([
    'app_id' => $facebook_api_key,
    'app_secret' => $facebook_api_secret,
    'default_graph_version' => 'v2.10'
]);

$helper = $FB->getRedirectLoginHelper();

// Create Google API Interface
$Gclient = new Google_Client();
$Gclient->setAuthConfig($google_api_config);

?>