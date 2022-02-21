<?php
    session_start();
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pass = getPost('pass');
        $passChange = getPost('passChange');
        $json = [];
        if(
            isset($pass)
            &&
            isset($passChange)
            &&
            isset($_SESSION['user_id'])
            &&
            isset($_SESSION['check'])
        ) {
            if($pass===$passChange) {
                $converPass = convert($pass);
                $id = $_SESSION['user_id'];
                $sql = "UPDATE `user` SET `password` = '$converPass' WHERE `user`.`id` = $id";
                $result = connect($sql);

                if($result == true) {
                    session_unset();
                    session_destroy();
                    $json = array(
                        "status" => 200,
                        "msg" => "Success",
                    );
                } else {
                    $json = array(
                        "status" => 400,
                        "msg" => "Erorr",
                    );
                }
            }
        }
        echo json_encode($json);
    }