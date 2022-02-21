
// tạo các element message
function createMsg (selector) {
    let elementParent = document.querySelector(selector);
    if(elementParent) {
        elementParent.innerHTML = `
            <div class="header__msg"></div>
            <div class="views_message"></div>
            <div class="message__controller">
                <div class="controller__attachs">
                    <div class="attach_img">
                        <ion-icon name="image"></ion-icon>
                    </div>
                </div>
                <form action="" method="get" class="message_form">
                    <div class="form_group">
                        <input type="text" class="input__msg" name="message" placeholder="Aa" autofocus autocomplete="off">
                    </div>
                    <div class="form_send">
                        <button type="submit" class="btn">
                            <ion-icon name="send-sharp"></ion-icon>
                        </button>
                    </div>
                </form>
            </div>
        `;
    }
}

function createFriend (selector,arrResult) {
    let elementParent = document.querySelector(selector);
    if(elementParent) {
        elementParent.innerHTML = `
        <div class="header-top">
            <div class="avatar" style="background-image: url(${arrResult[0].dir});"></div>
            <span>Chat</span>
        </div>
        <div class="search">
            <form method="get" onsubmit="return false">
                <input type="text" name="search" placeholder="Tìm kiếm..." class="searching" autocomplete="off">
            </form>
            <div class="result__searching"></div>
        </div>
        <div class="list_message"></div>
        `;
    }
}

function renderHome () {
    let app = document.querySelector('.app');
    if(app) {
        $.ajax({
            url: './api/yourUser.php',
            method:'GET',
            async: false,
            success: function (result) {
                if(result != '') {
                    let arrResult = JSON.parse(result);
                    let isArray = Array.isArray(arrResult);
                    let length = arrResult.length;

                    if(isArray && length > 0) {
                        createFriend ('.app',arrResult);
                        searching ();
                        renderFiends ();
                        ClickRoom ();
                    }
                }
            }
        })
    }
}

renderHome ();

// lắng nghe và hiển thị tin nhắn
function renderFiends () {
    let list_message = document.querySelector('.list_message');
    if(list_message) {
        $.ajax({
            url: './api/list_friend.php',
            method:'GET',
            async: false,
            success: function (result) {
                if(result != '') {
                    let arrResult = JSON.parse(result);
                    let isArray = Array.isArray(arrResult);
                    let length = arrResult.length;

                    if(isArray && length > 0) {
                        for(let i=0;i<length;i++) {
                            let fullname = arrResult[i].first_name + ' ' +arrResult[i].last_name;
                            let room = arrResult[i].id_room;
                            list_message.innerHTML += `
                                <div class="list_message-item" data-room="${room}">
                                    <div class="list_message-avatar">
                                        <div class="avatar-icon" style="background-image: url(${arrResult[i].dir});"></div>
                                        <div class="icon-online"></div>
                                    </div>
                                    <div class="list_message-infor">
                                        <div class="infor_name">${fullname}</div>
                                        <div class="message_no_send">Đã có tin nhắn</div>
                                    </div>
                                </div>
                            `;
                        }
                    }
                }
            }
        })
    }
}

function ClickRoom () {
    let list_message_item = document.querySelectorAll('.list_message-item');
    if(list_message_item) {
        list_message_item.forEach(e => {
            e.onclick = () => {
                let room = e.getAttribute('data-room');
                createMsg ('.app');
                let elementView = document.querySelector('.views_message');
                elementView.setAttribute('data-room',room);
                send_msg (room);
                render_message ();
                preHome ();
            }
        })
    }
}

let render_time;
function render_message () {
    let views_message = document.querySelector('.views_message');
    let header__msg = document.querySelector('.header__msg');

    if(views_message&&header__msg) {
        let room = views_message.getAttribute('data-room');
        $.ajax({
            url: './api/detail_message.php',
            method:'GET',
            data: {
                room: room
            },
            async: false,
            success: function (result) {
                if(result != '') {
                    views_message.innerHTML = '';
                    let arrResult = JSON.parse(result);
                    header__msg.innerHTML = `
                    <div class="msg__infor">
                        <div class="msg__back">
                            <ion-icon name="arrow-back-sharp"></ion-icon>
                        </div>
                        <div class="msg__name">
                            <div class="list_message-avatar msg">
                                <div class="avatar-icon" style="background-image: url(${arrResult['friend'].dir})"></div>
                                <div class="icon-online"></div>
                            </div>
                            <div class="list_message-infor">
                                <div class="infor_name">${arrResult['friend'].name}</div>
                                <div class="message_no_send">Đang hoạt động</div>
                            </div>
                        </div>
                    </div>
                    <div class="msg__status">i</div>
                    `;
                    arrResult['data'].forEach(e=>{
                        views_message.innerHTML += `
                            <div class="list_message-item msg_item ${e.your==1?'msg_right':''}">
                                ${
                                    e.your != 1?`
                                    <div class="list_message-avatar msg_avt">
                                        <div class="avatar-icon" style="background-image: url(${e.dir})"></div>
                                    </div>
                                    `:''
                                }
                                <div class="list_message-infor desc">
                                    <span class="content">${e.message_content}</span>
                                    <span class="datetime">${e.date_time}</span>
                                </div>
                            </div>
                        `;
                    })
                }
            }
        })
        // render_time = setTimeout(render_message,10);
    } else {
        // clearTimeout(render_time);
    }
}

function preHome () {
    let msg__back = document.querySelector('.msg__back');
    if(msg__back) {
        msg__back.onclick = function () {
            renderHome ();
        }
    }
}

function send_msg (room) {
    let message_form = document.querySelector('.message_form');
    if(message_form) {
        message_form.onsubmit = function (e) {
            e.preventDefault();
            let enableInput = message_form.querySelectorAll(':is(input,select)[name]:not([disabled])');
            let isErorr = false;
            let fromValue = Array.from(enableInput).reduce((values, input)=>{
                if(input.value == '') {
                    isErorr = true;
                    return;
                }
                values[input.name] = input.value
                return values;
            }, {})
            if(!isErorr) {
                fromValue = {
                    ...fromValue,
                    room: room
                }
                $.ajax({
                    url: './api/send_msg.php',
                    method:'GET',
                    data: fromValue,
                })
                render_message ();
                
                enableInput.forEach(e=>{
                    e.value='';
                    e.focus();
                })
            }
        }
    }

}