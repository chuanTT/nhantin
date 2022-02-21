validate ({
    form: '.forgot-login',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    submitSelect: '.forgot_submit',
    rules: [
        validate.isRequired('.email','Email không được để trống'),
        validate.isEmail('.email','Email không đúng định dạng')
    ],
    onSubmit: function (data) {
        $.ajax({
            url: './api/send_email.php',
            method:'GET',
            data: data,
            success: function (result) {
                if(result != '') {
                    let resultList = JSON.parse(result);
                    if(resultList.status == 200) {
                        location.href = `./confirmPass.php?email=${data.email}`;
                    } else {
                        console.log(resultList.msg);
                    }
                }
            }
        })
    }
})
