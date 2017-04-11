<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16.01.2017
 * Time: 18:52
 */


class Controller_Index extends Controller {

    public function __construct() {
        require_once 'app/models/model_login.php';
        $this->model = new Model_Login();
        $this->view = new View();
    }

    public function action_index()
    {
        $role = $this->model->check_user_role();
        Controller::setUserRole($role['level']);

        switch (Controller::getUserRole()){
            case 1:
                
                header('Location: /admin/dashboard');
                break;
            case 2:

                header('Location: /agency/dashboard');
                break;
            case 3:

                header('Location: /client/dashboard');
                break;
            default:
                return $this->action_login();
                break;

        }


    }

    public function action_login(){

        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password =$_POST['password'];

            $data = $this->model->check_data($login,$password);
            session_start();
			if($data["level"] === "1") {
				$_SESSION['admin'] = md5('admin');
                $_SESSION['user_role'] =  1;
                $_SESSION['user_id'] =  $data["id"];
                header('Location:/admin/');
			} else if($data["level"] === "3"){
                $_SESSION['user'] =  md5('user');
                $_SESSION['user_role'] =  3;
                $_SESSION['user_id'] =  $data["id"];
                header('Location:/client/dashboard');
            } elseif($data["level"] === "2"){
                $_SESSION['user'] =  md5('user');
                $_SESSION['user_role'] =  2;
                $_SESSION['user_id'] =  $data["id"];
                header('Location:/agency/dashboard');
            } else {
				$data["login_status"] = "access_denied";
			}
        }
        else
        {
            $data["login_status"] = "";
        }
        $data["body_class"] = "page-login";
        $role = $this->model->check_user_role();
        Controller::setUserRole($role['level']);
        if (Controller::getUserRole() !== null){
            header('Location:/');
        }
        $this->view->generate('login_view.php', 'login_template.php', $data);
    }

    public function action_registration(){
        if ($_POST['registration'] == 'Registration'){
            $reg = $this->model->registration();

            if ($reg){

                header('Location:/agency/dashboard');
            } else {
                echo 'oops';
                die;
            }
        }
        $data["body_class"] = "page-login";
        $this->view->generate('registration_view.php', 'registration_template.php', $data);

    }

    public function action_logout(){
        $this->model->logout();
        header('Location:/index/login');
    }

}