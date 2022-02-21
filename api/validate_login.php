<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = getPost('username');
        $password = getPost('password');
        $json = [];

        if(!empty($username)||!empty($password)) {
            $pwd = convert($password);
            $sql = "SELECT * FROM user WHERE userName = '$username' AND password = '$pwd'";
            $result = renderViews($sql,true);

            if($result != null) {
                $user_id = $result['id'];
                // tạo token khi đăng nhập
                $token = createToken($username);
                setcookie('token',$token, time() + 7*24*60*60, "/");
                // end tạo token

                // update trạng thái của user
                $sql = "UPDATE `user` SET `active_now` = '1' WHERE `user`.`id` = $user_id";
                connect($sql);
                // end update trạng thái user

                // lưu token vào csdl
                $sql = "INSERT INTO token_user VALUES('$user_id','$token')";
                connect($sql);
                // end lưu token vào csdl
                $json = array(
                    "status" => 200,
                    "msg" => "Đăng nhập thành công"
                );
            } else {
                $json = array(
                    "status" => 400,
                    "msg" => "Tên đăng nhập hoặc mật khẩu không chính xác"
                );
            }
            echo json_encode($json);
        }
        
    }