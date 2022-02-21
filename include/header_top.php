<?php 
    if(isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $id_user = render_id_token($token);

        if($id_user != null) {
            $sql = "SELECT first_name, email, last_name, change_photo, avatar, update_at FROM user WHERE id = '$id_user'";
            $result = renderViews($sql,true);

            if($result != null) {
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                $email = $result['email'];
                $linkImg = link_thumbnail (baseUrl, defaultFolder, $result['change_photo'], $result['avatar'], $result['update_at']);
            }
        }
    }
?>
<input type="checkbox" hidden id="menu_nav">
<label class="overlay_nav" for="menu_nav"></label>
<label class="menu-left" for="menu_nav">
    <h2>Menu</h2>
    <ul>
        <li>
            <a href="../message/">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span>
                    Trang chủ
                </span>
            </a>
        </li>
        <li>
            <a href="./personal_information.php">
                <span class="icon">
                    <ion-icon name="people-circle-outline"></ion-icon>
                </span>
                <span>
                    Thông tin cá nhân
                </span>
            </a>
        </li>
        <li>
            <a href="./change.php">
                <span class="icon">
                    <ion-icon name="repeat-outline"></ion-icon>
                </span>
                <span>
                    Đổi mật khẩu
                </span>
            </a>
        </li>
        <li>
            <a href="./logout.php">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span>
                    Đăng xuất
                </span>
            </a>
        </li>
    </ul>
</label>
<label class="header-top" for="menu_nav">
    <div class="avatar" style="background-image: url(<?=isset($linkImg)?$linkImg:''?>);"></div>
    <span>Chat</span>
</label>