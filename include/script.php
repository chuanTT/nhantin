<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./assets/js/validate.js"></script>
<script>
    function viewPwd (selectorEye,selector,{
        eye = '',
        offEye = ''
    }) {
        let eyeEl = document.querySelector(selectorEye);
        let pwd = document.querySelector(selector);
        let onEyel = document.querySelector(eye);
        let offEyel = document.querySelector(offEye);
        let isClick = false;
        if(eyeEl&&pwd&&onEyel&&offEyel) {
            eyeEl.onclick = function () {
                if(!isClick) {
                    pwd.type = 'text';
                    offEyel.classList.remove('offEye');
                    onEyel.classList.add('offEye');
                    isClick = true;
                } else {
                    pwd.type = 'password';
                    onEyel.classList.remove('offEye');
                    offEyel.classList.add('offEye');
                    isClick = false;
                }
            }
        }
    }

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>