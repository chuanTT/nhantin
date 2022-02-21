<?php
    require_once "../lib/connectdb.php";
    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        if(!empty($email)) {
            $json = [];
            $sql = "SELECT * FROM user WHERE email = '$email'";
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