<?php

class Controller_Agency extends Controller
{
  function __construct()
  {
    $this->model = new Model_Agency();
    $this->view = new View();
    require_once 'app/models/model_login.php';
    $user = new Model_Login();
    $role = $user->check_user_role();
    if ($role['level'] > 3 || $role['level'] < 2){
        $this->view->generate('danied_view.php', 'template_view.php');
        die();
    }
  }

  function action_index() 
  {
    return $this->action_dashboard();
  }

  function action_dashboard()
  {
    session_start();
    if ($_SESSION['user_role'] == 2){
      $data["title"] = "Dashboard";
      $res = $this->model->prof();
      $result = $this->model->allclient();
      $data['all'] = $result;
      $data['prof'] = $res;
      $this->view->generate('admin/dashboard_admin_view.php', 'agency/agency_template_view.php', $data);
    }elseif($_SESSION['user_role'] == 3){
      $data["title"] = "Dashboard";
      $res = $this->model->profclient();
      $data['prof'] = $res;
      $this->view->generate('dashboard_client_view.php', 'agency/agency_template_view.php', $data);
    }else{
      session_destroy();
      $this->view->generate('danied_view.php', 'agency/agency_template_view.php');
    }
  }

  function action_addclients() 
  { 
    $res = $this->model->saveclient();
      if($res != 'Sorry, but the email is not available'){
        echo 'Success';
      }else{
        $error = 'Sorry, but the email is not available';
        echo 'Error';
      }
  }

  function action_allclients()
  {
    $res = $this->model->allclient();
    $data['all'] = $res;
    $this->view->generate('client/dashboard_clients_view.php', 'agency/agency_template_view.php', $data);
  }

  function action_checkemail()
  {
    $res = $this->model->checkemail();
      if($res == 'Success'){
        echo "Success";
        exit();
      }else{
        echo "Sorry, but the email is not available";
        exit();
      }
  }

  function action_updateimg()
  {
    $res = $this->model->updateimg();
    header('Location:/agency/infagency');
  }

  function action_logout()
  {
    session_start();
    session_destroy();
    header('Location:/login');
  }

  public function action_infagency()
  {
    $res = $this->model->infagency();
      if($res == 'null'){
        $this->view->generate('agency/edit_profile_view.php', 'agency/agency_template_view.php', $data);   
      }else{
        $data['inf'] = $res;
        $this->view->generate('agency/agency_profile_view.php', 'agency/agency_template_view.php', $data);   
      }
  }

  public function action_saveinform()
  {
    $res = $this->model->saveinform();
    header('Location:/agency/infagency');
  }

  public function action_updateprof()
  {
    $res = $this->model->updateprof();
      if($res){
         header('Location:/agency/infagency');
      }else{
        echo "Error";
      }
  }

  public function action_gapi()
  {
    require_once dirname(__FILE__).'/../libs/g-api/Api.php';
    require_once dirname(__FILE__).'/../models/model_api_data.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $api_model = new Model_ApiData();
    $token = $api_model->getAccessToken($user_id);
      if ($token == false){
        $gapi = new Api();
        $token = $gapi->access_token;
        $res = $api_model->saveAccessToken($user_id, 'google_analytics', $token);
        header('Location: /agency/gapi_get_profiles_list');
      } else {
        $tk = json_decode($token->access_token, true);
        $gapi = new Api($tk);
      }
    return $gapi;
  }

  public function action_gapi_get_profiles_list()
  {
    $gapi = $this->action_gapi();
    $profile_list = $gapi->getProfilesList();
    echo '<pre>';
    var_dump($profile_list);
    echo '<a href="/agency/clear_session">clear_session</a>';
  }

  public function action_clear_session()
  {
    session_start();
    unset($_SESSION['access_token']);
    header('Location: /agency/gapi');
  }

  public function action_gapi_auth()
  {
    include dirname(__FILE__).'/../libs/google-api-php-client/gapi.php';
  }

}
