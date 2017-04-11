<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.01.2017
 * Time: 12:18
 */
class Model_ApiData extends Model
{
    public function saveAccessToken($user_id, $api_name, $access_token){
        if (!$access_token){
            echo '<h3>Has no access token</h3>';
            die();
        }
        $access_token = json_encode($access_token);
        $sql = "INSERT INTO api_data (user_id, api_name, access_token) VALUES ('$user_id', '$api_name', '".$access_token."')";
        $id = $this->sql($sql);
        if($id){
            return $id;
        } else {
            return FALSE;
        }
    }

    public function getAccessToken($user_id){
        $sql = "SELECT access_token FROM api_data WHERE user_id = '$user_id' LIMIT 1";
        $res = $this->sql($sql);
        if($res->num_rows > 0){
            return $res->fetch_object();
        } else {
            return FALSE;
        }
    }

}