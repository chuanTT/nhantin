<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if(isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];

        if(!empty($token)) {
            $user_id = render_id_token($token);
            $json = [];

            if($user_id != null) {
                $sql = "SELECT * FROM myfriend WHERE idUser = $user_id OR idFriend = $user_id";
                $result = renderViews($sql);
                $i = 0;

                foreach ($result as $item) {
                    $idRoom = $item['id'];
                    if($item['idUser'] != $user_id) {
                        $id = $item['idUser'];
                    } else {
                        $id = $item['idFriend'];
                    }

                    $sql = "SELECT user.id, first_name, active_now, last_name, avatar, change_photo, user.update_at FROM user WHERE id = $id";
                    $resultUser = renderViews($sql, true);

                    if($resultUser != null) {
                        $linkImgFriend = link_thumbnail(baseUrl,defaultFolder,$resultUser['change_photo'],$resultUser['avatar'],$resultUser['update_at']);
                        $sql = "SELECT message_content, update_at, idUser FROM messeagefriends WHERE messeagefriends.idRoom = $idRoom AND attach = 0 ORDER BY messeagefriends.id DESC LIMIT 1";
                        $resultFriend = renderViews($sql,true);


                        if($resultFriend != null) {
                            if($user_id == $resultFriend['idUser']) {
                                $msg = 'Bạn: '.$resultFriend['message_content'];
                            } else {
                                $msg = $resultFriend['message_content'];
                            }
                        } else {
                            $msg = '';
                        }

                        $json[] = array(
                            'first_name' => $resultUser['first_name'],
                            'active_now' => $resultUser['active_now'],
                            'last_name' => $resultUser['last_name'],
                            'room' => $idRoom,
                            'msg' => $msg,
                            'dir' => $linkImgFriend,
                        );
                    }
                }
                echo json_encode($json);
            }
        }
    }
?>