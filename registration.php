<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "./include/head.php";?>
        <title>Đăng ký | Nguyễn Đình Chuân</title>
    </head>
    <body>
        <section class="container dflexCenter bgGray">
            <div class="authen">
                <h2 style="text-align: center;">Đăng Ký</h2>
                <form method="post" class="form-authen registration-form">
                    <div class="form-groups">
                        <div class="form-group">
                            <span>Họ</span>
                            <input type="text" name="first_name" placeholder="VD: Họ của bạn" class="first_name" autocomplete="off">
                            <span class="message-erorr"></span>
                        </div>
                        <div class="form-group">
                            <span>Tên</span>
                            <input type="text" name="last_name" placeholder="VD: Tên của bạn" class="last_name" autocomplete="off">
                            <span class="message-erorr"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <span>Tên đăng nhập</span>
                        <input type="text" name="username" placeholder="VD: Tên đăng nhập" class="username" autocomplete="off">
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Email</span>
                        <input type="text" name="email" placeholder="VD: Email của bạn" class="email" autocomplete="off">
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Mật khẩu</span>
                        <input type="password" name="password" placeholder="VD: 123456" class="password" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-group">
                        <span>Xác nhận mật khẩu</span>
                        <input type="password" placeholder="VD: 123456" class="confirmPassword" autocomplete="off">
                        <div class="eye">
                            <ion-icon name="eye-outline"></ion-icon>
                            <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                        </div>
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-navigate jSPCenter">
                        <span>
                            <a href="./login.php">Tôi đã có tài khoản?</a>
                        </span>
                    </div>
                    <span class="message-erorr" style="text-align: center;"></span>
                    <div class="form-submit">
                        <button class="btn btn-round btn-gray btn-sizeX registration_submit" type="submit">Đăng ký</button>
                    </div>
                </form>
            </div>
        </section>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/registration.js"></script>
    </body>
</html>