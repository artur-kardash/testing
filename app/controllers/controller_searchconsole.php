<?php

class Controller_searchconsole extends Controller
{
  function __construct() {
      require_once("vendor/autoload.php");
      $client = new Google_Client();
      $client->getRefreshToken();
      $this->model = new Model_Searchconsole($client);
      $this->view = new View();
  }

  function action_index() {
      $res = $this->model->clientinfo();
      $data = $this->model->searchconsole();
      $data['inf'] = $res;
      $results = $this->model->infagency();
   
      $data['info'] = $results;
      $hash = $this->model->hash();
      $data['hash'] = $hash;
          
      $this->view->generate('search_console.php', 'agency/agency_client_template_view.php', $data);

  }

}
