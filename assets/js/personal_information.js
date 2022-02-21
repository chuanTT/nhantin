validate ({
    form: '.personal_form',
    formGroupSelector: '.form-group',
    selectMessage: '.message-erorr',
    rules: [],
    onSubmit: function (data) {
        let formElement = document.querySelector('.personal_form');
        let fData = new FormData(formElement);

        $.ajax({
            url: './api/update_user.php',
            method:'POST',
            data: fData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if(result != '') {
                    let resultArr = JSON.parse(result);

                    if(resultArr.dir) {
                        let avatar = document.querySelector('.avatar');
                        let imgThumbnail = document.querySelector('.information_thumbnail > img');

                        avatar.style.backgroundImage = `url('${resultArr.dir}')`;
                        imgThumbnail.src = `${resultArr.dir}`;
                    }
                }
            }
        })
    }
})


let avatar = document.querySelector('#avatar');
let imgThumbnail = document.querySelector('.information_thumbnail > img');
let temporary_url = [];

function url (e) {
    if(parseInt(temporary_url.length) > 0) {
       URL.revokeObjectURL(temporary_url[0]);
       temporary_url.shift();
    }

    let file = e.target.files[0];
    let srcImg = URL.createObjectURL(file);

    temporary_url.push(URL.createObjectURL(file));
    imgThumbnail.src = srcImg;
}
avatar.addEventListener('change',url);