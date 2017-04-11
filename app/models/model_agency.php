<?php
class Model_Agency extends Model 
{
  public function get_data() {
    $loginUser = array(
      "login_status" => 1
    );
    return $loginUser;
  }

  public function saveclient()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $note = $_POST['note'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
      if(!empty($_FILES['image']['name'])){
      $img = optlogotype();
      }else{
        $img = 'images/no_image.png';
      }
    
    $sql = "INSERT INTO `users`";
    $sql .= "(username, password, email, level, active)";
    $sql .= "VALUES ('$name', '$password', '$email', '3', '1')";
    $con = $this->db();
    $res = $con->query($sql);
    $last_id = $con->insert_id;

    $query = "INSERT INTO `clients`";
    $query.= "(name, address, phone, url, notes, img, id_user, id_agency)";
    $query.= "VALUES ('$name', '$address', '$phone', '$url', '$note', '$img', '$id', '$last_id')";
    $con = $this->db();
    $result = $con->query($query); 
      if($result){
          return 'Success';
      }else{
          return "Db error";
      }
  }

  public function allclient()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `clients`";
    $sql.= "WHERE id_user = '$id'";
    $con = $this->db();
    $res = $con->query($sql);
    $all_order = array();
      while ($all = $res->fetch_assoc()) {
        $all_order[] = $all;
      }
      return $all_order;
  }

  public function checkemail()
  {
    $email = $_POST['email'];
    $qu = "SELECT * FROM `users`";
    $qu .= "WHERE email='$email'";
    $con = $this->db();
    $results = $con->query($qu);
      if($results->num_rows>0){
        return 'Sorry, but the email is not available';
      }else{
        return'Success';
      }
  }

  public function updateimg()
  {
    $id = $_POST['id'];
    $img = optlogotype();
    $sql = "UPDATE `agency`";
    $sql.= " SET imglogo='$img'";
    $sql.= " WHERE id_user='$id'";
    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
    }
  }

  public function infagency()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `agency`";
    $sql .="WHERE id_user='$id'";
    $con = $this->db();
    $res = $con->query($sql);
    if($res->num_rows>0){
      $que = "SELECT * FROM `agency` as `a`";
      $que .="INNER JOIN `users` as `u`";
      $que .="ON u.id=a.id_user AND u.id=".$id;
      $con = $this->db();
      $result = $con->query($que);
      return $inf = $result->fetch_assoc();
    }else{
      return 'null';
    }
  }

  public function saveinform()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $agencyname = $_POST['agencyname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $img = optlogotype();
      if(!empty($img)){
        $img = $img;
      }else{
        $img = 'images/no_image.png';
      }
    $query = "INSERT INTO `agency`";
    $query .= "(id_user, name_agency, phone, address, imglogo)";
    $query .= "VALUES ('$id', '$agencyname', '$phone', '$address', '$img')";
    $con = $this->db();
    $result = $con->query($query);
      if($result){
        return 'Success';
      }else{
        return 'Error db';
      }
  }

  public function updateprof()
  {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
      if(!empty($password)){
        $sql = "UPDATE `users`";
        $sql .= "SET email='$email', password='$password', username='$username'";
        $sql .= "WHERE id='$id'";
        $con = $this->db();
        $res = $con->query($sql);
      }else{
        $sql = "UPDATE `users`";
        $sql .= "SET email='$email', username='$username'";
        $sql .= "WHERE id='$id'";
        $con = $this->db();
        $res = $con->query($sql);
      }
    $query = "UPDATE `agency`";
    $query .= "SET name_agency='$name', address='$address', phone='$phone'";
    $query .= "WHERE id_user='$id'";
    $con = $this->db();
    $result = $con->query($query);
      if($result){
        return 'Success';
      }else{
        return 'Error db';
      }
  }

  public function prof()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `agency`";
    $sql .= "WHERE id_user = '$id'";
    $con = $this->db();
    $res = $con->query($sql);
    $inf = $res->fetch_assoc();
    return $inf;
  }

  public function profclient()
  {
    session_start();
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `clients`";
    $sql .= "WHERE id = '$id'";
    $con = $this->db();
    $res = $con->query($sql);
    $inf = $res->fetch_assoc();
    return $inf;
  }

}
