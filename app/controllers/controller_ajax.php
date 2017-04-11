<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.01.2017
 * Time: 13:48
 */
class Controller_Ajax extends Controller
{
    public function __construct() {
        require_once 'app/models/model_ajax.php';
        $this->model = new Model_Ajax();
        $this->view = new View();
    }

    public function action_index()
    {
       echo $this->model->get_post();
    }

    public function action_add_api_profile(){
        echo $this->model->add_api_profile_id();
    }

    public function action_get_client_api_profile(){
        echo json_encode($this->model->get_api_profile_id());
    }

    public function action_remove_api_profile(){
        echo $this->model->remove_api_profile();
    }

    public function action_generate_pdf(){
        require_once 'app/models/model_report.php';
        $report = new Model_Report();
        echo $data = $report->generate_pdf($_POST['val']);
    }

    public function action_send_mail(){
        require_once 'app/models/model_report.php';
        $report = new Model_Report();
        echo $report->send_pdf_mail($_POST['val']['file'], $_POST['val']['email']);
    }

    public function action_get_pdf(){
        require_once 'app/models/model_report.php';
        $report = new Model_Report();
        echo $report->save_pdf();
    }

    public function action_gmetrix_account_save(){
        print_r( $this->model->gmetrix_account_save());
//        echo $this->model->gmetrix_account_save();
    }

    public function action_gmetrix_start_test(){

        require_once 'app/models/model_gmetrix.php';
        $gmetrix = new Model_Gmetrix();
        if (!$gmetrix->api_key || !$gmetrix->account_email){
            echo json_encode('error');
            die();
        }
        if (!$url = $this->model->get_post()['gmetrix_url']){
            echo json_encode('error');
            die();
        }
        $gmetrix->url_to_test = $url;
        $gmetrix->test_id();
        if (!$gmetrix->testid){
//            echo json_encode('no test id');
            echo json_encode($gmetrix->errors);
            die();
        }
        $results= $gmetrix->run();

        if ($results){
            echo json_encode($results);
//            echo json_encode($gmetrix->data);
            die();
        } else {
            echo json_encode($gmetrix->errors);
            die();
        }

    }
}