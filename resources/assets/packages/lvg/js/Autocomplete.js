class AutoComplete {
    constructor(selector, autocomplete_item_id = 'autocomplete__item', url = false) {
        this.input = selector.querySelector('.autocomplete__input'); //DomElement
        this.url = url;
        this.dropdown = selector.querySelector('.autocomplete__list'); //DomElement
        this.autocomplete_item_id = autocomplete_item_id;
    }

    getUrl() {
        let url = this.input.getAttribute('data-url');
        if (url === null) {
            if (this.url) {
                url = this.url;
            } else {
                throw new Error('Set autocomplete Url');
            }
        }
        return url;
    }

    get() {
        let value = this.input.value;
        if (value.length > 2) {
            this.makeRequest(value);
        } else {
            this.closeDropdown();
        }
    }

    makeRequest(value) {
        let _self = this;
        $.get(this.getUrl(), {
            query: value,
            type:this.input.getAttribute('search')
        })
            .done(function (data) {
                if (data.length) {
                    _self.createDropdown(data);
                } else {
                    _self.closeDropdown();
                }
            })
    }

    getItemTemplate(id) {
        return _.template(document.getElementById(id).innerHTML);
    }

    createDropdown(data) {
        let _self = this;
        let text = '';

        data.forEach(function (item) {
            let template = _self.getItemTemplate(_self.autocomplete_item_id);
            text += template(item);
        });
        this.dropdown.querySelector('.list').innerHTML = text;
        this.dropdown.classList.add('show');
    }

    clearInputAttributes() {
        for (let attr_name in this.input.dataset) {
            if (attr_name !== 'url') {
                delete this.input.dataset[attr_name];
            }
        }
    }

    init() {

        let _self = this;
        this.input.addEventListener('input', function (evt) {
            _self.clearInputAttributes();
            _self.get(evt.target);
        });
        this.input.addEventListener('focusout', function (evt) {
            setTimeout(() => {
                _self.closeDropdown();
            }, 300)
        });

        this.dropdown.addEventListener('click', function (evt) {
            let target = event.target;
            if (target.classList.contains('autocomplete__list--item')) {
                _self.setInputValue(evt.target);
            }

        });
    }

    closeDropdown() {
        try {
            this.dropdown.querySelector('.list').scrollTo(0, 0);
        } catch (e) {

        }

        this.dropdown.classList.remove('show');

    }

    setInputValue(target) {
        this.input.value = target.innerText;
        for (let attr_name in target.dataset) {
            this.input.setAttribute(`data-${attr_name}`, target.dataset[attr_name]);
        }
        this.closeDropdown()
    }
}
if ('NodeList' in window && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}