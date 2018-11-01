(function(){
    if(document.getElementById('error_report')){
        let errorModal = document.getElementById('error_report');
        let form = errorModal.querySelector('form');
        let button = form.querySelector('.btn');
        let textarea = form.querySelector('textarea').value;
        let email = form.querySelector('input').value;
        let response_div = errorModal.querySelector('.response__block');

        button.addEventListener('click', function (event){
            event.preventDefault();
            let target = event.target;
            target.classList.add('saving');
                $.post('/error-inform', {
                    error_email: email,
                    error_text: textarea
                })
                    .done(function (response) {
                        target.classList.remove('saving');
                        form.classList.add('hide');
                        response_div.classList.remove('hide');

                    }).fail(function (data) {
                        target.classList.remove('saving');
                        toastr.error('Извините, произошла ошибка');
                });
        });
    }
})();

(function(){
    let switcher = document.getElementById('switch-view');
    switcher.addEventListener('click', function (event){
        event.preventDefault();
        let form = document.getElementById('search-form');
        let switcher_list = form.querySelector('.doctor_list');
        switcher_list.classList.toggle('doctor_table');
    });
})();