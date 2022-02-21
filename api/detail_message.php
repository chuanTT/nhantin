<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if(isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];

        if(!empty($token)&&isset($_GET['room'])) {
            $idRoom = getGet('room');
            $user_id = render_id_token ($token);
            $output = '';

            if($user_id != null && !empty($idRoom)) {
                $sql = "SELECT * FROM myfriend WHERE id = $idRoom";
                $resultRoom = renderViews($sql,true);
                if($resultRoom != null) {
                    $sql = "SELECT messeagefriends.idUser,user.avatar, user.update_at, user.change_photo ,message_content,messeagefriends.update_at as msgDate FROM user JOIN messeagefriends ON user.id = messeagefriends.idUser WHERE messeagefriends.idRoom = 3 ORDER BY messeagefriends.id ASC";
                    $result = renderViews($sql);
                    $your;

                    if($result != null) {
                        foreach($result as $item) {
                            $avatar = $item['avatar'];
                            $msg = $item['message_content'];
                            // format date
                            $crDate_at = date_create($item['msgDate']); 
                            $dateFr = date_format($crDate_at,'d-m-Y');
                            $timeFr = date_format($crDate_at,'H:i:m A');
                            $date = $dateFr.' '.'Lúc'. ' '.$timeFr;
                            // link ảnh
                            $linkImgFriend = link_thumbnail(baseUrl,defaultFolder,$item['change_photo'],$avatar,$item['update_at']);
                            // xử lý tin nhắn
                            if($item['idUser'] == $user_id) {
                                $your = 1;
                                // $isCheck = 1;
                                // $avatarMsg = '';
                                // $isClass = 'msg_right';
                            } else {
                                // $isClass = '';
                                // $avatarMsg = '
                                // <div class="list_message-avatar msg_avt">
                                //     <div class="avatar-icon" style="background-image: url('.$linkImgFriend.')"></div>
                                // </div>';
                                // $isCheck = 0;
                                $your = 0;
                            }

                            $json[] = array(
                                'your' => $your,
                                'msg' => $item['message_content'],
                                'date' => $date,
                                'dir' => $linkImgFriend,
                            );

                            // $output .= '
                            //     <div class="list_message-item msg_item '.$isClass.' ">
                            //         '.$avatarMsg.'
                            //         <div class="list_message-infor desc">
                            //             <span class="content">'.$msg.'</span>
                            //             <span class="datetime">'.$date.'</span>
                            //         </div>
                            //     </div>
                            // ';
                        }
                    }        
                    echo json_encode($json);
                }

            }
        }
    }