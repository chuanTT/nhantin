<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";
    if(
        isset($_COOKIE['token'])
        &&
        isset($_GET['password'])
        &&
        isset($_GET['new_password'])
        &&
        isset($_GET['confrim_new_password'])
    ) {
        $token = $_COOKIE['token'];
        $isPass = 0;
        $passwordOld = getGet('password');
        $new_password = getGet('new_password');
        $cf_new_password = getGet('confrim_new_password');
        $json = [];


        if(!empty($passwordOld)&&!empty($new_password)&&!empty($cf_new_password)) {
            $user_id = render_id_token($token);
            $passwordOld = convert($passwordOld);

            $sql = "SELECT * FROM user WHERE id = $user_id AND password = '$passwordOld'";
            $result = renderViews($sql,true);

            if($result != null) {
                $isPass = 1;
    
                if($isPass && $new_password === $cf_new_password) {
                    $new_password = convert($new_password);
                    $sql = "UPDATE `user` SET `password` = '$new_password' WHERE `user`.`id` = $user_id";
                    $check = connect($sql);

                    if($check === true) {
                        $json = array(
                            "status" => 200,
                            "msg" => "Thay đổi mật khẩu thành công",
                        );
                    } else {
                        $json = array(
                            "status" => 400,
                            "msg" => "Thay đổi mật khẩu không thành công",
                        );
                    }
                }
            }

        }
    }