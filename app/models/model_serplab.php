<?php
class Model_Serplab extends Model {

    public function serplab(){
        $listProjects = $this->listProjects();
        $listProjects = json_decode($listProjects);

        foreach ($listProjects as $key=>$project){
            $listProjectsArr[$key] = get_object_vars($listProjects[$key]);
        }

        $data['serplab_list_projects'] = $listProjectsArr;

        return $data;
    }

    public function project(){
        if(isset($_GET['id'])){
            $project_id = $_GET['id'];
            $project = $this->getProject($project_id);
            $project = json_decode($project);

            $data['project'] = get_object_vars($project);

            return $data;
        }
    }

    private function listProjects(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.serplab.co.uk/api/v1/api.php?api_key=258686107c8090e08521b839819ef986&action=list_projects");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    private function getProject($project_id){
        $url = "https://www.serplab.co.uk/api/v1/api.php?api_key=258686107c8090e08521b839819ef986&action=project&project_id=".$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function clientinfo(){

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        session_start();
        $_SESSION['client_id'] = $id;
    }elseif(!isset($_GET['id']) && isset($_SESSION['client_id'])){
        $id = $_SESSION['client_id'];
    }
    $sql = "SELECT * FROM `clients`";
    $sql .="WHERE id='$id'";
    $con = $this->db();
    $res = $con->query($sql);

    $inf = $res->fetch_assoc();

    return $inf;
   
  }
}
