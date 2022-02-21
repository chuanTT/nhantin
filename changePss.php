<?php
    session_start();
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(!isset($_SESSION['check'])) {
        header('location: login.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "./include/head.php";?>
        <title>Thay đổi mật khẩu | Nguyễn Đình Chuân</title>
    </head>
    <body>
        <section class="container dflexCenter bgGray">
            <div class="authen">
                <form method="post" class="form-authen change-login">
                    <div class="form-group">
                        <span>Mật khẩu mới</span>
                        <input type="password" name="pass" placeholder="VD: Mật khẩu mới của bạn" class="pass" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Xác nhận mật khẩu mới</span>
                        <input type="password" name="passChange" placeholder="VD: Xác nhận mật khẩu mới của bạn" class="passChange" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <span class="message-erorr"></span>
                    <div class="form-submit">
                        <button class="btn btn-round btn-gray btn-sizeX change_submit" type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </section>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/passChange.js"></script>
    </body>
</html>

