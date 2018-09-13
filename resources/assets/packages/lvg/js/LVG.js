class LVG {
    constructor() {
        this.container = document.querySelector('.page--lvg');
        this.autocompletes = [];
        this.user = {}
    }

    init() {
        let _self = this;
        this.initAutocomplete();
        this.container.querySelectorAll('.form--input input').forEach(function(input){
            input.addEventListener('input', function (evt) {
                evt.target.classList.remove('error');
            });
        });
    }
    fillUser(){
        let form = document.querySelector('.form--begin');
        let _self = this;
        form.querySelectorAll('.form--input').forEach(function (input) {
            input = input.querySelector('input');
            _self.user[input.getAttribute('name')] = input.value;
        });
    }
    stepBegin(target) {
        let validate = this.validateBeginForm();
        if (validate === true) {
            this.fillUser();
            this.goToStep(target.getAttribute('data-next-step'),'begin')
        } else {
            if(Array.isArray(validate)){
                validate.forEach(function(msg){
                    console.log(msg);
                })
            } else{
                console.log(validate);
            }

        }
    }

    goToStep(step,old) {
        let old_form = this.container.querySelector(`.form--${old}`);
        let form = this.container.querySelector(`.form--${step}`);
        old_form.classList.add('hide');
        setTimeout(() => {
            form.classList.remove('hide');
        },200);

    }

    validateBeginForm() {
        let _self = this;
        let form = document.querySelector('.form--begin');
        let messages = [];
        form.querySelectorAll('.form--input').forEach(function (input) {
            let input__field = input.querySelector('input');
            let label = input.querySelector('label');
            if (!input__field.value.trim().length) {
                _self.markAsError(input__field);
                messages.push( `${label===null?input__field.getAttribute('name'):label.innerText} не заполнено`);
            }
        });

        return messages.length?messages:true;
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


let lvg = new LVG();
lvg.init();
