<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(!isset($_COOKIE['token'])) {
        header('location: ./login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "./include/head.php";?>
    <title>Trang chủ | Nguyễn Đình Chuân</title>
</head>
<body>
    <section class="container">
        <div class="app dflexCL">
            <?php require_once "./include/header_top.php"?>
            <div class="search">
                <form method="get" onsubmit="return false">
                    <input type="text" name="search" placeholder="Tìm kiếm..." class="searching" autocomplete="off">
                </form>
                <div class="result__searching"></div>
            </div>
            <div class="list_message"></div>
        </div>
    </section>
    <?php require_once './include/script.php'?>
    <script src="./assets/js/home.js"></script>
</body>
</html>