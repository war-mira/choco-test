class LVG {
    constructor() {
        this.container = document.querySelector('.page--lvg');
        this.autocompletes = [];
        this.user = {};
        this.timer = null;
    }

    init() {
        let _self = this;
        this.initAutocomplete();
        this.container.querySelectorAll('.form--input input').forEach(function (input) {
            input.addEventListener('input', function (evt) {
                evt.target.classList.remove('error');
            });
        });

        $('input[name="phone"]').mask("+7 (999) 999-9999");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    }

    fillUser() {
        let form = document.querySelector('.form--begin');
        let _self = this;
        form.querySelectorAll('.form--input').forEach(function (input) {
            input = input.querySelector('input');
            if (input.getAttribute('data-id') !== null) {
                _self.user[input.getAttribute('name')] = {
                    value: input.value,
                    id: input.getAttribute('data-id')
                }
            } else {
                _self.user[input.getAttribute('name')] = input.value;
            }
        });

        form.querySelectorAll('.form--checkbox input').forEach(function (checkbox) {
            _self.user[checkbox.getAttribute('name')] = checkbox.checked;
        });
    }

    saveUser(target) {
        let _self = this;
        target.classList.add('saving');
        $.post('/actions/best-doctor-2018/create', _self.user)
            .done(function (response) {
                if (response.code == 200) {
                    _self.user.doctor_id = response.data.doctor_id;
                    _self.goToStep(target.getAttribute('data-next-step'), 'begin')
                }
                target.classList.remove('saving');
            }).fail(function (data) {
            console.log(data);
            target.classList.remove('saving');
        })

    }

    stepBegin(target) {
        let validate = this.validateBeginForm();
        if (validate === true) {

            this.fillUser();
            this.saveUser(target);
        } else {
            if (Array.isArray(validate)) {
                validate.forEach(function (msg) {
                    console.log(msg);
                })
            } else {
                console.log(validate);
            }

        }
    }
    stepReSendSms(target){
        this.sendSms(target);
    }
    stepSendSms(target) {

        let validate = this.validateRegisterForm();
        if (validate === true) {
            let form = document.querySelector('.form--register');

            //this.user.email = form.querySelector('.form--input input[name="email"]').value;
            this.user.phone = form.querySelector('.form--input input[name="phone"]').value;

            this.sendSms(target);
        } else {
            if (Array.isArray(validate)) {
                validate.forEach(function (msg) {
                    console.log(msg);
                })
            } else {
                console.log(validate);
            }

        }
    }
    enableTimer(){
        let _self = this;
        let timer = this.container.querySelector('.timer');
        timer.classList.remove('timeout');
        timer.classList.remove('hidden');
        let counter = timer.querySelector('.counter span');
        counter.innerHTML = "60";
        let digit = parseInt(counter.innerText);
        this.timer = setInterval(()=>{
            if(digit > 0){
                digit--;
            }
            counter.innerHTML = this.leadingZero(digit);
        },1000);
        setTimeout(() => {
            clearTimeout(this.timer);
            this.timer = null;
            this.showResendButton()
        },60000)
    }
    leadingZero(num)
    {
        let s = String(num);
        if (s.length < 2) {s = "0" + s;}
        return s;
    }

    showResendButton(){
        let counter = this.container.querySelector('.timer');
        counter.classList.add('timeout');
    }
    sendSms(target) {
        let _self = this;
        target.classList.add('saving');
        $.post('/actions/best-doctor-2018/register', _self.user)
            .done(function (response) {
                if (response.code == 200) {
                    _self.showSmsCheck();
                    _self.enableTimer();
                }
                target.classList.remove('saving');
            }).fail(function (data) {
            data = data.responseJSON;
            if (data.msg.hasOwnProperty('validator')) {
                alert(data.msg.validator.phone[0]);
            } else {
                alert(data.msg);
            }
            target.classList.remove('saving');
        })
    }

    showSmsCheck() {
        let form = document.querySelector('.form--register');
        form.querySelector('.smscheck').classList.remove('hidden');
        let btn = form.querySelector('.btn[data-step="SendSms"]');
        if(btn){
            btn.setAttribute('data-step', 'ValidateSms');
        }
    }

    stepValidateSms(target) {
        let _self = this;
        let form = document.querySelector('.form--register');
        let code = form.querySelector('.smscheck input').value.trim();
        if(!code.length){
            confirm('Введите код');
            return false;
        }
        $.post('/actions/best-doctor-2018/check', {
            'user': _self.user,
            'code': form.querySelector('.smscheck input').value
        })
            .done(function (response) {
                if (response.code == 200) {
                    window.location.href = '/actions/best-doctor-2018/vote';
                } else if (response.code == 401) {
                    let goAuth = confirm(response.msg);
                    if (goAuth) {
                        window.location.href = '/actions/best-doctor-2018/vote';
                    } else {
 
                    }
                }
            })
            .fail(function (data) {
                data = data.responseJSON;

                alert(data.msg);

            })
    }

    goToStep(step, old) {
        let old_form = this.container.querySelector(`.form--${old}`);
        let form = this.container.querySelector(`.form--${step}`);
        old_form.classList.add('hide');
        setTimeout(() => {
            form.classList.remove('hide');
        }, 200);

    }

    validateBeginForm() {
        let _self = this;
        let form = document.querySelector('.form--begin');
        let messages = [];
        let not_validate = [
            'medcenter_name'
        ];

        form.querySelectorAll('.form--input').forEach(function (input) {
            let input__field = input.querySelector('input');
            let label = input.querySelector('label');
            if(!not_validate.includes(input__field.name)){
                if (!input__field.value.trim().length) {
                    _self.markAsError(input__field);
                    messages.push(`${label === null ? input__field.getAttribute('name') : label.innerText} не заполнено`);
                }
            }

        });

        return messages.length ? messages : true;
    }

    validateRegisterForm() {
        let _self = this;
        let messages = [];
        let form = document.querySelector('.form--register');
        let input = form.querySelector('.form--input input[name="phone"]');
        if (!input.value.trim().length) {
            _self.markAsError(input);
            messages.push(`${input.getAttribute('name')} не заполнено`);
        }

        return messages.length ? messages : true;
    }

    markAsError(input) {
        input.classList.add('error');
    }

    initAutocomplete() {
        let _self = this;
        this.container.querySelectorAll('.autocomplete').forEach(function (item) {
            let autocomplete = new AutoComplete(item);
            autocomplete.init();
            _self.autocompletes.push(autocomplete);
        });

        this.container.querySelectorAll('.form--buttons .btn').forEach(function (item) {
            item.addEventListener('click', function (e) {
                let target = e.target;
                _self['step' + target.getAttribute('data-step')](target);
            })
        })
    }
}

if (document.querySelector('.page--lvg__main')) {
    let lvg = new LVG();
    lvg.init();
}