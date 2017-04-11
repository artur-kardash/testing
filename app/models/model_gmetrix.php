<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.01.2017
 * Time: 15:43
 */
class Model_Gmetrix extends Model
{
    public $current_user_id;
    public $account_email;
    public $api_key;
    public $user_id;
    public $gmetrix;
    public $url_to_test;// = "http://gtmetrix.com/";
    public $errors = array();
    public $testid;
    public $data;

    public function __construct(){
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $this->set_current_user();
        require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/libs/Service_WTF_Test.php');

        if (!session_id()){
            session_start();
        }

        $this->user_id = $_SESSION['user_id'];

        $this->account_email = $this->get_account_email($this->user_id);
        $this->api_key = $this->get_api_key($this->user_id);

        if ($this->account_email && $this->api_key){
            $this->gmetrix = new Services_WTF_Test($this->account_email, $this->api_key);
        } else {
            $this->gmetrix = new Services_WTF_Test('mattgs618@gmail.com', '9c50059c1607dd309078a74ba7a78db9');
        }

    }

    public function remove_saved_test($id){
        $sql = "DELETE FROM `gmetrix_tests` WHERE id= '$id'";
        return $this->sql($sql);
    }

    public function get_client_tests_by_client_id($client_id, $agency_id = null){
        if ($agency_id == null){
            $agency_id = $this->current_user_id;
        }
        $sql = "SELECT * FROM `gmetrix_tests` WHERE user_id = '$agency_id' AND client_id = '$client_id'";
        $res = $this->sql($sql);
        if ($res){
            return $res->fetch_assoc();
        } else {
            return false;
        }
    }

    public function save_test_id($test_id, $client_id){
        $user_id = $this->get_current_user();
        $sql = "INSERT INTO `gmetrix_tests` (user_id, client_id, test_id) VALUES ('$user_id', '$client_id', '$test_id')";
        if($this->sql($sql) && $this->last_id > 0){
            return true;
        } else {
            $this->errors[]='test was not save';
            return false;
        }
    }

    public function run(){
        if (!$this->test_id()){
            $this->errors[]="test filed";
            return false;
        }
        $this->get_results();
        $this->get_resources();
        $this->location_test_from();
        if (!empty($this->errors)){
            $this->data['errors'] = $this->errors;
        }

        return $this->data;

    }

    public function location_test_from(){
        $data = array();
        if (!$this->testid && empty($this->errors)){
            if(!$this->test_id()){
                $this->errors[] = 'can not get test_id';
                return false;
            }
        }

        $locations = $this->gmetrix->locations();

        foreach ($locations as $key=>$location) {

            $data[$key]['name'] = $location["name"];
            $data[$key]['using_id'] = $location["id"];
            $data[$key]['default'] = $location["default"];
        }

        return $this->data['locations'] = $data;
    }

    public function remove_test($testid){
        $this->load_existing_test($testid);
        $result = $this->gmetrix->delete();
        if (! $result) {
            $this->errors[] = "error deleting test: " . $this->gmetrix->error();
            return false;
        }
        return $result;
    }

    public function load_existing_test($testid){
        $this->gmetrix->load($testid);
    }

    public function get_resources(){
        $data = array();
        if (!$this->testid && empty($this->errors)){
            if(!$this->test_id()){
                $this->errors[] = 'can not get test_id';
                return false;
            }
        }

        $resources = $this->gmetrix->resources();
        foreach ($resources as $resource => $url) {
            $data[$resource] = $url;
        }
        return $this->data['resources'] = $data;
    }

    public function get_results(){
        if (!$this->testid && empty($this->errors)){
            if(!$this->test_id()){
                $this->errors[] = 'can not get test_id';
                return false;
            }
        }

        $data = array();
        $results = $this->gmetrix->results();
        foreach ($results as $result => $value) {
            $data[$result]=$value;
        }
        return $this->data['results'] = $data;
    }

    public function test_id(){
        if (!$this->url_to_test){
            $this->errors[] = 'URL to test does not exist';
            return false;
        };
        if ($this->gmetrix instanceof Services_WTF_Test){
            $this->testid = $this->gmetrix->test(array(
                'url' => $this->url_to_test
            ));
        }

        if (!$this->testid) {
            $this->errors[] = "Test failed: " . $this->gmetrix->error();
            return false;
        }

        $this->gmetrix->get_results();

        if ($this->gmetrix->error()) {
            $this->errors[] = $this->gmetrix->error();
            return false;
        }

        return $this->testid = $this->gmetrix->get_test_id();
    }

    private function get_account_email($user_id){
        $sql = "SELECT account_email FROM `gmetrix_api` WHERE user_id = '$user_id' LIMIT 1";
        $res = $this->sql($sql);
        if ($res->num_rows >0){
            $key = $res->fetch_assoc();
            $result = '';
            foreach ($key as $email){
                $result = $email;
            }
            return $result;
        } else {
            return false;
        }
    }

    private function get_api_key($user_id){
        $sql = "SELECT api_key FROM `gmetrix_api` WHERE user_id = '$user_id' LIMIT 1";
        $res = $this->sql($sql);
        if ($res->num_rows >0){
            $key = $res->fetch_assoc();
            $result = '';
            foreach ($key as $api_key){
                $result = $api_key;
            }
            return $result;
        } else {
            return false;
        }
    }

    public function get_current_user(){
        return $this->current_user_id;
    }

    /**
     *
     */
    public function set_current_user(){
        if (!session_id()){
            session_start();
        }
        $this->current_user_id = $_SESSION['user_id'];
    }



}