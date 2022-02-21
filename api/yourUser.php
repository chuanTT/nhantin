<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if(isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $user_id = render_id_token($token);

        if($user_id != null) {
            $sql = "SELECT change_photo, avatar, update_at FROM user WHERE id = '$user_id'";
            $result = renderViews($sql,true);

            if($result != null) {  
                $linkImg = link_thumbnail(baseUrl,defaultFolder,$result['change_photo'],$result['avatar'],$result['update_at']);
                $result['dir'] = $linkImg;
                $json[] = $result;

                echo json_encode($json);
            }
        }
    }
?>