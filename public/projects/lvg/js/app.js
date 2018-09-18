var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var AutoComplete = function () {
    function AutoComplete(selector) {
        var autocomplete_item_id = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'autocomplete__item';
        var url = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

        _classCallCheck(this, AutoComplete);

        this.input = selector.querySelector('.autocomplete__input'); //DomElement
        this.url = url;
        this.dropdown = selector.querySelector('.autocomplete__list'); //DomElement
        this.autocomplete_item_id = autocomplete_item_id;
    }

    _createClass(AutoComplete, [{
        key: 'getUrl',
        value: function getUrl() {
            var url = this.input.getAttribute('data-url');
            if (url === null) {
                if (this.url) {
                    url = this.url;
                } else {
                    throw new Error('Set autocomplete Url');
                }
            }
            return url;
        }
    }, {
        key: 'get',
        value: function get() {
            var value = this.input.value;
            if (value.length > 2) {
                this.makeRequest(value);
            } else {
                this.closeDropdown();
            }
        }
    }, {
        key: 'makeRequest',
        value: function makeRequest(value) {
            var _self = this;
            $.get(this.getUrl(), {
                query: value,
                type: this.input.getAttribute('search')
            }).done(function (data) {
                if (data.length) {
                    _self.createDropdown(data);
                } else {
                    _self.closeDropdown();
                }
            });
        }
    }, {
        key: 'getItemTemplate',
        value: function getItemTemplate(id) {
            return _.template(document.getElementById(id).innerHTML);
        }
    }, {
        key: 'createDropdown',
        value: function createDropdown(data) {
            var _self = this;
            var text = '';

            data.forEach(function (item) {
                var template = _self.getItemTemplate(_self.autocomplete_item_id);
                text += template(item);
            });
            this.dropdown.querySelector('.list').innerHTML = text;
            this.dropdown.classList.add('show');
        }
    }, {
        key: 'clearInputAttributes',
        value: function clearInputAttributes() {
            for (var attr_name in this.input.dataset) {
                if (attr_name !== 'url') {
                    delete this.input.dataset[attr_name];
                }
            }
        }
    }, {
        key: 'init',
        value: function init() {
            var _self = this;
            this.input.addEventListener('input', function (evt) {
                _self.clearInputAttributes();
                _self.get(evt.target);
            });
            this.input.addEventListener('focusout', function (evt) {
                setTimeout(function () {
                    _self.closeDropdown();
                }, 300);
            });
            this.dropdown.addEventListener('click', function (evt) {
                _self.setInputValue(evt.target);
            });
        }
    }, {
        key: 'closeDropdown',
        value: function closeDropdown() {
            this.dropdown.querySelector('.list').scrollTo(0, 0);
            this.dropdown.classList.remove('show');
        }
    }, {
        key: 'setInputValue',
        value: function setInputValue(target) {
            this.input.value = target.innerText;
            for (var attr_name in target.dataset) {
                this.input.setAttribute('data-' + attr_name, target.dataset[attr_name]);
            }
            this.closeDropdown();
        }
    }]);

    return AutoComplete;
}();

