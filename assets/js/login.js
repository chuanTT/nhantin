viewPwd ('.password~.eye','.password',{
    eye: '.password~.eye>[name="eye-outline"]',
    offEye: '.password~.eye>[name="eye-off-outline"]'
});

validate ({
    form: '.login-form',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    submitSelect: '.login_submit',
    rules: [
        validate.isRequired('.inputname','Tên đăng nhập không được để trống'),
        validate.isRequired('.password','Mật khẩu không được để trống'),
        validate.isMin('.password',6),
    ],
    onSubmit: function (data) {
        $.ajax({
            url: './api/validate_login.php',
            method:'POST',
            data: data,
            success: function (result) {
                let resultList = JSON.parse(result);

                if(resultList.status == 200) {
                    location.reload();
                } else {
                    let elementErorr = document.querySelector('.login-form > .message-erorr');
                    if(elementErorr) {
                        elementErorr.innerText = resultList.msg;
                    }
                }
                
            }
        })
    }
})
