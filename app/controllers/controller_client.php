<?php
class Controller_Client extends Controller
{
  function __construct() 
  {
    require_once("vendor/autoload.php");
    $client = new Google_Client();
    $this->model = new Model_Client($client);
    $this->view = new View();

    require_once 'app/models/model_login.php';
    $user = new Model_Login();
    $role = $user->check_user_role();
    $page = $_SERVER['REQUEST_URI'];
    $page = explode("?", $page);
    // if($page[0] == '/client/linkgeneral' || $page[0] == '/client/linkchannels' || $page[0] == '/client/linkconversions' || $page[0] == '/client/linkpdf' || $page[0] == '/client/linksearch' || $page[0] == '/client/linkgmetrix' || $page[0] == '/client/clientinfo'){
    if($page[0] == '/client/clientinfo'){
      $res = $this->model->getid();
      session_start();
      $_SESSION['user_id'] = $res['id_user'];
      $_SESSION['client_id'] = $_GET['id'];
      $role['level'] = 2;
    }
    if ($role['level'] > 3 || $role['level'] < 1){
        $this->view->generate('danied_view.php', 'template_view.php');
        die();
    }
  }

  function action_index() {
      return $this->action_dashboard();
  }

  function action_dashboard() {
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Dashboard";
    $data['inf'] = $this->model->getinform();
    if ($_SESSION['user'] == md5('user')) {
        $this->view->generate('client/dashboard_client_view.php', 'client/client_template_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'client/client_template_view.php', $data);
    }
  }

  function action_logout()
  {
    session_start();
    session_destroy();
    header('Location:/login');
  }

  function action_profile(){
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Profile";
    $data["profile"] = $this->model->get_profile();
    if ($_SESSION['user'] == md5('user')) {
      $this->view->generate('client/profile_view.php', 'template_user_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'client/client_template_view.php', $data);
    }
  }

  function action_UpdateProfile(){
    $respons = $this->model->update_profile();
    echo $respons;
  }

  function action_updateimgclient()
  {
    $res = $this->model->updateimgclient();
    header('Location:/client/dashboard');
  }

  public function action_add_google_analitics()
  {
    $googanlitics = $this->model->add_google_analitics();
  }

  public function action_analitics()
  {
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Dashboard";
    $data['analitics'] = $this->model->analitics();
    $data['inf'] = $this->model->getinform();
    if ($_SESSION['user'] == md5('user')){
      $this->view->generate('client_dashboard_view.php', 'agency/agency_client_template_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'agency/agency_client_template_view.php', $data);
    }
  }

  public function action_analitics2()
  {
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Dashboard";
    $data['analitics2'] = $this->model->analitics2();
    $data['inf'] = $this->model->getinform();
    if ($_SESSION['user'] == md5('user')) {
        $this->view->generate('analitics2.php', 'agency/agency_client_template_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'agency/agency_client_template_view.php', $data);
    }
  }

  function action_clientinfo()
  {
    $results = $this->model->infagency();
    $data['inform'] = $results;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $result = $this->model->prof();
    $data['info'] = $result;
    $data['searchconsole'] = $this->model->searchconsole();
    $data['gmetrix'] = $this->model->gmetrix();
    $this->view->generate('agency/edit_clients_view.php', 'agency/agency_client_template_view.php', $data);
  }

  function action_clientanalytics()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $results = $this->model->infagency();
    $data['inform'] = $results;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $data['api_profile_id'] = $api_profile_id;
    $this->view->generate('client/clients_analytics_view.php', 'agency/agency_client_template_view.php', $data);
  }

  function action_clientanalyticschannels()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $results = $this->model->infagency();
    $data['inform'] = $results;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $this->view->generate('client/clients_analytics1_view.php', 'agency/agency_client_template_view.php', $data);
  }

  function action_clientanalyticsconversions()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $results = $this->model->infagency();
    $data['inform'] = $results;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $this->view->generate('client/clients_analytics2_view.php', 'agency/agency_client_template_view.php', $data);
  }

  public function action_clientanalyticspdf()
  {

    $result = $this->model->getnewinform();
    $data['inf'] = $result;
    require_once 'app/models/model_agency.php';
      $agency = new Model_Agency();
      $data['info'] = $agency->infagency();
      $results = $this->model->infagency();
      $data['inform'] = $results;
      $res = $this->model->clientinfo();
      $data['client_info'] = $res;
        
      $this->view->generate('client/clients_analytics_pdf_view.php', 'agency/agency_client_template_view.php', $data);
  }

  function action_updateclient()
  {
    $res = $this->model->updateclient();
    header('Location:/agency/dashboard');
  }

  function action_updateimg()
  {
    $res = $this->model->updateimg();
    header('Location:/agency/dashboard');
  }

  public function action_api(){
    $data = '';
    $this->view->generate('api_view.php', 'client/client_template_view.php', $data);
  }

  public function action_view_only_mode(){
    $permission = $_GET['permission'];
    $data = $permission;
    $this->view->generate('view_only_mode_view.php', 'template_view.php', $data);
  }

  public function action_gmetrix()
  {
    require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/models/model_gmetrix.php');
    $gmetrix = new Model_Gmetrix();
      if (isset($_POST['gmetrix_url']) && !empty($_POST['gmetrix_url'])){
          $gmetrix->url_to_test = $_POST['gmetrix_url'];
          $gmetrix->run();
          $data['test_result'] = $gmetrix->data;
      }
    require_once 'app/models/model_agency.php';
    $agency = new Model_Agency();
    $data['info'] = $agency->infagency();
    $res = $this->model->clientinfo();
    $data['api_key'] = $gmetrix->api_key;
    $data['acount_email'] = $gmetrix->account_email;
    /*-----------------*/
    $gmetrix->url_to_test = 'http://jointoit.com/';
    $data['test_result'] = $gmetrix->data;
    /*-----------------*/
    $data['client_info'] = $res;
    if ($client_id = $_GET['id']) $data['saved_tests'] = $gmetrix->get_client_tests_by_client_id($client_id);
    $this->view->generate('gmetrix_view.php', 'template_view.php', $data);
  }

  public function action_searchConsoleUpdateSite()
  {
    echo $this->model->searchConsoleUpdateSite();
  }

  public function action_gmetrixUpdateUrl(){
    echo $this->model->gmetrixUpdateUrl();
  }

  public function action_onlymode()
  {
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $this->view->generate('client/client_link_view.php', 'agency/agency_client_template_view.php', $data);
  }

  public function action_linkgeneral()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $data['api_profile_id'] = $api_profile_id;
    $this->view->generate('client/client_general_view.php', 'link_template_view.php', $data);
  }

