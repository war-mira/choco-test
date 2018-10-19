function sendAboutError(e){
    e.preventDefault();
    var errorForm = $('form#error-report__form');
    var data = errorForm.serialize();
    $.post('/error-inform', data)
        .done(function (response) {
            if (response.code == 200) {
                $('#error_mess_ok').show();
            }
        }).fail(function (data) {
            console.log(data);
    });
}