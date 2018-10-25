$("#ask-question__form-send").click(function () {
    var form = $("#ask-doctor-form");
    $('#form_loader').removeClass('hide');
    if (form[0].checkValidity()) {
        var data = form.serialize();
        $.post("/question/add", data)
            .done(function (json) {
                $('#ask-user-birthday').removeClass('has-warning');
                $('#ask-user-email').removeClass('has-warning');
                $('#ask-user-phone').removeClass('has-warning');
                $('#ask-question-text').removeClass('has-warning');
                $('#form-year .js-simple-select > div').removeClass('has-warning-selectized');
                if (json.error) {
                    $('#doctor_mess_ok').removeClass('access').addClass('error').html('<b>' + json.error + '</b>');
                    $('#doctor_mess_ok').show();
                }
                else if (json.id) {
                    $('#doctor_mess_ok').removeClass('error').addClass('access').html('<b>Спасибо за вопрос! Когда врач ответит, мы Вам обязательно сообщим.</b>');
                    $('#doctor_mess_ok').show();
                    form.hide();
                    form[0].reset();
                }
                $('#form_loader').addClass('hide');
            });
    }else {
        if(!$('#ask-user-email').val()){
            $('#ask-user-email').addClass('has-warning');
        }else{
            $('#ask-user-email').removeClass('has-warning');
        }
        if(!$('#ask-user-birthday').val() || !isValidDate($('#ask-user-birthday').val())){
            $('#form-year .js-simple-select > div').addClass('has-warning-selectized');
        }else{
            $('#form-year .js-simple-select > div').removeClass('has-warning-selectized');
        }
        if(!$('#ask-question-text').val()){
            $('#ask-question-text').addClass('has-warning');
        }else{
            $('#ask-question-text').removeClass('has-warning');
        }
        $('#form_loader').addClass('hide');
    }
});
$('.content_scroll__block').infiniteScroll({
    path: '.pagination_next',
    append: '.entity-line',
    history: false
}).on( 'append.infiniteScroll', function( event, response, path, items ) {
    console.log( 'Loaded: ' + path );
    runVue();
});;