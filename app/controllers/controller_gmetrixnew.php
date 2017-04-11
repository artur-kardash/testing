<?php

class Controller_gmetrixnew extends Controller
{
    function __construct() {
        $this->model = new Model_Gmetrixnew();
        $this->view = new View();
    }

    function action_index(){
        $data = $this->model->gmetrix();
        $result = $this->model->clientinfo();
        $data['inf'] = $result;
        $results = $this->model->infagency();
        $data['info'] = $results;
        $hash = $this->model->hash();
        $data['hash'] = $hash;
        $this->view->generate('gmetrix/gmetrix_view.php', 'agency/agency_client_template_view.php', $data);
    }

    function action_gmetrixUpdateAll() {
        $data = $this->model->gmetrixUpdateAll();
        //$this->view->generate('gmetrix/gmetrix_view.php', 'agency/agency_client_template_view.php', $data);
    }

}
