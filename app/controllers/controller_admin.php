<?php
class Controller_Admin extends Controller {

 function __construct()
  {
    $this->model = new Model_Admin();
    $this->view = new View();

      /**
       * Check user role
       */
      require_once 'app/models/model_login.php';
      $user = new Model_Login();
      $role = $user->check_user_role();

      if ($role['level'] != 1 ){
          $this->view->generate('danied_view.php', 'template_view.php');
          die();

      }
  }

  function action_index()
  {

  }

  function action_dashboard()
  {
    $res = $this->model->getagency();
    $data['inf'] = $res;
    $data['title'] = "Admin Panel";
    $this->view->generate("admin/admin_view.php", "template_view.php", $data);

  }

  function action_upload()
  {
    $res = $this->model->upload();
    header('Location: /admin/dashboard');
  }

  function action_review()
  {
    $result = $this->model->getclients();
    $data['cli'] = $result;
    $res = $this->model->review();
    $data['inf'] = $res;
    $this->view->generate("admin/admin_review_view.php", "template_view.php", $data);
  }

  function action_updateprofil()
  {
    $res = $this->model->updateprofil();

    if($res){
       header('Location:/admin/dashboard');
    }else{
      echo "Error";
    }

  }

   function action_updateimgs()
  {
    $res = $this->model->updateimgs();
    header('Location:/admin/dashboard');
  }

  function action_delete()
  {
    $res = $this->model->delete();
    if($res){
    header('Location:/admin/dashboard');
    }else{
      echo "Error db";
    }
  }

  public function action_clientinfo()
  {
    $res = $this->model->clientinfo();
    $data['inf'] = $res;
    $this->view->generate("admin/client_review_view.php", "template_view.php", $data);
  }

  public function action_updateclient()
  {
    $res = $this->model->updateclients();
    if($res){
       header('Location:/admin/dashboard');
    }else{
      echo "Error";
    }
    
  }

  public function action_updateimages()
  {
    $res = $this->model->updateimages();
    if($res){
       header('Location:/admin/dashboard');
    }else{
      echo "Error";
    }
  }

  public function action_deleteclient()
  {
    $res = $this->model->deleteclient();
    if($res){
      header('Location:/admin/review?id='.$res['id_user']);
    }else{
      echo "Error db";
    }
  }




  
}
?>