var LVG = function () {
    function LVG() {
        _classCallCheck(this, LVG);

        this.container = document.querySelector('.page--lvg');
        this.autocompletes = [];
        this.user = {};
    }

    _createClass(LVG, [{
        key: 'init',
        value: function init() {
            var _self = this;
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
    }, {
        key: 'fillUser',
        value: function fillUser() {
            var form = document.querySelector('.form--begin');
            var _self = this;
            form.querySelectorAll('.form--input').forEach(function (input) {
                input = input.querySelector('input');
                if (input.getAttribute('data-id') !== null) {
                    _self.user[input.getAttribute('name')] = {
                        value: input.value,
                        id: input.getAttribute('data-id')
                    };
                } else {
                    _self.user[input.getAttribute('name')] = input.value;
                }
            });

            form.querySelectorAll('.form--checkbox input').forEach(function (checkbox) {
                _self.user[checkbox.getAttribute('name')] = checkbox.checked;
            });
        }
    }, {
        key: 'saveUser',
        value: function saveUser(target) {
            var _self = this;
            target.classList.add('saving');
            $.post('/actions/best-doctor-2018/create', _self.user).done(function (response) {
                if (response.code == 200) {
                    _self.user.doctor_id = response.data.doctor_id;
                    _self.goToStep(target.getAttribute('data-next-step'), 'begin');
                }
                target.classList.remove('saving');
            }).fail(function (data) {
                console.log(data);
                target.classList.remove('saving');
            });
        }
    }, {
        key: 'stepBegin',
        value: function stepBegin(target) {
            var validate = this.validateBeginForm();
            if (validate === true) {

                this.fillUser();
                this.saveUser(target);
            } else {
                if (Array.isArray(validate)) {
                    validate.forEach(function (msg) {
                        console.log(msg);
                    });
                } else {
                    console.log(validate);
                }
            }
        }
    }, {
        key: 'stepSendSms',
        value: function stepSendSms(target) {

            var validate = this.validateRegisterForm();
            if (validate === true) {
                var form = document.querySelector('.form--register');

                this.user.email = form.querySelector('.form--input input[name="email"]').value;
                this.user.phone = form.querySelector('.form--input input[name="phone"]').value;

                this.sendSms(target);
            } else {
                if (Array.isArray(validate)) {
                    validate.forEach(function (msg) {
                        console.log(msg);
                    });
                } else {
                    console.log(validate);
                }
            }
        }
    }, {
        key: 'sendSms',
        value: function sendSms(target) {
            var _self = this;
            target.classList.add('saving');
            $.post('/actions/best-doctor-2018/register', _self.user).done(function (response) {
                if (response.code == 200) {
                    _self.showSmsCheck();
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
            });
        }
    }, {
        key: 'showSmsCheck',
        value: function showSmsCheck() {
            var form = document.querySelector('.form--register');
            form.querySelector('.smscheck').classList.remove('hidden');
            var btn = form.querySelector('.btn[data-step="SendSms"]');
            btn.setAttribute('data-step', 'ValidateSms');
        }
    }, {
        key: 'stepValidateSms',
        value: function stepValidateSms(target) {
            var _self = this;
            var form = document.querySelector('.form--register');

            $.post('/actions/best-doctor-2018/check', {
                'user': _self.user,
                'code': form.querySelector('.smscheck input').value
            }).done(function (response) {
                if (response.code == 200) {
                    window.location.href = '/actions/best-doctor-2018/vote';
                } else if (response.code == 401) {
                    var goAuth = confirm(response.msg);
                    if (goAuth) {
                        window.location.href = '/actions/best-doctor-2018/vote';
                    } else {}
                }
            }).fail(function (data) {
                data = data.responseJSON;

                alert(data.msg);
            });
        }
    }, {
        key: 'goToStep',
        value: function goToStep(step, old) {
            var old_form = this.container.querySelector('.form--' + old);
            var form = this.container.querySelector('.form--' + step);
            old_form.classList.add('hide');
            setTimeout(function () {
                form.classList.remove('hide');
            }, 200);
        }
    }, {
        key: 'validateBeginForm',
        value: function validateBeginForm() {
            var _self = this;
            var form = document.querySelector('.form--begin');
            var messages = [];
            var not_validate = [];
            if (!this.container.querySelector('input[name="medcenter"]').checked) {
                not_validate.push('medcenter_name');
            }
            form.querySelectorAll('.form--input').forEach(function (input) {
                var input__field = input.querySelector('input');
                var label = input.querySelector('label');
                if (!not_validate.includes(input__field.name)) {
                    if (!input__field.value.trim().length) {
                        _self.markAsError(input__field);
                        messages.push((label === null ? input__field.getAttribute('name') : label.innerText) + ' \u043D\u0435 \u0437\u0430\u043F\u043E\u043B\u043D\u0435\u043D\u043E');
                    }
                }
            });

            return messages.length ? messages : true;
        }
    }, {
        key: 'validateRegisterForm',
        value: function validateRegisterForm() {
            var _self = this;
            var messages = [];
            var form = document.querySelector('.form--register');
            var input = form.querySelector('.form--input input[name="phone"]');
            if (!input.value.trim().length) {
                _self.markAsError(input);
                messages.push(input.getAttribute('name') + ' \u043D\u0435 \u0437\u0430\u043F\u043E\u043B\u043D\u0435\u043D\u043E');
            }

            return messages.length ? messages : true;
        }
    }, {
        key: 'markAsError',
        value: function markAsError(input) {
            input.classList.add('error');
        }
    }, {
        key: 'initAutocomplete',
        value: function initAutocomplete() {
            var _self = this;
            this.container.querySelectorAll('.autocomplete').forEach(function (item) {
                var autocomplete = new AutoComplete(item);
                autocomplete.init();
                _self.autocompletes.push(autocomplete);
            });

            this.container.querySelectorAll('.form--buttons .btn').forEach(function (item) {
                item.addEventListener('click', function (e) {
                    var target = e.target;
                    _self['step' + target.getAttribute('data-step')](target);
                });
            });
        }
    }]);

    return LVG;
}();

if (document.querySelector('.page--lvg__main')) {
    var lvg = new LVG();
    lvg.init();
}

var LVGVote = function () {
    function LVGVote() {
        _classCallCheck(this, LVGVote);

        this.container = document.querySelector('.page--lvg');
        this.autocompletes = [];
        this.users = [];
        this.current = 3;
        this.limit = 5;
    }

    _createClass(LVGVote, [{
        key: 'initAutocomplete',
        value: function initAutocomplete() {
            var _self = this;
            this.container.querySelectorAll('.autocomplete__lastname').forEach(function (item) {
                _self.initLastnameAutocomplete(item, _self);
            });

            this.container.querySelectorAll('.autocomplete__skill').forEach(function (item) {
                _self.initSkillAutocomplete(item, _self);
            });
        }
    }, {
        key: 'initSkillAutocomplete',
        value: function initSkillAutocomplete(item, _self) {
            var autocomplete = new AutoComplete(item, 'autocomplete__item--skill');
            autocomplete.init();
            _self.autocompletes.push(autocomplete);
        }
    }, {
        key: 'initLastnameAutocomplete',
        value: function initLastnameAutocomplete(item, _self) {
            var autocomplete = new AutoComplete(item);
            autocomplete.setInputValue = function (target) {

                var parent = target.closest('.form--row');
                var skill_input = parent.querySelector('input[name="skill"]');

                var firstname = parent.querySelector('input[name="firstname"]');
                firstname.value = target.querySelector('.firstname').innerText;
                firstname.classList.remove('error');

                var lastname = parent.querySelector('input[name="lastname"]');
                lastname.value = target.querySelector('.lastname').innerText;
                lastname.classList.remove('error');

                var middlename = parent.querySelector('input[name="middlename"]');
                middlename.value = target.querySelector('.middlename').innerText;
                middlename.classList.remove('error');

                for (var attr_name in target.dataset) {
                    if (attr_name == 'skill') {
                        skill_input.value = target.dataset[attr_name];
                        skill_input.setAttribute('data-id', target.dataset['skill_id']);
                        skill_input.classList.remove('error');
                    } else {
                        this.input.setAttribute('data-' + attr_name, target.dataset[attr_name]);
                    }
                }
                this.closeDropdown();
            };
            autocomplete.init();
            _self.autocompletes.push(autocomplete);
        }
    }, {
        key: 'initAddDoctor',
        value: function initAddDoctor() {
            var _self = this;
            this.container.querySelector('.add_doctor').addEventListener('click', function (e) {
                if (_self.current < 5) {
                    var template = _.template(document.getElementById('form--row').innerHTML);
                    var row = _self.parseHTML(template());
                    _self.container.querySelector('.vote--form .additional--rows').appendChild(row);
                    _self.initLastnameAutocomplete(row.querySelector('.autocomplete__lastname'), _self);
                    _self.initSkillAutocomplete(row.querySelector('.autocomplete__skill'), _self);
                    _self.current++;
                }
            });
        }
    }, {
        key: 'validateForm',
        value: function validateForm() {
            var _self = this;
            var rows = this.container.querySelectorAll('.form--row');
            var msgs = [];
            this.users = [];
            rows.forEach(function (row) {
                if (!row.classList.contains('add_doctor')) {
                    var validate = _self.validateRow(row);
                    if (!validate) {
                        msgs.push(validate);
                    } else {
                        _self.addUser(row);
                    }
                }
            });

            return msgs.length ? msgs : true;
        }
    }, {
        key: 'addUser',
        value: function addUser(row) {
            var _self = this;
            var inputs = row.querySelectorAll('.form--input');
            var user = {};
            inputs.forEach(function (item) {
                var input = item.querySelector('input');
                if (input.getAttribute('data-id') !== null) {
                    user[input.getAttribute('name')] = {
                        value: input.value,
                        id: input.getAttribute('data-id')
                    };
                } else {
                    user[input.getAttribute('name')] = input.value;
                }
            });

            this.users.push(user);
        }
    }, {
        key: 'validateRow',
        value: function validateRow(row) {
            var _self = this;
            var errors = [];
            var user = {};
            row.querySelectorAll('.form--input').forEach(function (item) {
                var label = item.querySelector('label');
                var input = item.querySelector('input');
                if (!input.value.trim().length) {
                    _self.markAsError(input);
                    input.placeholder = 'Заполните это поле';
                    errors.push((label === null ? input.getAttribute('name') : label.innerText) + ' \u043D\u0435 \u0437\u0430\u043F\u043E\u043B\u043D\u0435\u043D\u043E');
                } else {
                    if (input.getAttribute('data-id') !== null) {
                        user[input.getAttribute('name')] = {
                            value: input.value,
                            id: input.getAttribute('data-id')
                        };
                    } else {
                        user[input.getAttribute('name')] = input.value;
                    }
                }
            });

            if (_.has(user, 'lastname.id')) {
                var needle = _.filter(this.users, { lastname: { id: user.lastname.id } });
                if (needle.length) {
                    if (_.isEqual(user, _.first(needle)) || user.lastname.id == _.first(needle).lastname.id) {
                        _self.cleanRow(row);
                        confirm('Вы не можете голосовать дважды за одного врача');
                        return false;
                    }
                }
            }
            return errors.length ? false : true;
        }
    }, {
        key: 'showEnd',
        value: function showEnd() {
            var main = this.container.querySelector('.main');
            var end = this.container.querySelector('.end');
            main.classList.add('hide');
            setTimeout(function () {
                end.classList.remove('hide');
            }, 200);
        }
    }, {
        key: 'save',
        value: function save() {
            var _self = this;
            $.post('/actions/best-doctor-2018/postVote', {
                'users': _self.users
            }).done(function (response) {
                if (response.code == 200) {
                    _self.showEnd();
                }
            }).fail(function (data) {
                data = data.responseJSON;
                alert(data.msg);
                if (data.code == 419) {
                    _self.showEnd();
                }
            });
        }
    }, {
        key: 'cleanRow',
        value: function cleanRow(row) {
            var _self = this;
            row.querySelectorAll('input').forEach(function (input) {
                input.value = '';
                _self.markAsError(input);
                input.placeholder = 'Заполните это поле';
            });
        }
    }, {
        key: 'saveForm',
        value: function saveForm() {
            var validate = this.validateForm();
            if (validate === true) {
                this.save();
            } else {
                if (Array.isArray(validate)) {
                    validate.forEach(function (msg) {
                        console.log(msg);
                    });
                } else {
                    console.log(validate);
                }
            }
        }
    }, {
        key: 'markAsError',
        value: function markAsError(input) {
            input.classList.add('error');
        }
    }, {
        key: 'parseHTML',
        value: function parseHTML(str) {
            var tmp = document.implementation.createHTMLDocument();
            tmp.body.innerHTML = str;
            return tmp.body.children[0];
        }
    }, {
        key: 'initVoteButton',
        value: function initVoteButton() {
            var _self = this;
            this.container.querySelector('.vote').addEventListener('click', function (e) {
                _self.saveForm();
            });
        }
    }, {
        key: 'init',
        value: function init() {
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
    }]);

    return LVGVote;
}();

if (document.querySelector('.page--lvg__vote')) {
    var lvg_vote = new LVGVote();
    lvg_vote.init();
}
