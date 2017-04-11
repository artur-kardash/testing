<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.01.2017
 * Time: 13:50
 */
class Model_Ajax extends Model
{
    private $current_user_id;
    private $errors = array();

    public function __construct(){
        $this->set_current_user();

    }
    
    public function gmetrix_start_test(){
        
    }

    public function gmetrix_account_update($user_id){
        $data = $this->get_post();

        if (!isset($data['account_email']) || empty($data['account_email'])){
            $this->errors[] ='gmetrix account email does not exist';
        } elseif (!isset($data['api_key']) || empty($data['api_key'])){
            $this->errors[] ='gmetrix account api key does not exist';
        } elseif (!empty($this->errors)){
            return $this->errors;
        }

        $account_email = $data['account_email'];
        $api_key = $data['api_key'];
        $sql = "UPDATE `gmetrix_api` SET account_email = '$account_email', api_key = '$api_key' WHERE user_id = '$user_id'";
        if($this->sql($sql)){
            return 'success';
        } else {
            return 'error';
        }

    }

    public function get_gmetrix_account_data($user_id){
        $sql = "SELECT account_email, api_key FROM `gmetrix_api` WHERE user_id = '$user_id'";
        $res = $this->sql($sql);
        if ($res){
            return $res->fetch_assoc();
        } else {
            return false;
        }

    }

    public function gmetrix_account_save(){
        $data = $this->get_post();
        $agency_id = $this->get_current_user();
        $account_exist = $this->get_gmetrix_account_data($agency_id);
        if ($account_exist){
           return $this->gmetrix_account_update($agency_id);
        }

        if (!isset($data['account_email']) || empty($data['account_email'])){
            $this->errors[] ='gmetrix account email does not exist';
        }

        if (!isset($data['api_key']) || empty($data['api_key'])){
            $this->errors[] ='gmetrix account api key does not exist';
        }

        if (!empty($this->errors)){
            return $error['errors'] = $this->errors;
        }

        $account_email = $data['account_email'];
        $api_key = $data['api_key'];

        $sql = "INSERT INTO `gmetrix_api` (account_email, api_key, user_id) VALUES ('$account_email', '$api_key', '$agency_id')";

        if($this->sql($sql) && $this->last_id > 0){
            return 'success';
        } else {
            return 'error';
        }
    }

    public function remove_api_profile(){
        $id = $this->get_api_profile_id()['id'];
        if ($id > 0){
            $sql = "DELETE FROM `client_api` WHERE id = '$id'";
            return $this->sql($sql);
        } else {
            return 'error';
        }

    }
    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function update_api_profile($id){
        $data = $this->get_post();
        $agency_id = $this->get_current_user();
        $client_id = $data['client_id'];
        $api_name = $data['api_name'];
        $api_profile_id = $data['api_profile_id'];
        $sql = "UPDATE `client_api` SET agency_id = '$agency_id', client_id = '$client_id', api_name = '$api_name', api_profile_id = '$api_profile_id'  WHERE id = '$id'";
        return $this->sql($sql);
    }

    /**
     * @return array
     */
    public function get_api_profile_id(){
        $data = $this->get_post();
        $agency_id = $this->get_current_user();
        if (!isset($data['client_id']) || empty($data['client_id'])){
            return 'client id does not exist';
        }

        if (!isset($data['api_name']) || empty($data['api_name'])){
            return 'api name does not exist';
        }
        $client_id = $data['client_id'];
        $api_name = $data['api_name'];

        $sql = "SELECT * FROM `client_api` WHERE agency_id = '$agency_id' AND client_id = '$client_id' AND api_name = '$api_name'";
        $res = $this->sql($sql);
        return $res->fetch_assoc();
    }

    /**
     * @return string
     */
    public function add_api_profile_id(){
        $data = $this->get_post();

        if ( $this->get_api_profile_id()['id'] > 0){
            return $this->update_api_profile($this->get_api_profile_id()['id'])?'updated':'error';
        }

        if (!$client_id = $data['client_id']){
            return 'client_id field does not exist or not valid';
        }

        if (!$api_name = $data['api_name']){
            return 'api_name field does not exist';
        }

        if (!$api_profile_id = $data['api_profile_id']){
            return 'api_profile_id field does not exist';
        }

        $agency_id = $this->get_current_user();

        $sql = "INSERT INTO `client_api` (agency_id, client_id, api_name, api_profile_id) VALUES ('$agency_id', '$client_id', '$api_name', '$api_profile_id')";

        if($this->sql($sql) && $this->last_id > 0){
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * @return mixed
     */
    public function get_current_user(){
        return $this->current_user_id;
    }

    /**
     *
     */
    public function set_current_user(){
        session_start();
        $this->current_user_id = $_SESSION['user_id'];
    }

    /**
     *
     */
    public function ajax_test(){
        session_start();
        var_dump($this->get_post());
        die();
    }


    /**
     * @return array
     */
    public function get_post(){
        if (!isset($_POST['val']) || empty($_POST['val'])){
            return 'value of post "val" does not exist';
        }

        if (!is_string($_POST['val'])){
           return 'val was not serialize to string';
        }

        $post = explode('&', $_POST['val']);

        $data = array();
        foreach ($post as $value){

            $array =  explode('=', $value);
            $data[urlencode($array[0])] = urldecode($array[1]);
        }
        return $data;
    }

}