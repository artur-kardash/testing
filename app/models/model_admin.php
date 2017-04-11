<?php
class Model_Admin extends Model {

public function upload()
{
	$uploaddir = 'video/';
	$name = $_FILES['userfile']['name'];
	
    $uploadfile = $uploaddir . basename($name);
	 	if(!empty($name)){
	      $video = 'video/'.$name;
	    }else{
	      $video = '';
	    }
	    if(!empty($_POST['text'])){
	    	$text = trim($_POST['text']);
	    }else{
	    	$text = "";
	    }
	// проверка на наличие чего нибудь и 
	$sql = "SELECT * FROM `admin`";
	$con = $this->db();
    $res = $con->query($sql);
    $del = $res->fetch_assoc();
    if($res->num_rows>0){
    	$querydel = "SELECT `video` FROM `admin`";
    	$con = $this->db();
    	$res = $con->query($sql);
    	$delete = $res->fetch_assoc();

	    $query = "UPDATE `admin` SET ";
	    	if(!empty($video) && !empty($text)){
	    			unlink($delete['video']);
    			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
		    $query .= " video='$video', text='$text'";
			}elseif(empty($video)){
			$query .= "text='$text'";
			}else{
				unlink($delete['video']);
    			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$query .= " video='$video'";
			}
			$con = $this->db();
    		$results = $con->query($query);
    }else{
    	$que = "INSERT INTO `admin`";
	    $que .= "(video, text)";
	    $que .= "VALUES ('$video', '$text')";
	    $con = $this->db();
    	$result = $con->query($que);
    }
}

public function getagency()
{
    $que = "SELECT `a`.`id` as `id_ag`, `a`.`name_agency`, `u`.`id`, `a`.`phone`, `a`.`address`, `a`.`imglogo`, `u`.`email`, `u`.`password`, `u`.`username`, `u`.`level` FROM `agency` as `a`";
    $que .="LEFT JOIN `users` as `u`";
    $que .="ON u.id=a.id_user";
    $con = $this->db();
    $results = $con->query($que);
    $res = array();
    while($all = $results->fetch_assoc()){
    	$res[] = $all; 
    }

    return $res;
}

public function review()
{

	$id = $_GET['id'];
	$que = "SELECT `a`.`id` as `id_ag`, `a`.`name_agency`, `u`.`id`, `a`.`phone`, `a`.`address`, `a`.`imglogo`, `u`.`email`, `u`.`password`, `u`.`username`, `u`.`level` FROM `agency` as `a`";
    $que .="INNER JOIN `users` as `u`";
    $que .="ON u.id=a.id_user AND `a`.`id_user`=".$id;
	$con = $this->db();
    $results = $con->query($que);
    $res = $results->fetch_assoc();
   
   	return $res;
}

public function updateprofil()
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

  public function updateimgs()
  {
    $id = $_POST['id'];
    // $val = $_POST['val'];
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
    $img = 'images/'.$_FILES['userfile']['name'];


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

  public function delete()
  {
    $id = $_GET['id'];

    $sql = "DELETE FROM `agency`";
    $sql .= "WHERE id_user='$id'";
    $con = $this->db();
    $res = $con->query($sql);

    $query = "DELETE FROM `users`";
    $query .= "WHERE id='$id'";
    $con = $this->db();
    $result = $con->query($query);

    $que = "DELETE FROM `clients`";
    $que .= "WHERE id_user='$id'";
    $con = $this->db();
    $results = $con->query($que);

    if($res || $result || $results){
        return "Success";
    }else{
        return "Error db";
    }

  }

  public function getclients()
  {
  	$id = $_GET['id'];
  	$sql = "SELECT * FROM `clients`";
  	$sql .= "WHERE id_user='$id'";
  	$con = $this->db();
  	$result = $con->query($sql);

  	$res = array();
  	while($all = $result->fetch_assoc())
  	{
  		$res[] = $all;
  	}

  	return $res;

  }

  public function clientinfo()
  {
  	$id = $_GET['id'];

  	$sql = "SELECT * FROM `clients`";
  	$sql .= "WHERE id='$id'";
  	$con = $this->db();
  	$res = $con->query($sql);
  	$result = $res->fetch_assoc();

  	return $result;
  }

  public function updateclients()
  {
  	$name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $notes = $_POST['notes'];

    if(!empty($password)){
	    $sql = "UPDATE `clients`";
	    $sql .= "SET email='$email', password='$password', name='$name', address='$address', phone='$phone', url='$url', notes='$notes'";
	    $sql .= "WHERE id='$id'";
	    $con = $this->db();
	    $res = $con->query($sql);
    }else{
	    $sql = "UPDATE `clients`";
	    $sql .= "SET email='$email', name='$name', address='$address', phone='$phone', url='$url', notes='$notes'";
	    $sql .= "WHERE id='$id'";
	    $con = $this->db();
	    $res = $con->query($sql);
    }

    if($res){
      return 'Success';
    }else{
      return 'Error db';
    }
  }

   public function updateimages()
  {

    $id = $_POST['id'];
    // $val = $_POST['val'];
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
    $img = 'images/'.$_FILES['userfile']['name'];


    $sql = "UPDATE `clients`";
    $sql.= " SET img='$img'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function deleteclient()
  {

    $id = $_GET['id'];

    $sql = "SELECT `id_user` FROM `clients`";
    $sql .= "WHERE id='$id'";
    $con = $this->db();
    $result = $con->query($sql);
    $res = $result->fetch_assoc();

    $que = "DELETE FROM `clients`";
    $que .= "WHERE id='$id'";
    $con = $this->db();
    $results = $con->query($que);
    if($res){
        return $res;
    }else{
        return "Error db";
    }

  
  }




}
