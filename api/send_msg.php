<?php
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    var_dump($_FILES);
    die();
    if(isset($_COOKIE['token'])&&isset($_GET['message'])&&isset($_GET['room'])) {
        $message = getGet('message');
        $room = getGet('room');
        $token = $_COOKIE['token'];

        if(!empty($token)&&!empty($message)&&!empty($room)) {
            $sql = "SELECT id_user, token FROM token_user WHERE token = '$token'";
            $result = renderViews($sql,true);

            if($result != null) {
                $sql = "SELECT * FROM myfriend WHERE myfriend.id = $room";
                $resultRoom = renderViews($sql,true);
                if(!empty($resultRoom)) {
                    $user_id = $result['id_user'];
                    $date_at = createDate();
                    
                    $sql = "INSERT INTO messeagefriends (idRoom,idUser,message_content,create_at,update_at) VALUES ('$room','$user_id','$message','$date_at','$date_at')";
                    $resultSend = connect($sql);
                } 
            }
        }
    }