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
<div class="container dflexCenter">
        <div class="app">
            <?php require_once "./include/header_top.php" ?>
            <div class="form-change dflexCL jSPCenter">
                <h2 style="text-align: center; font-size: 2rem;">Quên mật khẩu</h2>
                <form method="post" class="form-authen home_change_ps">
                    <div class="form-group">
                      <span>Mật khẩu cũ</span>
                      <input type="password" name="password" placeholder="VD: 12345" autocomplete="off">
                      <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                      <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Mật khẩu mới</span>
                        <input type="password" name="new_password" placeholder="VD: 12345" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Xác nhận mật khẩu mới</span>
                        <input type="password" name="confrim_new_password" placeholder="VD: 12345" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <span class="message-erorr"></span>
                    <div class="form-submit">
                        <button class="btn btn-round btn-infor btn-sizeX sb-shadow" type="submit">Đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once './include/script.php'?>
    <script src="./assets/js/change_ps_home.js"></script>
</body>
</html>