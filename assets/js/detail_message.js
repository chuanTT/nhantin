function renderMsg () {
    let views_message = document.querySelector('.views_message');
    if(views_message) {
        let room = views_message.getAttribute('data-room');

        if(room) {

            $.ajax({
                url: './api/detail_message.php',
                method:'GET',
                data: {
                    room: room,
                },
                success: function (result) {
                    if(result != '') {
                        let resultArr = JSON.parse(result);
                        views_message.innerHTML = '';
                        resultArr.forEach(e=>{
                            let className;
                            if(e.your==1) {
                                className = 'msg_right'
                            } else {
                                className = ''
                            }
                            views_message.innerHTML += `
                            <div class="list_message-item msg_item ${className}" onclick="addClass(this)">
                                <div class="list_message-avatar msg_avt">
                                    <div class="avatar-icon" style="background-image: url('${e.dir}')"></div>
                                </div>
                                <div class="list_message-infor desc">
                                    <span class="content">${e.msg}</span>
                                    <span class="datetime">${e.date}</span>
                                </div>
                            </div>
                            `;
                        })
                        // console.log(views_message.clientWidth);               
                        // console.log(views_message.scrollTop);               
                        // if(parseInt(views_message.scrollTop) >= parseInt(views_message.scrollHeight)) {
                        //     views_message.scrollTop(0,views_message.scrollHeight)
                        // }
                    }
                }
            })
        }
    }
}
// setInterval(renderMsg,1000);
renderMsg ();

function addClass (e) {
    let showTime = e.querySelector('.desc');
    showTime.classList.toggle('showTime');
}


// function scroll_bottom () {
//     let views_message = document.querySelector('.views_message');

//     views_message.scrollTop(views_message.scrollHeight,0);
// }

// scroll_bottom ();


function send_msg () {
    let message_form = document.querySelector('.message_form');
    let views_message = document.querySelector('.views_message');
    if(message_form&&views_message) {
        let room = views_message.getAttribute('data-room');
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

                enableInput.forEach(e=>{
                    e.value='';
                    e.focus();
                })
            }
        }
    } 
}

send_msg ();


function change_photos () {
    let thumbnail = document.querySelector('#thumbnail');
    let attachs_views = document.querySelector('.attachs_views');
    let arrPhoto = [];
    
    function change_photo (e) {
        let _this = e.target;
    
        if(_this) {
            let list_file = _this.files;
            let index = list_file.length;
    
            if(index >= 1) { 
                for(let i=0;i<index;i++) {
                    let img = URL.createObjectURL(list_file[i]);
                    attachs_views.innerHTML += `
                    <div class="attachs_views-items">
                        <img src="${img}" alt="">
                        <ion-icon name="close-outline" class="close"></ion-icon>
                    </div>`;
                }
            } else {
                
            }
    
            console.log(list_file);
        }
    }
    thumbnail.addEventListener('change',change_photo);
}

change_photos ();





