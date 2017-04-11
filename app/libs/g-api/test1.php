<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.01.2017
 * Time: 13:34
 */
require_once 'vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig('my-web-project-82b41ec9557e.json');
$client->addScope(Google_Service_Drive::DRIVE);
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirect_uri);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
}