viewPwd ('.password~.eye','.password',{
    eye: '.password~.eye>[name="eye-outline"]',
    offEye: '.password~.eye>[name="eye-off-outline"]'
});

viewPwd ('.confirmPassword~.eye','.confirmPassword', {
    eye: '.confirmPassword~.eye > [name="eye-outline"]',
    offEye: '.confirmPassword~.eye > [name="eye-off-outline"]' 
});

validate ({
    form: '.registration-form',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    submitSelect: '.registration_submit',
    rules: [
        validate.isRequired('.first_name','Họ không được để trống'),
        validate.isRequired('.last_name','Tên không được để trống'),
        validate.isRequired('.username','Tên không được để trống'),
        validate.isAjaxRequired('.username',{
            url: './api/validateUser.php',
            method: 'POST',
            nameElement: 'username'
        },'Tên đăng nhập đã tồn tại'),
        validate.isRequired('.email','Email không được để trống'),
        validate.isEmail('.email','Email không đúng định dạng'),
        validate.isAjaxRequired('.email',{
            url: './api/validateEmail.php',
            method: 'POST',
            nameElement: 'email'
        },'Email đã tồn tại'),
        validate.isRequired('.password','Mật khẩu không được để trống'),
        validate.isMin('.password',6),
        validate.isRequired('.confirmPassword','Xác nhận mật khẩu không được để trống'),
        validate.isConfirm('.confirmPassword',function () {
            return document.querySelector('.registration-form .password').value;
        },'Xác nhận mật khẩu không khớp')
    ],
    onSubmit: function (data) {
        $.ajax({
            url: './api/registration.php',
            method:'POST',
            data: data,
            success: function (result) {
                let resultRg = JSON.parse(result);
                let messageErorr =  document.querySelector('.registration-form > .message-erorr');
                let color;
                if(resultRg.status === 200) {
                    color='#04b547';
                    messageErorr.style.color = color;
                    messageErorr.innerText = resultRg.msg;
                    
                } else {
                    color = '#d51010';
                    messageErorr.style.color = color;
                    messageErorr.innerText = resultRg.msg;
                }
            }
        })
    }
})