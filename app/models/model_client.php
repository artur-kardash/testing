<?php
class Model_Client extends Model
{
public function get_profile()
{
    $sql = ' SELECT `email`, `password`, `level`, `full_name`';
    $sql.= ' FROM `users`';
    $sql.= ' WHERE id = '.$_COOKIE['user_id'];
    $con = $this->db();
    $res = $con->query($sql);
        if($res){
        	return $res->fetch_assoc();
        } else {
        	return FALSE;
        }
}

public function update_profile()
{
	$p  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	session_start();
    	if(empty($p['password']) && empty($p['password'])){
    		$id = $_SESSION['user_id'];
    		$email = $p["email"];
    		$name = $p["name"];
    		$address = $p["address"];
    		$phone = $p["phone"];
    		$url = $p["url"];
    		$notes = $p["notes"];

    		$sql = "UPDATE `clients`";
    		$sql.= " SET email='$email',name='$name',address='$address',phone='$phone',url='$url',notes='$notes'";
    		$sql.= " WHERE id_user='$id'";
    		$con = $this->db();
    		$res = $con->query($sql);
        		if($res){
        			header('Location:/client/dashboard');
        		}else{
        			return "Db error";
        		}
    	}else{
    		$id = $_SESSION['user_id'];
    		$email = $p["email"];
    		$password = md5($p["password"]);
    		$name = $p["name"];
    		$address = $p["address"];
    		$phone = $p["phone"];
    		$url = $p["url"];
    		$notes = $p["notes"];

    		$sql = "UPDATE `clients`";
    		$sql.= " SET email='$email',name='$name',password='$password',address='$address',phone='$phone',url='$url',notes='$notes'";
    		$sql.= " WHERE id_user='$id'";
    		$con = $this->db();
    		$res = $con->query($sql);
        		if($res){
        			header('Location:/client/dashboard');
        		}else{
        			return "Db error";
        		}
        }
}
// начало функционала для клиентов на стороне агенства
public function clientinfo()
{

    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $_SESSION['client_id'] = $id;
    }elseif(!isset($_GET['id']) && isset($_SESSION['client_id'])){
        $id = $_SESSION['client_id'];
    }
$sql = "SELECT * FROM `clients`";
$sql .="WHERE id='$id'";
$con = $this->db();
$res = $con->query($sql);
$inf = $res->fetch_assoc();

 return $inf;
}

public function gmetrix()
{
    session_start();
    $agency_id = $_SESSION['user_id'];
    $client_id = $_SESSION['client_id'];
    $sql = ' SELECT *';
    $sql.= " FROM gmetrix";
    $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id')";
    $con = $this->db();
    $res = $con->query($sql);
    $gmetrix = $res->fetch_assoc();
    return $gmetrix;
}

public function updateclient()
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $note = $_POST['note'];
        if(!empty($password)){
            $sql = "UPDATE `clients`";
            $sql.= " SET name='$name',email='$email',password='$password',address='$address',phone='$phone',url='$url',notes='$note'";
            $sql.= " WHERE id='$id'";
            $con = $this->db();
            $res = $con->query($sql);
        }else{
            $sql = "UPDATE `clients`";
            $sql.= " SET name='$name', email='$email', address = '$address', phone='$phone', url='$url', notes=$note";
            $sql.= " WHERE id='$id'";
            $con = $this->db();
            $res = $con->query($sql);
        }
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
}

public function updateimg()
{
    $id = $_POST['id'];
    $img = optlogotype();
    $sql = "UPDATE `clients`";
    $sql.= " SET img='$img'";
    $sql.= " WHERE id='$id'";
    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
}

  // конец функционала для клиентов на стороне агенства

public function prof()
{
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `agency`";
    $sql .= "WHERE id_user = '$id'";
    $con = $this->db();
    $res = $con->query($sql);
    $inf = $res->fetch_assoc();
    return $inf;
}

public function getinform()
{    
    session_start();
    $id_user = $_SESSION['user_id'];
    $sql = "SELECT * FROM `clients`";
    $sql .= "WHERE id_user = '$id_user'";
    $con = $this->db();
    $res = $con->query($sql);
    $row = $res->fetch_assoc();
    return $row;
}

public function getnewinform()
{    
    session_start();
    $id_client = $_SESSION['client_id'];
    $sql = "SELECT * FROM `clients`";
    $sql .= "WHERE `id` = '$id_client'";
    $con = $this->db();
    $res = $con->query($sql);
    $row = $res->fetch_assoc();
    return $row;
}

public function updateimgclient()
{
    session_start();
    $id = $_SESSION['user_id'];
    $img = optlogotype();
    $sql = "UPDATE `clients`";
    $sql.= " SET img='$img'";
    $sql.= " WHERE id_user='$id'";
    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
}

public function analitics()
{
    $analitics = 'Google Analitics';
    return $analitics;
}

public function analitics2()
{
    $analitics2 = 'Google Analitics2';
    return $analitics2;
}
    /**
     * Gmetrix ajax update Url
     **/
