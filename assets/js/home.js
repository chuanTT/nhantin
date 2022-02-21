// chức năng tìm kiếm
function searching () {
    let searching = document.querySelector('.searching');
    let result__searching = document.querySelector('.result__searching');
    if(searching&&result__searching) {
        searching.oninput = function () {
            let name = searching.name;
            let value = searching.value;
            let object = {
                [name]: value
            }
                $.ajax(
                    {
                        url: "./api/search.php",
                        type: 'GET',  // http method
                        data: object,
                        success: function(result){
                            let resultSearch = JSON.parse(result);
                            result__searching.innerHTML = '';
                            if(Array.isArray(resultSearch)&&resultSearch.length > 0) {
                                result__searching.style.display = 'block';
                                for(let i=0;i<resultSearch.length;i++) {
                                    result__searching.innerHTML += `
                                    <div class="list_message-item">
                                        <div class="list_message-avatar">
                                            <div class="avatar-icon" style="background-image: url(${resultSearch[i].dir});"></div>
                                            <div class="icon-online"></div>
                                        </div>
                                        <div class="list_message-infor">
                                            <div class="infor_name">
                                                ${(resultSearch[i].first_name)} ${(resultSearch[i].last_name)}
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                }
                            } else {
                                result__searching.innerHTML = '';
                                result__searching.style.display = 'none';
                            }
                        }
                    }
                );
        }
    }
}

searching ();

let updateRenderFriends;
function renderFriends () {
    let list_message = document.querySelector('.list_message');
    if(list_message) {
        $.ajax({
            url: './api/list_friend.php',
            method:'POST',
            success: function (result) {
                list_message.innerHTML ='';
                if(result != '') {
                    let resultArr = JSON.parse(result);
                    resultArr.forEach(e => {
                        list_message.innerHTML += `
                        <div class="list_message-item" data-room=${e.room} onclick="clickRoom(${e.room})">
                            <div class="list_message-avatar">
                                <div class="avatar-icon" style="background-image: url(${e.dir});"></div>
                                ${e.active_now == 1?'<div class="icon-online"></div>':''}
                            </div>
                            <div class="list_message-infor">
                                <div class="infor_name">${e.first_name+' '+e.last_name}</div>
                                <div class="message_no_send">${e.msg}</div>
                            </div>
                        </div>`;
                    });
                }
            }
        })
    } else {
        clearInterval(updateRenderFriends);
    }
}

renderFriends();



function clickRoom(room) {
    location.href = `./message.php?room=${room}`;
}

