<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(isset($_COOKIE['token'])) {
        header('location: ./index.php');
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "./include/head.php";?>
        <title>Đăng nhập | Nguyễn Đình Chuân</title>
    </head>
    <body>
        <section class="container dflexCenter bgGray">
            <div class="authen">
                <h2 style="text-align: center;">Đăng Nhập</h2>
                <form method="post" class="form-authen login-form">
                    <div class="form-group">
                        <span class="username">Tên đăng nhập</span>
                        <input type="text" name="username" placeholder="VD: chuan12345" class="inputname" autocomplete="off">
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Mật khẩu</span>
                        <input type="password" name="password" placeholder="VD: 12345" class="password" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-navigate">
                        <span>
                            <a href="./forgot.php">Quên mật khẩu</a>
                        </span>
                        <span>
                            <a href="./registration.php">Đăng ký tài khoản</a>
                        </span>
                    </div>
                    <span class="message-erorr" style="display: inline-block; width: 100%; text-align: center;font-size: 1.4rem;">
                        <?=isset($msg)?$msg:''?>
                    </span>
                    <div class="form-submit">
                        <button class="btn btn-round btn-gray btn-sizeX login_submit" type="submit">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </section>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/login.js"></script>
    </body>
</html>

