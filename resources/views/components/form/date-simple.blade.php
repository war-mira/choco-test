<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<style>
    .date-simple input[type=number]::-webkit-inner-spin-button,
    .date-simple input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .date-simple input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="date-simple" id="{{$id}}">
    <input type="hidden" data-prop="value" name="{{$field}}">
    <input class="date-simple-input" data-prop="day" type="number">
    <input class="date-simple-input" data-prop="month" type="number">
    <input class="date-simple-input" data-prop="year" type="number">
</div>
<input type="text" id="next" value="wewger">
@push('component_scripts')
    <script>
    var DateSimple = function (id, config) {
        var self = this;
        self.config = config;
        self.date = moment();
        self.val = function () {
            return self.date;
        };
        self.$component = $('#' + id);
        self.$value = self.$component.find('input[data-prop=value]');
        self.$day = self.$component.find('input[data-prop=day]');
        self.$month = self.$component.find('input[data-prop=month]');
        self.$year = self.$component.find('input[data-prop=year]');

        self.$day.on('input', function () {
            var day = $(this).val();
            var len = day.toString().length;
            if (day < 1)
                day = 1;
            else if (day > 31)
                day = 31;

            if (len >= 2 || day > 3) {
                self.$day.val(day).trigger('change');
                $(this).off('focusout', validateValues);
                self.$month.focus();
            }

        });
        self.$month.on('input keydown', function (event) {
            var month = $(this).val();
            var len = month.toString().length;
            if (event.type === 'keydown') {
                const key = event.key;
                if (key !== "Backspace" && key !== "Delete") {
                    return true;
                }
                if (len <= 0) {
                    $(this).off('focusout', validateValues);
                    self.$year.blur();
                    self.$day.select();
                    return false;
                }
                event.stopPropagation();
                return true;
            }

            if (month < 1)
                month = 1;
            else if (month > 12)
                month = 12;

            if (len >= 2 || month > 1) {
                self.$month.val(month).trigger('change');
                $(this).off('focusout', validateValues);
                self.$year.focus();
            }

        });

        self.$year.on('input keydown', function (event) {
            var year = $(this).val();
            var len = year.toString().length;
            if (event.type === 'keydown') {
                const key = event.key;
                if (key !== "Backspace" && key !== "Delete") {
                    return true;
                }
                if (len <= 0) {
                    $(this).off('focusout', validateValues);
                    self.$year.blur();
                    self.$month.select();
                    return false;
                }
                event.stopPropagation();
                return true;
            }


            if (len >= 4) {
                self.$year.blur();

                if (config.focusAfter)
                    config.focusAfter.focus();
            }

        });

        var selectInputValue = function () {
            $(this).off('focusout', validateValues);
            $(this).select();
            $(this).on('focusout', validateValues);
        };

        var padWithZero = function () {
            var value = parseInt($(this).val());
            if (value < 10)
                value = "0" + value;
            if (!isNaN(value))
                $(this).val(value).trigger('change');
        };

        var validateValues = function () {
            var year = self.$year.val();
            if (year < config.min.year)
                year = config.min.year;
            else if (year > config.max.year)
                year = config.max.year;
            self.$year.val(year).trigger('change');

            var month = self.$month.val();
            if (month <= 0)
                month = 1;
            else if (month > 12)
                month = 12;
            if (month < 10)
                month = "0" + parseInt(month);
            self.$month.val(month).trigger('change');


            var days = moment([year, month - 1]).daysInMonth();
            var day = self.$day.val();
            if (day < 1)
                day = 1;
            else if (day > days)
                day = days;
            if (day < 10)
                day = "0" + parseInt(day);
            self.$day.val(day).trigger('change');

        };

        var updateValue = function () {
            var day = self.$day.val();
            var month = self.$month.val();
            var year = self.$year.val();
            self.$value.val(year + "-" + month + "-" + day);
        };

        self.$day.on('focusin', selectInputValue);
        self.$month.on('focusin', selectInputValue);
        self.$year.on('focusin', selectInputValue);

        self.$day.on('focusout', padWithZero);
        self.$month.on('focusout', padWithZero);

        self.$day.on('focusout', validateValues);
        self.$month.on('focusout', validateValues);
        self.$year.on('focusout', validateValues);

        self.$day.on('change', updateValue);
        self.$month.on('change', updateValue);
        self.$year.on('change', updateValue);
    };

    $(function () {
        var ds = new DateSimple('{{$id}}',
            {
                min: {year: 1970, month: 1, day: 1},
                max: {year: 2100, month: 1, day: 1},
                focusAfter: $('#next')
            });
    });
    </script>@endpush