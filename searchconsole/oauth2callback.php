<?php
require_once ("searchconsole/vendor/autoload.php");

session_start();
echo "Hello";die();
$client = new Google_Client();
$client->setAuthConfig('vendor/client_secret_964278882460-aegm4msfo0irbv9st0k1b862trquf79g.apps.googleusercontent.com.json');
$client->setRedirectUri('/client/clientinfo');
$client->addScope(Google_Service_Webmasters::WEBMASTERS);

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri ='/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}