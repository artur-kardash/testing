<?php

class Model_Gmetrixnew extends Model{

    public function __construct(){

    }

    public function gmetrix(){
        session_start();
        $agency_id = $_SESSION['user_id'];
        $client_id = $_SESSION['client_id'];

        $sql = ' SELECT *';
        $sql.= " FROM gmetrix";
        $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id')";
        $con = $this->db();
        $res = $con->query($sql);
        $data['gmetrix'] = $res->fetch_assoc();

        return $data;
    }

    public function gmetrixUpdateAll(){

        require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/libs/Service_WTF_Test.php');
        $test = new Services_WTF_Test("mattgs618@gmail.com", "9c50059c1607dd309078a74ba7a78db9");

        $sql = ' SELECT *';
        $sql.= " FROM gmetrix";
        $con = $this->db();
        $res = $con->query($sql);
        $gmetrix = array();
        while ($row = $res->fetch_assoc()) {
            $gmetrix[] = $row;
        }

        foreach ($gmetrix as $t){

            $url_to_test = $t["url"];
            echo $t["url"] . "<br>";
            $testid = $test->test(array(
                'url' => $url_to_test
            ));
            if ($testid) {
                echo "Test started with $testid\n";
            }
            else {
                die("Test failed: " . $test->error() . "\n");
            }

            echo "Waiting for test to finish\n";
            $test->get_results();

            if ($test->error()) {
                die($test->error());
            }

            $results = $test->results();
            $page_load_time = $results['page_load_time'];
            $html_bytes = $results['html_bytes'];
            $page_elements = $results['page_elements'];
            $report_url = $results['report_url'];
            $html_load_time = $results['html_load_time'];
            $page_bytes = $results['page_bytes'];
            $pagespeed_score = $results['pagespeed_score'];
            $yslow_score = $results['yslow_score'];

            $resources = $test->resources();
            $report_pdf = $resources['report_pdf'];

//            foreach ($resources as $resource => $url) {
//                echo "  Resource: $resource $url\n";
//            }

            $agency_id = $t['agency_id'];
            $client_id = $t['client_id'];

            $sql = "UPDATE gmetrix";
            $sql.= " SET page_load_time='$page_load_time', html_bytes='$html_bytes', page_elements='$page_elements', report_url='$report_url', html_load_time='$html_load_time', page_bytes='$page_bytes', pagespeed_score='$pagespeed_score', yslow_score='$yslow_score', report_pdf='$report_pdf'";
            $sql.= " WHERE (agency_id = '$agency_id') AND (client_id = '$client_id')";
            $con = $this->db();
            $res = $con->query($sql);
            echo("UPDATE");
        }




//        echo('<pre>');
//        var_dump($results);
//        die();

        /*
         * don't need this now
         * foreach ($results as $result => $data) {
            echo "  $result => $data\n";



        $testid = $test->get_test_id();
        echo "Test completed succesfully with ID $testid\n";
        // Each test has a unique test id. You can load an existing / old test result using:
        echo "Loading test id $testid\n";
        $test->load($testid);

        // If you no longer need a test, you can delete it:
        echo "Deleting test id $testid\n";
        $result = $test->delete();
        if (! $result) { die("error deleting test: " . $test->error()); }

        // To list possible testing locations, use locations() method:
        echo "\nLocations GTmetrix can test from:\n";
        $locations = $test->locations();
        // Returns an array of associative arrays:
        foreach ($locations as $location) {
            echo "GTmetrix can run tests from: " . $location["name"] . " using id: " . $location["id"] . " default (" . $location["default"] . ")\n";
        }
        */

        die();

    }

    public function clientinfo()
    {
       
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
    //     session_start();
    //     $_SESSION['client_id'] = $id;
    // }elseif(!isset($_GET['id']) && isset($_SESSION['client_id'])){
    //     $id = $_SESSION['client_id'];
    // }
    
    session_start();
    $id = $_SESSION['client_id'];
    $sql = "SELECT * FROM `clients`";
    $sql .="WHERE id='$id'";
    $con = $this->db();
    $res = $con->query($sql);

    $inf = $res->fetch_assoc();

    return $inf;
   
    }

    public function infagency()
    {
    session_start();

    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `agency`";
    $sql .="WHERE `id_user`='$id'";
    $con = $this->db();
    $res = $con->query($sql);
   
    if($res->num_rows>0){
        return $info = $res->fetch_assoc();
    }else{
      return 'null';
        }
    }

     public function hash()
    {
        // if(isset($_GET))
        // {
        //   $id = $_GET['id'];
        // }else{
        //   $id = $_SESSION['client_id'];  
        // }
        session_start();
        $id = $_SESSION['client_id'];
        $id_user = $_SESSION['user_id'];
        $sol = 'SKDJFD';
        $data = $id."&".$id_user;  
        $idus_id_cl = base64_encode($data);
        $hash = $sol.$idus_id_cl;
          // $hash = 'SKDJFD'.md5($id);
          // $sql = "INSERT INTO `hash`(id_client, hash) VALUES ('$id', '$hash')";
          // $con = $this->db();
          // $res = $con->query($sql);
          
        return $hash; 
        
    }   
}