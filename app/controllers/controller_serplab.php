<?php

class Controller_serplab extends Controller
{
    function __construct() {
        $this->model = new Model_Serplab();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->serplab();
        $result = $this->model->clientinfo();
        $data['inf'] = $result;
        $this->view->generate('serplab/serplab_view.php', 'agency/agency_client_template_view.php', $data);

    }

    function action_project() {
        $data = $this->model->project();
        // $result = $this->model->clientinfo();
        // $data['inf'] = $result;
        $this->view->generate('serplab/project_view.php', 'agency/agency_client_template_view.php', $data);

    }

}
