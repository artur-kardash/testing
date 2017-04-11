<?php
//die('here');
// Load the Google API PHP Client Library.
require_once __DIR__ . '/vendor/autoload.php';

// Start a session to persist credentials.
session_start();

// Create the client object and set the authorization configuration
// from the client_secrets.json you downloaded from the Developers Console.
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/client_secret_201890636942-vr0pgotfrschlt1p8o5q9v3u9bqhnmdu.apps.googleusercontent.com.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/agency/gapi');
$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

// Handle authorization flow from the server.
if (! isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();

    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
//  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

$analytics = new Google_Service_Analytics($client);


function getFirstProfileId($analytics) {
    // Получение идентификатора первого представления (профиля) пользователя.

    // Получение списка аккаунтов авторизованного пользователя.
    $accounts = $analytics->management_accounts->listManagementAccounts();

    if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();
        $firstAccountId = $items[0]->getId();

        // Получение списка ресурсов авторизованного пользователя.
        $properties = $analytics->management_webproperties
            ->listManagementWebproperties($firstAccountId);

        if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            $firstPropertyId = $items[0]->getId();

            // Получение списка представлений (профилей) авторизованного пользователя.
            $profiles = $analytics->management_profiles
                ->listManagementProfiles($firstAccountId, $firstPropertyId);

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();

                // Возврат идентификатора первого представления (профиля).
                return $items[0]->getId();

            } else {
                throw new Exception('No views (profiles) found for this user.');
            }
        } else {
            throw new Exception('No properties found for this user.');
        }
    } else {
        throw new Exception('No accounts found for this user.');
    }
}

function getResults($analytics, $profileId) {
    // Вызов Core Reporting API и отправка запроса о количестве сессий
    // за последние семь дней.
    return $analytics->data_ga->get(
        'ga:' . $profileId,
        '7daysAgo',
        'today',
        'ga:sessions');
}

function printResults($results) {
    // Синтаксический анализ ответа Core Reporting API с выводом
    // имени профиля и общего количества сессий.
    if (count($results->getRows()) > 0) {

        // Получение имени профиля.
        $profileName = $results->getProfileInfo()->getProfileName();

        // Получение значения первой записи в первом ряду.
        $rows = $results->getRows();
        $sessions = $rows[0][0];

        // Вывод результатов.
        print "Первое найденное представление (профиль): $profileName\n";
        print "Всего сеансов: $sessions\n";
    } else {
        print "Ничего не найдено.\n";
    }
}

function getProfilesList($analytics){
    $profiles = $analytics->management_accounts->listManagementAccounts();
    if ($profiles){

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();
                echo '<ul>';
                foreach ($items as $item){
                    echo '<li>';
                    echo '<a href=/agency/gapi/"'.$item->getId().'">'.$item->name.'<a>';
                    echo '</li>';
                }
                echo '</ul>';


            }

    }
}

getProfilesList($analytics);

//$profile = getFirstProfileId($analytics);
//$results = getResults($analytics, $profile);
//printResults($results);
//echo '<hr>';
//echo '<pre>';
//$profiles = $analytics->management_accounts->listManagementAccounts();
//var_dump($profiles);
