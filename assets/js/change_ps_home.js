viewPwd ('[name=password]~.eye','[name=password]',{
    eye: '[name=password]~.eye>[name="eye-outline"]',
    offEye: '[name=password]~.eye>[name="eye-off-outline"]'
});

viewPwd ('[name=new_password]~.eye','[name=new_password]', {
    eye: '[name=new_password]~.eye > [name="eye-outline"]',
    offEye: '[name=new_password]~.eye > [name="eye-off-outline"]' 
});

viewPwd ('[name=confrim_new_password]~.eye','[name=confrim_new_password]', {
    eye: '[name=confrim_new_password]~.eye > [name="eye-outline"]',
    offEye: '[name=confrim_new_password]~.eye > [name="eye-off-outline"]' 
});

validate ({
    form: '.home_change_ps',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    rules: [
        validate.isRequired('[name=password]','Mật khẩu cũ không được để trống'),
        validate.isMin('[name=password]',6),
        validate.isRequired('[name=new_password]','Mật khẩu mới không được để trống'),
        validate.isMin('[name=new_password]',6),
        validate.isRequired('[name=confrim_new_password]','Mật khẩu mới không được để trống'),
        validate.isConfirm('[name=confrim_new_password]',function () {
            return document.querySelector('.home_change_ps [name=new_password]').value;
        },'Xác nhận mật khẩu mới không khớp')
    ],
    onSubmit: function (data) {
        $.ajax({
            url: './api/change_pass_home.php',
            method:'POST',
            data: data,
            success: function (result) {
                if(result != '') {
                    let resultList = JSON.parse(result);
                    let msgErorr = document.querySelector('.home_change_ps .message-erorr');
                    if(resultList.status == 200) {
                        msgErorr.innerHTML = resultList.msg;
                        // location.href = `./confirmPass.php?email=${data.email}`;
                    } else {
                        msgErorr.innerHTML = resultList.msg;
                        // console.log(resultList.msg);
                    }
                }
            }
        })
    }
})