
<div class="modal-window" id="question__modal">
    <div class="moodal-close-bg"></div>
    <div class="modal-close"></div>
    <div class="modal__content">
        <div class="modal__title">
            Задать вопрос врачу
        </div>
        <form id="ask-doctor-modal-form" class="show-question-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" id="user-email" class="" name="user[email]" placeholder="example@example.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ваш вопрос *</label>
                    <textarea rows="5" id="question-text" name="question[text]" required placeholder="Опишите подробно возникшую проблему"></textarea>
                </div>
                <div class="form-group" style="display:none;">
                    <label>Прикрепить изображение</label>
                    <input type="file" />
                </div>
                <div class="form-group">
                    <div class="button-send-container">
                        <button type="button" class="btn" id="question__form-send">Отправить</button>
                    </div>
                </div>
            <div class="loader hide" id="ask_form_loader"></div>
            </form>
        <div id="ask_doctor_mess_ok" style="display:none;">
            <p>
                <strong>Спасибо за вопрос!</strong> Когда врач ответит, мы Вам обязательно сообщим.
            </p>
        </div>
    </div>
</div>

@push('custom.js')
    <script type="text/javascript">

        function answerInfoType() {
            if (document.getElementById('email_notify').checked) {
                document.getElementById('user-email').style.display = 'inline';
                document.getElementById('user-phone').style.display = 'none';
            }else if(document.getElementById('mobile_notify').checked){
                document.getElementById('user-phone').style.display = 'inline';
                document.getElementById('user-email').style.display = 'none';
            }else{
                document.getElementById('user-email').style.display = 'none';
                document.getElementById('user-phone').style.display = 'none';
            }

        }

    </script>
    @endpush
<style>
    .show-question-form .form-row{
        margin-bottom: 10px;
    }
</style>