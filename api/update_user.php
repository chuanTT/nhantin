<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if(isset($_COOKIE['token'])&&isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])) {
        $token = $_COOKIE['token'];
        $first_name = getPost('first_name');
        $last_name = getPost('last_name');
        $email = getPost('email');
        $user_id =  render_id_token($token);
        $json = [];

        if($user_id != null&&!empty($first_name)&&!empty($last_name)&&!empty($email)) {
            $validateEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

            if($validateEmail) {
                $date = createDate('Y-m-d H:i:s');
                if($_FILES['avatar']['size'] <= 0) {
                    $sql = "UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `update_at` = '$date' WHERE `user`.`id` = $user_id";
                    connect($sql);
                } else {
                    $sql = "SELECT change_photo, avatar, update_at FROM user WHERE user.id = $user_id";
                    $resultUser = renderViews($sql, true);

                    if($resultUser != null) {
                        $date_format = format_date ($resultUser['update_at'],'d-m-Y');
                        $new_date_format = format_date($date,'d-m-Y');

                        $upload = uploadFile($_FILES['avatar'],baseUrlApi,$new_date_format,valid_file,20000000);

                        if(is_array($upload)) {
                            $new_name = $upload['name'];
                            $sql = "UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `avatar` = '$new_name', `update_at` = '$date' WHERE `user`.`id` = $user_id";
                            $resultUpdate = connect($sql);

                            if($resultUpdate == null) {
                                $base_old_photo = baseUrlApi.$new_date_format.'/';
                                DeleteFile($base_old_photo,$new_name);
                            } else {
                                if($resultUser['change_photo'] == 1&&!in_array($resultUser['avatar'],thumailDefault)) {
                                    $base_old_photo = baseUrlApi.$date_format.'/';
                                    DeleteFile($base_old_photo, $resultUser['avatar']);
                                }
                                $sql = "UPDATE `user` SET `change_photo` = 1 WHERE `user`.`id` = $user_id";
                                connect($sql);
                                
                                $dir = baseUrl.$new_date_format.'/'.$new_name;
                                $json = array(
                                    "dir" =>  "$dir"
                                );
                            }
                        }
                    }

                    echo json_encode($json);
                }
            }
        }
    }