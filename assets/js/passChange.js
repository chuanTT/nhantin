viewPwd ('.pass~.eye','.pass', {
    eye: '.pass~.eye > [name="eye-outline"]',
    offEye: '.pass~.eye > [name="eye-off-outline"]' 
});

viewPwd ('.passChange~.eye','.passChange', {
    eye: '.passChange~.eye > [name="eye-outline"]',
    offEye: '.passChange~.eye > [name="eye-off-outline"]' 
});


validate ({
    form: '.change-login',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    submitSelect: '.change_submit',
    rules: [
        validate.isRequired('.pass','Mật khẩu không được để trống'),
        validate.isMin('.pass',6),
        validate.isRequired('.passChange','Mật khẩu không được để trống'),
        validate.isConfirm('.passChange',function () {
            return document.querySelector('.change-login .pass').value;
        },'Xác nhận mật khẩu không khớp')
    ],
    onSubmit: function (data) {
        console.log(data);
        $.ajax({
            url: './api/change_password.php',
            method:'POST',
            data: data,
            success: function (result) {
                console.log(result);
                if(result) {
                    let resultList = JSON.parse(result);
                    if(resultList.status == 200) {
                        console.log('ok');
                        location.href = './login.php';
                    } else {
                        document.querySelector('.change-login > .message-erorr').innerText = "Thay đổi dữ liệu không thành công";
                    }
                }
            }
        })
    }
})