<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.01.2017
 * Time: 12:46
 */

// Загрузка клиентской библиотеки PHP для Google API.
require_once __DIR__ . '/vendor/autoload.php';

$analytics = initializeAnalytics();
//var_dump($analytics->management_accounts);
$profile = getFirstProfileId($analytics);
$results = getResults($analytics, $profile);
printResults($results);

function initializeAnalytics()
{
    // Создание и возвращение объекта службы Analytics Reporting.

    // Скачайте учетные данные сервисного аккаунта в формате JSON (файл ключа)
    // из консоли разработчика. Поместите файл ключа в эту директорию
    // или выберите другую, если требуется.
    $KEY_FILE_LOCATION = __DIR__ . '/my-web-project-5cb87d77e0a5.json';
//    $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

    // Создание и настройка нового объекта клиента.
    $client = new Google_Client();
    $client->setApplicationName("Hello Analytics Reporting");
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_Analytics($client);

    return $analytics;
}

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
    echo "<pre>";
    var_dump($results);
    echo "</pre>";
}
