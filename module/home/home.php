<section class="container">
    <div class="app dflexCL">
        <div class="header-top">
            <?php 
                $user = $_POST['username'];
                $sql = "SELECT avatar FROM user WHERE userName = '$user'";
                $result = renderViews($sql,true);
            ?>
            <div class="avatar" style="background-image: url(./assets/upload/29-01-2022/<?=$result['avatar']?>);"></div>
            <span>Chat</span>
        </div>
        <div class="search">
            <form action="">
                <input type="text" name="search" placeholder="Tìm kiếm...">
                <button type="submit" class="btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
        </div>
        <div class="list_message">
            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>

            <div class="list_message-item">
                <div class="list_message-avatar">
                    <div class="avatar-icon" style="background-image: url(./assets/upload/29-01-2022/hinh-anh-hoat-hinh-de-thuong-cute-cua-be-gai-600x600.jpg);"></div>
                    <div class="icon-online"></div>
                </div>
                <div class="list_message-infor">
                    <div class="infor_name">
                        Nguyễn Đình Chuân
                    </div>
                    <div class="message_no_send">Đã có tin nhắn</div>
                </div>
            </div>
        </div>
    </div>
</section>