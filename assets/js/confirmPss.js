function formConfirm () {
    let formConfirm = document.querySelector('.formConfirm');
    let confirmsubmit = document.querySelector('.submit > button');
    let codeElement = document.querySelectorAll('.code > input');
    if(formConfirm&&confirmsubmit&&codeElement) {
        formConfirm.onsubmit = function (e) {
            e.preventDefault();
            let enableInput = formConfirm.querySelectorAll(':is(input,select)[name]:not([disabled])');
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
                $.ajax({
                    url: './api/send_email.php',
                    method:'GET',
                    data: fromValue,
                    success: function (result) {
                        if(result != '') {
                            let arrResult = JSON.parse(result);
                            if(arrResult.status == 200) {
                                location.href = './changePss.php';
                            }  
                        }
                    }
                })
            }
    
        }
        codeElement.forEach(e => {
            e.oninput = function () {
                let isFormValid = true;
                codeElement.forEach(e=> {
                    let valid = e.value;
                    if(!valid) {
                        isFormValid = false;
                    }
                })

                if(isFormValid) {
                    if(confirmsubmit) {
                        confirmsubmit.classList.remove('btn-gray');
                        confirmsubmit.classList.add('btn-primary');
                    }
                } else {
                    if(confirmsubmit) {
                        if(confirmsubmit.classList.contains('btn-primary')) {
                            confirmsubmit.classList.remove('btn-primary');
                        }
                        if(!confirmsubmit.classList.contains('btn-gray')) {
                            confirmsubmit.classList.add('btn-gray');
                        }
                    }
                }
            }
        })
    }
}

formConfirm ();

let timeSecond = 45;
let timeElement = document.querySelector('.re-time');
function time () {
    timeElement.innerText = timeSecond;
    timeSecond--;
    if(timeSecond < 0) {
        clearInterval(timeR);
        let to_email = document.querySelector('.to-email');
        let re_send = document.querySelector('.re-send');

        re_send.style.cursor = "pointer";
        re_send.style.color = "#006b95";
        re_send.addEventListener('click',sendEmail);

        function sendEmail () {
            $.ajax({
                url: './api/send_email.php',
                method:'GET',
                data: {
                    "email": to_email.innerText
                },
                success: function (result) {
                    if(result != '') {
                        let resultList = JSON.parse(result);
                        if(resultList.status == 200) {
                            timeSecond = 45;
                            timeR = setInterval(time,1000);
                        }
                    }
                }
            })
        }

        return;
    }
}

let timeR = setInterval(time,1000);