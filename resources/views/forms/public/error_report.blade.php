<div id="error_report" class="white-popup mfp-hide">
    <form>
        <div class="error-report__heading">Сообщение об ошибке</div><br/>
        <div class="error-report__input-line">
            <input type="hidden" name="current_url" value="{{url()->current()}}">
            <div>
                <input type="email" class="form-control " placeholder="*Email" name="error_email" required>
            </div>
            <div class="error-report__textarea-item">
                <div class="collapse">
                    <textarea class="form-control" placeholder="*Текст ошибки" name="error_text" required></textarea>
                </div>
            </div>
            <div class="error-report__submit">
                <button class="btn btn_theme_usual">Отправить</button>
            </div>
        </div>
    </form>
    <div class="response__block white-popup hide">
        <p>
            <strong>Спасибо</strong> за Ваше сообщение!
        </p>
    </div>
</div>
