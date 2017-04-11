<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.01.2017
 * Time: 11:33
 */
class Api
{
    public $access_token;
    public $client;
    public $analytics;
    public $redirect_uri;

    public function __construct($access_token){

        $this->redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/agency/gapi';
        require_once __DIR__ . '/vendor/autoload.php';
        $this->client = new Google_Client();
        if($access_token){
            $isExpired = $this->client->isAccessTokenExpired(); // true (bool Returns True if the access_token is expired.)
//            var_dump($isExpired);die('here');
//            $refresh = $this->client->getRefreshToken();
            $this->client->setAccessToken($access_token);
        } else {
            $this->apiAuth();
        }
//        $this->analytics = new Google_Service_Analytics($this->client);
    }

    public function apiAuth(){
        session_start();

        $this->client->setAuthConfig(__DIR__ . '/client_secret_201890636942-vr0pgotfrschlt1p8o5q9v3u9bqhnmdu.apps.googleusercontent.com.json');
        $this->client->setRedirectUri($this->redirect_uri);
        $this->client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        if (! isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
//            $this->print_login_window($auth_url);
//            echo "<script type=\"text/javascript\">window.open('$auth_url', \"socialPopupWindow\",
//                \"location=no,width=600,height=600,scrollbars=yes,top=100,left=700,resizable = no\")</script>";
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $this->client->authenticate($_GET['code']);

            $_SESSION['access_token'] = $this->client->getAccessToken();
            $this->access_token = $this->client->getAccessToken();

            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/agency/gapi_get_profiles_list';
//            var_dump(filter_var($redirect_uri, FILTER_SANITIZE_URL)); die;
//            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    public function getProfilesList(){

        $analytics = new Google_Service_Analytics($this->client);

        $profiles = $analytics->management_accounts->listManagementAccounts();
        $profile_list = array();
        if ($profiles){
            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();
                foreach ($items as $k=>$item){
                    $profile_list[$k]['id']=$item->getId();
                    $profile_list[$k]['name']=$item->name;
                }
            }
        }
            return $profile_list;
    }

    public function getResults($profileId) {
        $analytics = $this->analytics;
        // Вызов Core Reporting API и отправка запроса о количестве сессий
        // за последние семь дней.
        return $analytics->data_ga->get(
            'ga:' . $profileId,
            '7daysAgo',
            'today',
            'ga:sessions');
    }

    public function print_login_window($url){
        $self = 'http://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        echo "<li>
            <a  href=\"\"  onclick=\"return windowpop()\">Login</a>
        </li>";

        echo "<script>
            document.addEventListener(\"DOMContentLoaded\", ready);

            function windowpop(){
               my_window = window.open('$url', \"AuthPopupWindow\",
                                    \"location = no,width = 600,height = 600,scrollbars = yes,top = 100,left = 700,resizable = no\");
            }

            function ready() {
                if(window.location.href == '$self'){
                   if(typeof my_window != 'undefined'){
                     my_window.close();
                     window.close();
                   }
                   window.close();
               }
            }
            </script>";
    }
    public function analitics(){
        return require_once 'test.php';
    }
}