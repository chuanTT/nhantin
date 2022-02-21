<?php
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = [];
        $first_name = getPost('first_name');
        $last_name = getPost('last_name');
        $username = getPost('username');
        $email = getPost('email');
        $password = getPost('password');

        if(
            !empty($first_name)
            &&
            !empty($last_name)
            &&
            !empty($username)
            &&
            !empty($email)
            &&
            !empty($password)
        ) {
            $convertPwd = convert($password);
            $avatar = randomPhotoDefault(thumailDefault,count(thumailDefault));
            $create_date = createDate();
            $sql = "INSERT INTO user(
                    first_name,
                    last_name,
                    userName,
                    email,
                    password,
                    avatar,
                    create_at,
                    update_at
                    ) VALUES 
                    ('$first_name','$last_name','$username','$email','$convertPwd','$avatar','$create_date','$create_date')";
            $result = connect($sql);

            if($result === true) {
                $json = array(
                    "status" => 200,
                    "msg" => "Đăng ký thành công"
                );
            } else {
                $json = array(
                    "status" => 400,
                    "msg" => "Đăng ký thất bại"
                );
            }

            echo json_encode($json);
        }
    }