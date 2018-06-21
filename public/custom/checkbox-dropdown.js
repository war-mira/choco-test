$(function () {
    $('.dropdown-checkbox-menu').each(function () {
        var allCheckboxes = $(this).find('input');
        var valOptions = $(this).find('a:not([data-type=all])');
        var allOption = $(this).find('a[data-type=all]');
        var searchInput = $(this).find('input[type="text"]');

        allOption.click(function (e) {
            var checkboxInput = $(this).find('input');
            checkboxInput.prop('indeterminate', false).trigger('change');
            allCheckboxes.prop('checked', !checkboxInput.prop('checked'));
            e.preventDefault();
            e.stopPropagation()
        });
        valOptions.click(function (e) {
            var checkboxInput = $(this).find('input');
            checkboxInput.prop('checked', !checkboxInput.prop('checked'));
            var checkedCount = valOptions.find('input:checked').length;
            var indeterminate = false;
            var checked = false;
            if (valOptions.length === checkedCount)
                checked = true;
            else if (valOptions.length > checkedCount && checkedCount > 0)
                indeterminate = true;

            allOption.find('input').prop('checked', checked).trigger('change');
            allOption.find('input').prop('indeterminate', indeterminate);
            e.preventDefault();
            e.stopPropagation()
        });

        searchInput.on('input', function () {
            var term = $(this).val().toLowerCase();
            valOptions.each(function (index, option) {
                if ($(option).text().toLowerCase().indexOf(term) < 0 && !$(option).find('input').prop('checked'))
                    $(option).hide();
                else
                    $(option).show();
            })
        });
    });
});
