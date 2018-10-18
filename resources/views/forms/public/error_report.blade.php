<div id="error_report" class="white-popup mfp-hide">
    <form id="error-report__form">
        <div class="error-report__heading">Сообщение об ошибке</div><br/>
        <div class="error-report__input-line">
            <div>
                <input type="email" class="form-control " placeholder="*Email" name="error_email" required>
            </div>
            <div class="error-report__textarea-item">
                <div class="collapse">
                    <textarea class="form-control" id="error_text" placeholder="*Текст ошибки" name="error_text" required></textarea>
                </div>
            </div>
            <div class="error-report__submit">
                <button type="submit" class="btn btn_theme_usual" onclick="sendAboutError();">Отправить</button>
            </div>
        </div>
    </form>
</div>
<div id="error_mess_ok" class="white-popup mfp-hide">
    <p>
        <strong>Спасибо!</strong> за Ваше сообщение!
    </p>
</div>