$(function () {
    $('.text-collapsible').find('a').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var parent = $(this).parent();
        if (parent.hasClass('expanded')) {
            $(this).text('Показать');
            parent.removeClass('expanded');
        }
        else {
            $(this).text('Скрыть');
            parent.addClass('expanded');
        }
    });
    $(document).click(function (e) {
        $('.text-collapsible').removeClass('expanded');
    });
});