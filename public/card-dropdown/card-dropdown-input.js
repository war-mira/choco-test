$('.dropdown-input-container').each(function () {
    var $container = $(this);
    var $input = $container.find('.dropdown-input-control input');
    var $dropdown = $container.find('.dropdown-input-menu');
    var selectSuggestion = function (next) {
        var $selected = $dropdown.find('li.selected');
        $selected.removeClass('selected');
        var selection;
        if (next) {
            if ($selected.length <= 0 || $selected.is(':last-child')) {
                selection = $dropdown.find('li').first();
            }
            else {
                selection = $selected.next();
            }
        }
        else {
            if ($selected.length <= 0 || $selected.is(':first-child')) {
                selection = $dropdown.find('li').last();
            } else {
                selection = $selected.prev();
            }
        }
        selection.addClass('selected')[0].scrollIntoView(false);
        $input.val(selection.data('value'));

    };

    var acceptSuggestion = function (accept) {
        $input.val($dropdown.find('li.selected').data('value'));
        $dropdown.removeClass('open');
    };
    $(document).click(function (e) {
        if ($(e.target).closest($container).length === 0) {
            $dropdown.removeClass('open');
        }

    });
    $input.on('focusin click', function () {
        $dropdown.addClass('open');
    });
    $input.keydown(function (event) {
        switch (event.which) {
            case 38:
                $dropdown.addClass('open');
                selectSuggestion(false);
                event.preventDefault();
                break;
            case 40:
                $dropdown.addClass('open');
                selectSuggestion(true);
                event.preventDefault();
                break;
            case 13:
                acceptSuggestion(true);
                event.preventDefault();
                break;
        }
    });

    $dropdown.on('click', 'li', function () {
        $dropdown.find('li.selected').removeClass('selected');
        $(this).addClass('selected');
        $input.val($(this).data('value'));
        $input.focus();
    });

});