<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "./include/head.php";?>
        <title>Quên mật khẩu | Nguyễn Đình Chuân</title>
    </head>
    <body>
        <section class="container dflexCenter bgGray">
            <div class="authen">
                <h2 style="text-align: center;">Quên mật khẩu</h2>
                <form method="post" class="form-authen forgot-login">
                    <div class="form-group">
                        <span>Email</span>
                        <input type="text" name="email" placeholder="VD: Email của bạn" class="email" autocomplete="off">
                        <span class="message-erorr"></span>
                    </div>
                    <div class="form-navigate">
                        <span>
                            <a href="./login.php">Tôi đã có tài khoản</a>
                        </span>
                        <span>
                            <a href="./registration.php">Đăng ký tài khoản</a>
                        </span>
                    </div>
                    <div class="form-submit">
                        <button class="btn btn-round btn-gray btn-sizeX forgot_submit" type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>

            <div class="opacity"></div>
        </section>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/forgot.js"></script>
    </body>
</html>

