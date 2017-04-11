<?php
class Model_Login extends Model {
  public function get_data() {
    $loginUser = array(
      "login_status" => 1
    );
    return $loginUser;
  }
  public function check_data($login, $password) {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
      exit();
    }
    $data = array();
    $login = mysqli_real_escape_string($con, $login);
    $password = mysqli_real_escape_string($con, $password);
    $password = md5($password);

    $query    = "SELECT * FROM `users` WHERE email='$login' and password='$password'";

    if($result = $con->query($query) ) {
        $r=$result->fetch_assoc();
        foreach($r as $k=>$v) {
          if($k !== 'password') {
            $data[$k] = $v;
          }
        }
      if($data["active"] == 0) {
        $con->close();
        return FALSE;
      }
        setcookie("user_name", $data['full_name']);
        setcookie("user_id", $data["id"]);
    } else {

      $con->close();
      return FALSE;
    }
    $con->close();
    return $data;
  }

  public function registration(){
      $con = $this->db();
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $password = md5($password);

      $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

      $res = $con->query($sql);

      if($res->num_rows == 0){

          $sql = "INSERT INTO users (email, password, `level`, username, active) VALUES ('$email', '$password', '2', '$username', '1')";
//          var_dump($sql); die;
          $id = $this->sql($sql);
          if ($id){
              setcookie("user_name", $username);
              setcookie("user_id", $id);
              session_start();
                  $_SESSION['user_role'] = 2;
                  $_SESSION['user_id'] =  $this->last_id;
          }
          return true;
      } else {
          return FALSE;
      }
  }

  public function check_user_role(){

//      $id = $_COOKIE['user_id'];
      session_start();

      if ($_SESSION['user_id']){
          $id = $_SESSION['user_id'];
      } else {
          return false;
      }

      $sql = 'SELECT level FROM users WHERE id = '.$id.' LIMIT 1';
      $con = $this->db();
      $res = $con->query($sql);
      if($res){
          return $res->fetch_assoc();
      } else {
          return FALSE;
      }
  }

  public function logout(){
      if (isset($_COOKIE['user_name'])) {
          unset($_COOKIE['user_name']);
          setcookie('user_name', '', time() - 3600, '/');
      }

      if (isset($_COOKIE['user_id'])) {
          unset($_COOKIE['user_id']);
          setcookie('user_id', '', time() - 3600, '/');
      }

      session_start();
      session_destroy();

  }
}
