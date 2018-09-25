var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Filters = function () {
    function Filters() {
        var container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

        _classCallCheck(this, Filters);

        this.container = document.querySelector(container !== null ? container : '#filtersGroup');
        this.order = this.container.querySelectorAll('input[name="order"]');
        this.sort = this.container.querySelectorAll('input[name="sort"]');
        this.sort_input = document.querySelector('.search-bar__line input[name="sort"]');
        this.order_input = document.querySelector('.search-bar__line input[name="order"]');
        this.form = document.querySelector('.questions__search--form');
    }

    _createClass(Filters, [{
        key: 'changeOrder',
        value: function changeOrder(target) {
            if (target.classList.contains('btn_theme_radio_active')) {
                if (this.order_input.value == 'desc') {
                    this.order_input.value = 'asc';
                } else {
                    this.order_input.value = 'desc';
                }
            } else {
                this.order_input.value = 'desc';
            }
        }
    }, {
        key: 'reloadPage',
        value: function reloadPage() {
            this.form.submit();
        }
    }, {
        key: 'changeSort',
        value: function changeSort(target) {
            var input = target.querySelector('input[name="sort"]');
            this.sort_input.value = input.value;
        }
    }, {
        key: 'initSort',
        value: function initSort() {
            var _this = this;

            this.sort.forEach(function (item) {
                item.closest('.sort__change').addEventListener("click", function (e) {
                    var target = e.target;
                    _this.changeOrder(target);
                    _this.changeSort(target);
                    _this.reloadPage();
                });
            });
        }
    }, {
        key: 'init',
        value: function init() {
            this.initSort();
        }
    }]);

    return Filters;
}();

if (document.querySelector('.group__filters')) {
    var filters = new Filters('.group__filters');
    filters.init();
}
