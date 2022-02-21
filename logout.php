<?php
    session_start();
    if(!isset($_COOKIE['token'])) {
        header("location: ./login.php");
        die();
    }
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";
    // xóa trên database
    $token = $_COOKIE['token'];
    $user_id = render_id_token($token);

    $sql = "UPDATE `user` SET `active_now` = '0' WHERE `user`.`id` = $user_id";
    connect($sql);
    $sql = "DELETE FROM `token_user` WHERE `token_user`.`token` = '$token'";
    connect($sql);

    // xóa trên client
    setcookie('token','',0,"/");

    session_unset();
    session_destroy();

    header("location: ./login.php");
    exit;
?>