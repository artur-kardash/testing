<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.01.2017
 * Time: 13:09
 */

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("my-web-project");
//$client->setApplicationName("Client_Library_Examples");
$client->setDeveloperKey("5cb87d77e0a59d39b355d70a9ea6d2e1121476a8");
//$client->setDeveloperKey("YOUR_APP_KEY");

$service = new Google_Service_AnalyticsReporting($client);
$optParams = array('filter' => 'free-ebooks');
$results = $service->reports;
echo '<pre>';
var_dump($results);

foreach ($results as $item) {
    echo $item['volumeInfo']['title'], "<br /> \n";
}