  public function action_linkchannels()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $this->view->generate('client/client_channels_view.php', 'link_template_view.php', $data);       
  }

  public function action_linkconversions()
  {
    require_once 'app/models/model_ajax.php';
    $result = $this->model->prof();
    $data['info'] = $result;
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $this->model = new Model_Ajax();
    $api_profile_id = $this->model->get_api_profile_id();
    $this->view->generate('client/client_conversion_view.php', 'link_template_view.php', $data);        
  }

  public function action_linkpdf()
  {
    require_once 'app/models/model_agency.php';
    $agency = new Model_Agency();
    $data['info'] = $agency->infagency();
    $res = $this->model->clientinfo();
    $data['client_info'] = $res;
    $result = $this->model->clientinfo();
    $data['inf'] = $result;
    $this->view->generate('client/client_pdf_view.php', 'link_template_view.php', $data);       
  }

  public function action_linksearch()
  {
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    require_once("vendor/autoload.php");
    require_once 'app/models/model_link.php';
    $client = new Google_Client();
    $client->getRefreshToken();
    $this->model = new Model_Link($client);
    $this->view = new View();
    $data = $this->model->searchconsole();
    $this->view->generate('client/client_search_view.php', 'link_template_view.php', $data);
  }

  public function action_linkgmetrix()
  {
    require_once('app/models/model_gmetrixnew.php');
    $this->model = new Model_Gmetrixnew();
    $this->view = new View();
    $data = $this->model->gmetrix();
    $result = $this->model->clientinfo();
    $data['inf'] = $result;
    $this->view->generate('client/client_gmetrix_view.php', 'link_template_view.php', $data);
  }

}
