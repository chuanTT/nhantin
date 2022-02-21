function validate (options) {

    function fromStyleCss (options,msg_display = true) {
        let isFormValid = true;
        options.rules.forEach(rule=> {
            let inputElement = formElement.querySelector(rule.select);
            let valid = hanelVaidate(inputElement,rule,msg_display);

            if(!valid) {
                isFormValid = false;
            }
        })

        return isFormValid;
    }
    
    function getParent(element,selector) {
        while(element.parentElement) {
            if(element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }
    function hanelVaidate (inputElement,rule,cssSubmitForm = true) {

        let parentElementform = getParent(inputElement,options.formGroupSelector);
        let elementErorr = parentElementform.querySelector(options.selectMessage);
        let errorMsg;
        let rules = arrayRules[rule.select];

        for(let i=0;i<rules.length;++i) {
            errorMsg = rules[i](inputElement.value);
            if(errorMsg) break;
        }
        if(cssSubmitForm) {
            if(errorMsg) {
                elementErorr.innerText = errorMsg;
                parentElementform.classList.add('invalid');
            } else {
                elementErorr.innerText = '';
                parentElementform.classList.remove('invalid');
            }
        }

        return !errorMsg;
    }

    let formElement = document.querySelector(options.form);
    let arrayRules = {};

    if(formElement) {
        let InvalidSubmit = false;
        if(options.rules.length <= 0) InvalidSubmit = true;

        formElement.onsubmit = function (e) {
            e.preventDefault();

            if(InvalidSubmit) {
                let isFormValid = fromStyleCss (options);
                if(isFormValid) {
                    if(typeof options.onSubmit === 'function') {
                        let enableInput = formElement.querySelectorAll(':is(input,select)[name]:not([disabled],[type=file])');
                       
                        let fromValue = Array.from(enableInput).reduce((values, input)=>{
                            values[input.name] = input.value
                            return values;
                        }, {})

                        options.onSubmit(fromValue);
                    } else {
                        formElement.submit();
                    }
                }
            }
        }

        options.rules.forEach(rule => {
            let inputElement = formElement.querySelector(rule.select);
            if(inputElement) {
                if(Array.isArray(arrayRules[rule.select])) {
                    arrayRules[rule.select].push(rule.test)
                } else {
                    arrayRules[rule.select] = [rule.test];
                }

                inputElement.onblur = function () {
                    hanelVaidate(inputElement,rule);
                }

                inputElement.oninput = function () {
                    let elementErorr = getParent(inputElement,options.formGroupSelector).querySelector(options.selectMessage);
                    elementErorr.innerText = '';
                    getParent(inputElement,options.formGroupSelector).classList.remove('invalid');

                    InvalidSubmit = fromStyleCss (options,false);
                    let submitElement = document.querySelector(options.submitSelect);
                    if(InvalidSubmit) {
                        if(submitElement) {
                            submitElement.classList.remove('btn-gray');
                            submitElement.classList.add('btn-primary');
                        }
                    } else {
                        if(submitElement) {
                            if(submitElement.classList.contains('btn-primary')) {
                                submitElement.classList.remove('btn-primary');
                            }
                            if(!submitElement.classList.contains('btn-gray')) {
                                submitElement.classList.add('btn-gray');
                            }
                        }
                    }
                }
            }
        });
    }
}

validate.isRequired = function (select,msg) {
    return {
        select,
        test: function (value) {
            return value.trim() ? undefined : msg || 'Vui lòng nhập trường này';
        }
    }
}

validate.isEmail = function (select,msg) {
    return {
        select,
        test: function (value) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined: msg || 'Trường này không phải là email';
        }
    }
}

validate.isMin = function (select, min,msg) {
    return {
        select,
        test: function (value) {
            return value.length >= min?undefined: msg ||`Giá trị phải nhập tối thiểu ${min} ký tự`;
        }
    }
}

validate.isConfirm = function (select, confirmPwd,msg) {
    return {
        select,
        test: function (value) {
            return value === confirmPwd()?undefined: msg||'Không trùng khớp với trường trên';
        }
    }
}

validate.isAjaxRequired = function (select, objectAjax,msg) {
    return {
        select,
        test: function (value) {
            let {url, method, nameElement} = objectAjax;
            let error;
            let objectValue = {
                [nameElement]: value
            }
            $.ajax(
                {
                    url: url,
                    type: method,  // http method
                    data: objectValue,
                    async: false,
                    success: function(result){
                        let resultArr = JSON.parse(result);

                        if(resultArr.status == 200) {
                            error = undefined;
                        } else {
                            error = msg || 'giá trị mặt định';
                        }

                        return error;
                    }
                }
            );

            return error;
        }
    }

}