public function gmetrixUpdateUrl()
{
    $agency_id = $_SESSION['user_id'];
    $client_id = $_SESSION['client_id'];
    $url = $_POST['url'];
    echo ($url);
    $sql = ' SELECT *';
    $sql.= " FROM gmetrix";
    $sql.=" WHERE (agency_id = '$agency_id') AND (client_id = '$client_id')";
    $con = $this->db();
    $res = $con->query($sql);
    $inf = $res->fetch_assoc();
        if($inf){
            $sql = "UPDATE gmetrix";
            $sql.= " SET url='$url', page_load_time='', html_bytes='', page_elements='', report_url='', html_load_time='', page_bytes='', pagespeed_score='', 	yslow_score=''";
            $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id')";
            $con = $this->db();
            $res = $con->query($sql);
            echo("UPDATE");
        } else {
            $sql = "INSERT INTO gmetrix(agency_id, client_id, url) 
                    VALUES ('$agency_id', '$client_id', '$url')";
            $res = $con->query($sql);
            echo('Insert');
        }
}
    /**
     * Search Console update Site
     **/
public function searchConsoleUpdateSite()
{
    $agency_id = $_SESSION['user_id'];
    $client_id = $_SESSION['client_id'];
    $site = $_POST['site'];
    echo ($site);
    $sql = ' SELECT *';
    $sql.= " FROM client_api";
    $sql.=" WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = 'search_console')";
    $con = $this->db();
    $res = $con->query($sql);
    $inf = $res->fetch_assoc();
        if($inf){
            $sql = "UPDATE client_api";
            $sql.= " SET api_profile_id='$site'";
            $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = 'search_console')";
            $con = $this->db();
            $res = $con->query($sql);
            echo("UPDATE");
        } else {
            $sql = "INSERT INTO client_api(agency_id, client_id, api_name, 	api_profile_id) 
                    VALUES ('$agency_id', '$client_id', 'search_console', '$site')";
            $res = $con->query($sql);
            echo('Insert');
        }
}

  /**
   * Search Console
   **/
private $client;

function __construct($client) 
{
    $this->client = $client;
}

public function searchconsole() 
{
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
    $agency_id = $_SESSION['user_id'];
    $client_id = $_SESSION['client_id'];
    // add "?logout" to the URL to remove a token from the session
    if (isset($_REQUEST['logout'])) {
        unset($_SESSION['search-console-token']);
        $access_token_json='';
        $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
    }

    if (isset($_GET['code'])) {
        $access_token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($access_token);
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
        $accessToken = $client->getAccessToken();
        $access_token_json = json_encode($accessToken);
        $this->updateAccessTokenDB($agency_id, $client_id, $access_token_json);
        $sitesResp = $search_service->sites->listSites();
        foreach ($sitesResp as $site){
            if($site['permissionLevel'] == 'siteOwner'){
                $sites[] = $site['siteUrl'];
            }
        }
        $data["sites"] = $sites;
        $res = $this->getCurrentSearchConsoleConnection($agency_id, $client_id);
        $data['cur_site'] = $res['api_profile_id'];
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

private function getCurrentSearchConsoleConnection($agency_id, $client_id)
{
    $sql = "SELECT * FROM client_api";
    $sql .= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
    $con = $this->db();
    $res = $con->query($sql);
    $data = $res->fetch_assoc();
    return $data;
}

private function updateAccessTokenDB($agency_id, $client_id, $access_token_json)
{
    $sql = "UPDATE client_api";
    $sql.= " SET access_token='$access_token_json'";
    $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
    $con = $this->db();
    $res = $con->query($sql);
    return $res;
}

private function storeAccessTokenDB($agency_id, $client_id, $access_token_json)
{
    $sql = "INSERT INTO client_api(agency_id, client_id, api_name, access_token) 
            VALUES ('$agency_id', '$client_id', 'search_console', '$access_token_json')";
    $con = $this->db();
    $res = $con->query($sql);
    return($res);
}

private function getAccessTokenDB($agency_id, $client_id)
{
    $sql = "SELECT * FROM client_api";
    $sql .= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id') AND (api_name = \"search_console\")";
    $con = $this->db();
    $res = $con->query($sql);
    $data = $res->fetch_assoc();
    return $data['access_token'];
}

public function getid()
{
   if(isset($_GET)){
        $id = $_GET['id'];
    }else{
        $id = $_SESSION['client_id'];
    }
    $sql = "SELECT * FROM `clients`";
    $sql .= "WHERE id=$id";
    $con = $this->db();
    // var_dump($sql);
    // exit();
    $result = $con->query($sql);
    $res = $result->fetch_assoc();
    return $res;
}

public function infagency()
{
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `agency`";
    $sql .="WHERE id='$id'";
    $con = $this->db();
    $res = $con->query($sql);
    if($res->num_rows>0){
        return $info = $res->fetch_assoc();
    }else{
      return 'null';
    }
}

}