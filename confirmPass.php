<?php
    session_start();
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(!isset($_SESSION['confirm'])&&!isset($_GET['email'])) {
        header('location: ./forgot.php');
        die();
    } else {
        $email = getGet('email');
    }


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
                <h2 style="text-align: center;">Xác nhận</h2>
                <span class="confirm">Chúng tôi đã gửi email đến <span class="to-email"><?=isset($email)?$email:''?></span></span>
                <span class="confirm">Vui lòng kiểm tra lại email.</span>
                <span class="confirm">Tôi chưa nhận được mã. <a class="grayColor re-send"  style="text-decoration: underline;">Lấy lại mã</a> sau <span class="re-time">45</span>s .</span>
                <form method="get" class="formConfirm">
                    <div class="code">
                        <input type="text" maxlength="1" name="number1" autocomplete="off">
                        <input type="text" maxlength="1" name="number2" autocomplete="off">
                        <input type="text" maxlength="1" name="number3" autocomplete="off">
                        <input type="text" maxlength="1" name="number4" autocomplete="off">
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn btn-round btn-gray btn-sizeX confirm_submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </section>
        <?php require_once './include/script.php'?>
        <script src="./assets/js/confirmPss.js"></script>
    </body>
</html>

