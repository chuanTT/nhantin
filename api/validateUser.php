<?php 
    require_once "../lib/connectdb.php";
    if(isset($_POST['username'])) {
        $userName = $_POST['username'];

        if(!empty($userName)) {
            $json = [];
            $sql = "SELECT * FROM user WHERE userName = '$userName'";
            $result = renderViews($sql,true);

            if($result != null) {
                $json = array(
                    'status' => 400,
                );
            } else {
                $json = array(
                    'status' => 200,
                );
            }

            echo json_encode($json);
        }
    }
?>