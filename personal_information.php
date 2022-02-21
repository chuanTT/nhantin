<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(!isset($_COOKIE['token'])) {
        header("location: ./login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "./include/head.php";?>
        <title>Thông tin cá nhân | Nguyễn Đình Chuân</title>
    </head>
    <body>
        <div class="container">
            <div class="app">
                <?php require_once "./include/header_top.php"?>
                <div class="personal dflexCL jSPCenter">
                    <h2 class="people">Thông tin cá nhân</h2>
                    <div class="personal_information">
                        <form action="" method="post" enctype='multipart/form-data' class="personal_form">
                            <div class="information_thumbnail">
                                <img src="<?=isset($linkImg)?$linkImg:""?>" alt="hình ảnh đại diện">
                                <input type="file" name="avatar" id="avatar" style="display: none;">
                                <div class="people_overlay">
                                    <label for="avatar" class="btn btn-primary btn-sizeX btn-round">Đổi hình ảnh</label>
                                </div>
                            </div>
                            <div class="personal_people">
                                <div class="form-groups">
                                    <div class="form-group">
                                        <span>Họ:</span>
                                        <input type="text" name="first_name" value="<?=isset($first_name)?$first_name:""?>">
                                    </div>
                                    <div class="form-group">
                                        <span>Tên:</span>
                                        <input type="text" name="last_name" value="<?=isset($last_name)?$last_name:""?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span>Email:</span>
                                    <input type="text" name="email" value="<?=isset($email)?$email:""?>">
                                </div>
                                <div class="form-submit">
                                    <button class="btn btn-infor btn-sizeX btn-round" type="submit">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/personal_information.js"></script>
    </body>
</html>

