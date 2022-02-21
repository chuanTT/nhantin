<?php
    require_once "./lib/connectdb.php";
    require_once "./lib/handel.php";

    if(isset($_GET['room'])&&isset($_COOKIE['token'])) {
        $room = $_GET['room'];
        // lấy id người dùng
        $token = $_COOKIE['token'];
        $id_user = render_id_token($token);
        // lấy ra phòng 
        $sql = "SELECT idUser, idFriend FROM myfriend WHERE id = $room AND idUser = $id_user OR idFriend = $id_user";
        $result = renderViews($sql,true);
        
        if($result == null) {
            header('location: ../message/');
            exit;
        } else {
            if($result['idUser'] != $id_user) {
                $id = $result['idUser'];
            } else {
                $id = $result['idFriend'];
            }

            $sql = "SELECT last_name, active_now, avatar, change_photo, update_at FROM user WHERE id = $id";
            $result = renderViews($sql,true);

            if($result != null) {
                $linkImg = link_thumbnail (
                                            baseUrl,
                                            defaultFolder,
                                            $result['change_photo'],
                                            $result['avatar'],
                                            $result['update_at']
                                        );
                $name = $result['last_name'];
                                        
                if($result['active_now'] == 1) {
                    $status = 'Đang hoạt động';
                } else {
                    $status = 'Đang ngoại tuyến';
                }

            }

        }
    } else {
        header('location: ../message/');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "./include/head.php";?>
    <title>Nhắn tin | Nguyễn Đình Chuân</title>
</head>
<body>
    <section class="container">
        <div class="app">
            <div class="header__msg">
                <div class="msg__infor">
                    <div class="msg__back">
                        <a href="../message/"><ion-icon name="arrow-back-sharp"></ion-icon></a>
                    </div>
                    <div class="msg__name">
                        <div class="list_message-avatar msg">
                            <div class="avatar-icon" style="background-image: url(<?=isset($linkImg)?$linkImg:''?>)"></div>
                        </div>
                        <div class="list_message-infor">
                            <div class="infor_name"><?=isset($name)?$name:''?></div>
                            <div class="message_no_send"><?=isset($status)?$status:''?></div>
                        </div>
                    </div>
                </div>
                <div class="msg__status">i</div>
            </div>
            <div class="views_message" data-room="<?=isset($room)?$room:''?>"></div>
            <div class="message__controller">
                <div class="attachs_views">
                    <!-- <div class="attachs_views-items">
                        <img src="../assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg" alt="">
                        <ion-icon name="close-outline" class="close"></ion-icon>
                    </div> -->
                </div>
                <form method="get" class="message_form" enctype="multipart/form-data">
                    <div class="controller__attachs">
                        <label class="attach_img" for="thumbnail">
                            <ion-icon name="image"></ion-icon>
                            <input type="file" name="thumbnail[]" id="thumbnail" multiple style="display: none;">
                        </label>
                    </div>
                    <div class="form_group">
                        <input type="text" class="input__msg" placeholder="Aa">
                    </div>
                    <div class="form_send">
                        <button type="submit" class="btn">
                            <ion-icon name="send-sharp"></ion-icon>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php require_once './include/script.php'?>
    <script src="./assets/js/detail_message.js"></script>
</body>
</html>