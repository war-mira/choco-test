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
            console.warn('implement save user');
            var _self = this;
            $.post('/actions/best-doctor-2018/create', _self.user).done(function (response) {
                if (response.code == 200) {
                    _self.user.doctor_id = response.data.doctor_id;
                    _self.goToStep(target.getAttribute('data-next-step'), 'begin');
                }
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
            form.querySelectorAll('.form--input').forEach(function (input) {
                var input__field = input.querySelector('input');
                var label = input.querySelector('label');
                if (!input__field.value.trim().length) {
                    _self.markAsError(input__field);
                    messages.push((label === null ? input__field.getAttribute('name') : label.innerText) + ' \u043D\u0435 \u0437\u0430\u043F\u043E\u043B\u043D\u0435\u043D\u043E');
                }
            });

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

var lvg = new LVG();
lvg.init();