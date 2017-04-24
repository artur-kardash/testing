<?php

class Model_Link extends Model {

    /**
     * Search Console
     **/
    private $client;

    function __construct($client) {
        $this->client = $client;
        $hash = $_GET['id'];
        $hash_id = substr($hash, 6);
        $all_id = base64_decode($hash_id);
        $res_id = explode("&", $all_id);
        $client_id = $res_id[0];
        $user_id = $res_id[1];
        $this->client_id=$client_id;
        $this->user_id=$user_id;
    }

    public function searchconsole() {


        if(!$this->currentSite()){
            $data = array();
            $search_console_error = '<h2>Integration is not set!</h2><p>Please, go to clients integration to connect Google Search Console.</p><a class="btn btn-primary" href="/client/clientinfo">Set integrations</a>';
            $data['search_console_error'] = $search_console_error;
            return $data;
        }

        if (!$oauth_credentials = $this->getOAuthCredentialsFile()) {
            echo $this->missingOAuth2CredentialsWarning();
            return;
        }
        if (!headers_sent()) {
            session_start();
        }

        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/client/clientinfo';

        $client = $this->client;
        $client->setAccessType("offline");
        $client->setIncludeGrantedScopes(true);
        $client->setAuthConfig($oauth_credentials);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("https://www.googleapis.com/auth/webmasters");
        $agency_id = $this->user_id;
        $client_id = $this->client_id;
       

        // add "?logout" to the URL to remove a token from the session
        if (isset($_REQUEST['logout'])) {
            unset($_SESSION['search-console-token']);
            $access_token_json='';
            $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
        }

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $access_token = $client->getAccessToken();
            //$_SESSION['search-console-token'] = $access_token;
            $access_token_json = json_encode($access_token);
            $res = $this->getCurrentSearchConsoleConnection($agency_id, $client_id);
            if($res){
                $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
            }else{
                $this->storeAccessTokenDB($agency_id, $client_id, $access_token_json);
            }

            // redirect back to the index controller
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

        $accessTokenDB = $this->getAccessTokenDB($agency_id, $client_id);
        $accessTokenDB = json_decode($accessTokenDB);
        $accessTokenDB = get_object_vars($accessTokenDB);
//        echo('<pre>');
//        var_dump($accessTokenDB);
//        var_dump($_SESSION['search-console-token']);
//        die();

        // set the access token as part of the client
        if ($accessTokenDB) {
            $client->setAccessToken($accessTokenDB);
            if ($client->isAccessTokenExpired()) {

                $token = $client->refreshToken($accessTokenDB);
                $access_token_json = json_encode($token);
                $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
            }
        } else {
            $data["authUrl"] = $client->createAuthUrl();
        }

        /************************************************
        We are going to create Search Console Service.
         ************************************************/

        $search_service = new Google_Service_Webmasters($client);

        /************************************************
        If we're signed in, retrieve list if websites from Search Console
         ************************************************/
        if ($client->getAccessToken()) {
            //$_SESSION['search-console-token'] = $client->getAccessToken();
            $accessToken = $client->getAccessToken();
            //TEST MODE
            $access_token_json = json_encode($accessToken);
//                var_dump($access_token_json);
//                die();
            $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
            $sitesResp = $search_service->sites->listSites();
      foreach ($sitesResp as $site){
        if($site['permissionLevel'] == 'siteOwner'){
          $sites[] = $site['siteUrl'];
        }
      }


        $data['cur_site'] = $this->currentSite();
        $data['cur_site_sitemaps'] = $sitemaps = $search_service->sitemaps->listSitemaps($data['cur_site'])->toSimpleObject();//getsitemap
        $data['cur_site_sitemaps_data'] = get_object_vars($data['cur_site_sitemaps']);

        /************************************************
        Start date and End date for Search statistic
         ************************************************/
        if (isset($_POST['start_date']) && isset($_POST['end_date'])){
            $_SESSION['start_date'] = $_POST['start_date'];
            $_SESSION['end_date'] = $_POST['end_date'];
            $_SESSION['search_console_active_tab'] = 'search_statistic';
        }
        elseif(!isset($_SESSION['start_date']) && !isset($_SESSION['end_date'])){
            $_SESSION['start_date'] = date("Y-m-d", mktime(0, 0, 0, date('m') - 3, date('d'), date('Y')));
            $_SESSION['end_date'] = date("Y-m-d");
            $_SESSION['search_console_active_tab'] = 'sitemaps';
        }
        else{
            unset($_SESSION['search_console_active_tab']);
        }

        /************************************************
        Search statistic (keywords)
         ************************************************/
        $queryAnalytics = new Google_Service_Webmasters_SearchAnalyticsQueryRequest();
        $queryAnalytics->setStartDate($_SESSION['start_date']);
        $queryAnalytics->setEndDate($_SESSION['end_date']);
        $queryAnalytics->setDimensions(['query']);
        $analyticsResponse = $search_service->searchanalytics->query($data['cur_site'], $queryAnalytics);
        $data["analytics"] = $analyticsResponse->getRows();

        /************************************************
        Site Errors - UrlCrawlErrors
         ************************************************/
        $urlCrawlErrorsCount = $search_service->urlcrawlerrorscounts->query($data['cur_site'])->toSimpleObject();
        $data['urlCrawlErrors'] = get_object_vars($urlCrawlErrorsCount);
        foreach ($data['urlCrawlErrors']['countPerTypes'] as $key => $typesErrors){
            $URLCrawlErrorsSamples = $search_service
                ->urlcrawlerrorssamples
                ->listUrlcrawlerrorssamples($data['cur_site'], $typesErrors['category'], $typesErrors['platform'])
                ->toSimpleObject();
            $URLCrawlErrorsSamples = get_object_vars($URLCrawlErrorsSamples);
            $URLCrawlErrorsSamples = $URLCrawlErrorsSamples['urlCrawlErrorSample'];
            $data['urlCrawlErrors']['countPerTypes'][$key]['URLCrawlErrorsSamples'] = $URLCrawlErrorsSamples;
        }

        /************************************************
        LIST all sitemaps for all sites
         ************************************************/
        $data["sites"] = $sites;
        foreach ($data["sites"] as $key => $site){
            $sitemaps = $search_service->sitemaps->listSitemaps($sites[$key]);
            $data["sitemaps"][$key]  = $sitemaps->getSitemap();
        }

        /************************************************
        SUBMIT new sitemap
         ************************************************/
        if (isset($_POST['feedpath']) && isset($_POST['siteurl'])){
            $siteUrl = $_POST['siteurl'];
            $feedpath = $_POST['feedpath'];
            $new_sitemap = $search_service->sitemaps->submit($siteUrl, $feedpath);
            $data['new_sitemap'] = $new_sitemap;
        }
        /************************************************
        DELETE sitemap
         ************************************************/
        if (isset($_POST['delete']) && $_POST['delete'] == 'delete'){
            $siteUrl = $_POST['siteurl'];
            $feedpath = $_POST['feedpath'];
            $new_sitemap = $search_service->sitemaps->delete($siteUrl, $feedpath);
        }

    }
    return $data;


  }


