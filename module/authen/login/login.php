<?php 
    if(isset($_POST['username'])&&isset($_POST['password'])) {
        $userName = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($userName)&&!empty($password)) {
            $json = [];
            $pwd = convert($_POST['password']);
            $sql = "SELECT * FROM user WHERE password = '$pwd' and user.userName = '$userName'";
            $result = renderViews($sql,true);

            if($result != null) {
                setcookie('token', createToken($userName), time()+ 7 * 24 * 60 * 60, '/');
                $json = array(
                    'status' => 200,
                    'msg' => 'đăng nhập thành công',
                );
            } else {
                $json = array(
                    'status' => 400,
                    'msg' => 'đăng nhập thất bại',
                );
            }

            echo json_encode($json);
        }
    }
?>
<section class="container dflexCenter bgGray">
    <div class="authen">
        <h2 style="text-align: center;">Đăng Nhập</h2>
        <form method="post" class="form-authen">
            <div class="form-group">
                <span class="username">Tên đăng nhập</span>
                <input type="text" name="username" placeholder="VD: Tên đăng nhập" class="inputname">
                <span class="message-erorr"></span>
            </div>
            <div class="form-group">
                <span>Mật khẩu</span>
                <input type="password" name="password" placeholder="VD: 12345" class="password">
                <div class="eye">
                    <ion-icon name="eye-outline" class=""></ion-icon>
                    <ion-icon name="eye-off-outline" class="offEye"></ion-icon>
                </div>
                <span class="message-erorr"></span>
            </div>
            <div class="form-navigate">
                <span>
                    <a href="./forgot.html">Quên mật khẩu</a>
                </span>
                <span>
                    <a href="./registration.html">Đăng ký tài khoản</a>
                </span>
            </div>
            <div class="form-submit">
                <button class="btn btn-round btn-gray btn-sizeX" type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</section>