class LVGVote {
    constructor() {
        this.container = document.querySelector('.page--lvg');
        this.autocompletes = [];
        this.users = [];
        this.current = 1;
        this.limit = 5;
    }

    initAutocomplete() {
        let _self = this;
        this.container.querySelectorAll('.autocomplete__lastname').forEach(function (item) {
            _self.initLastnameAutocomplete(item, _self);
        });


        this.container.querySelectorAll('.autocomplete__skill').forEach(function (item) {
            _self.initSkillAutocomplete(item, _self);
        });

    }

    initSkillAutocomplete(item, _self) {
        let autocomplete = new AutoComplete(item, 'autocomplete__item--skill');
        autocomplete.init();
        _self.autocompletes.push(autocomplete);
    }

    initLastnameAutocomplete(item, _self) {
        let autocomplete = new AutoComplete(item);
        autocomplete.setInputValue = function (target) {

            let parent = target.closest('.form--row');
            let skill_input = parent.querySelector('input[name="skill"]');

            let firstname = parent.querySelector('input[name="firstname"]');
            firstname.value = target.querySelector('.firstname').innerText;
            firstname.classList.remove('error');

            let lastname = parent.querySelector('input[name="lastname"]');
            lastname.value = target.querySelector('.lastname').innerText;
            lastname.classList.remove('error');

            let middlename = parent.querySelector('input[name="middlename"]');
            middlename.value = target.querySelector('.middlename').innerText;
            middlename.classList.remove('error');

            for (let attr_name in target.dataset) {
                if (attr_name == 'skill') {
                    skill_input.value = target.dataset[attr_name];
                    skill_input.setAttribute('data-id', target.dataset['skill_id']);
                    skill_input.classList.remove('error');
                } else {
                    this.input.setAttribute(`data-${attr_name}`, target.dataset[attr_name]);
                }
            }
            this.closeDropdown()
        };
        autocomplete.init();
        _self.autocompletes.push(autocomplete);
    }

    initAddDoctor() {
        let _self = this;
        this.container.querySelector('.add_doctor').addEventListener('click', function (e) {
            if (_self.current < 5) {
                let template = _.template(document.getElementById('form--row').innerHTML);
                let row = _self.parseHTML(template());
                _self.container.querySelector('.vote--form .additional--rows').appendChild(row);
                _self.initLastnameAutocomplete(row.querySelector('.autocomplete__lastname'), _self);
                _self.initSkillAutocomplete(row.querySelector('.autocomplete__skill'), _self);
                _self.current++;
            } else{ 
                e.target.classList.add('hidden');
            }
        });
    }

    validateForm() {
        let _self = this;
        let rows = this.container.querySelectorAll('.form--row');
        let msgs = [];
        this.users = [];
        rows.forEach(function (row) {
            if (!row.classList.contains('add_doctor')) {
                let validate = _self.validateRow(row);
                if (!validate) {
                    msgs.push(validate);
                } else {
                    _self.addUser(row);
                }
            }
        });

        return msgs.length ? msgs : true;
    }

    addUser(row) {
        let _self = this;
        let inputs = row.querySelectorAll('.form--input');
        let user = {};
        inputs.forEach(function (item) {
            let input = item.querySelector('input');
            if (input.getAttribute('data-id') !== null) {
                user[input.getAttribute('name')] = {
                    value: input.value,
                    id: input.getAttribute('data-id')
                }
            } else {
                user[input.getAttribute('name')] = input.value;
            }
        });

        this.users.push(user);

    }

    validateRow(row) {
        let _self = this;
        let errors = [];
        let user = {};
        row.querySelectorAll('.form--input').forEach(function (item) {
            let label = item.querySelector('label');
            let input = item.querySelector('input');
            if (!input.value.trim().length) {
                _self.markAsError(input);
                input.placeholder = 'Заполните это поле';
                errors.push(`${label === null ? input.getAttribute('name') : label.innerText} не заполнено`);
            } else{
                if (input.getAttribute('data-id') !== null) {
                    user[input.getAttribute('name')] = {
                        value: input.value,
                        id: input.getAttribute('data-id')
                    }
                } else {
                    user[input.getAttribute('name')] = input.value;
                }
            }
        });

        if(_.has(user,'lastname.id')){
            let needle = _.filter(this.users, { lastname:  { id: user.lastname.id } });
            if(needle.length){
                if(_.isEqual(user,_.first(needle)) || user.lastname.id == _.first(needle).lastname.id){
                    _self.cleanRow(row);
                    confirm('Вы не можете голосовать дважды за одного врача');
                    return false;
                }

            }
        }
        return errors.length ? false : true;

    }
    showEnd(){
        let main = this.container.querySelector('.main');
        let end = this.container.querySelector('.end');
        main.classList.add('hide');
        setTimeout(()=>{
            end.classList.remove('hide');
        },200)
    }
    save() {
        let _self = this;
        $.post('/actions/best-doctor-2018/postVote', {
            'users': _self.users
        })
            .done(function (response) {
                if (response.code == 200) {
                  _self.showEnd();
                }
            })
            .fail(function (data) {
                data = data.responseJSON;
                alert(data.msg);
                if(data.code == 419){
                    _self.showEnd();
                }

            })
    }

    cleanRow(row) {
        let _self = this;
        row.querySelectorAll('input').forEach(function(input){
            input.value = '';
            _self.markAsError(input);
            input.placeholder = 'Заполните это поле';
        })
    }

    saveForm() {
        let validate = this.validateForm();
        if (validate === true) {
            this.save();
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

    markAsError(input) {
        input.classList.add('error');
    }

    parseHTML(str) {
        let tmp = document.implementation.createHTMLDocument();
        tmp.body.innerHTML = str;
        return tmp.body.children[0];
    }

    initVoteButton() {
        let _self = this;
        this.container.querySelector('.vote').addEventListener('click', function (e) {
            _self.saveForm();
        });
    }

    init() {
        this.initAutocomplete();
        this.initAddDoctor();
        this.initVoteButton();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        this.container.querySelectorAll('.form--input input').forEach(function (input) {
            input.addEventListener('input', function (evt) {
                evt.target.placeholder = '';
                evt.target.classList.remove('error');
            });
        });
    }
}

if (document.querySelector('.page--lvg__vote')) {
    let lvg_vote = new LVGVote();
    lvg_vote.init();
}