  private function missingOAuth2CredentialsWarning()
  {
    $ret = "
    <h3 class='warn'>
      Warning: You need to set the location of your OAuth2 Client Credentials from the
      <a href='http://developers.google.com/console'>Google API console</a>.
    </h3>
    <p>
      Once downloaded, move them into the credentials directory of this appclication and
      rename them 'oauth-credentials.json'.
    </p>";

    return $ret;
  }

  private function getOAuthCredentialsFile()
  {
    // oauth2 creds
    $oauth_creds = __DIR__ . '/../../credentials/client_secret_1034352859747-kel9832nbodnkn03ktg1drcuoj8f96ma.apps.googleusercontent.com.json';

    if (file_exists($oauth_creds)) {
      return $oauth_creds;
    }

    return false;
  }

  private function currentSite(){


      $agency_id = $this->user_id;
      $client_id = $this->client_id;
      $sql = "SELECT * FROM client_api";
      $sql .= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = 'search_console')";
      $con = $this->db();
      $res = $con->query($sql);
      $row = $res->fetch_assoc();

      $current_site = $row['api_profile_id'];

      return $current_site;
  }
    private function getCurrentSearchConsoleConnection($agency_id, $client_id){
        $sql = "SELECT * FROM client_api";
        $sql .= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
        $con = $this->db();
        $res = $con->query($sql);
        $data = $res->fetch_assoc();
        return $data;
    }

    private function updateAccessTokenDB($agency_id, $client_id, $access_token_json){
        $sql = "UPDATE client_api";
        $sql.= " SET access_token='$access_token_json'";
        $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
        $con = $this->db();
        $res = $con->query($sql);

        return $res;
    }

    private function storeAccessTokenDB($agency_id, $client_id, $access_token_json){
        $sql = "INSERT INTO client_api(agency_id, client_id, api_name, access_token) 
                    VALUES ('$agency_id', '$client_id', 'search_console', '$access_token_json')";
        $con = $this->db();
        $res = $con->query($sql);

        return($res);
    }

    private function getAccessTokenDB($agency_id, $client_id){
        $sql = "SELECT * FROM client_api";
        $sql .= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
        $con = $this->db();
        $res = $con->query($sql);

        $data = $res->fetch_assoc();


        return $data['access_token'];
    }

    public function clientinfo()
  {
    session_start();
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
       
    //     $_SESSION['client_id'] = $id;

    // }elseif(!isset($_GET['id']) && isset($_SESSION['client_id'])){
    //     $id = $_SESSION['client_id'];
    // }
    $id = $client_id;

    $sql = "SELECT * FROM `clients`";
    $sql .="WHERE id='$id'";
    $con = $this->db();
    $res = $con->query($sql);

    $inf = $res->fetch_assoc();

    return $inf;
   
  }


}