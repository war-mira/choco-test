<form id="ask-doctor-form" class="show-question-form">
    <div class="form-row">
        <div class="form-group">
            <label>E-mail *</label>
            <input type="email" id="ask-user-email" class="" name="user[email]" placeholder="example@example.com" required>
        </div>
    </div>
    <div class="form-group">
        <label>Ваш вопрос *</label>
        <textarea rows="5" id="ask-question-text" name="question[text]" required placeholder="Опишите подробно возникшую проблему"></textarea>
    </div>
    <div class="form-group" style="display:none;">
        <label>Прикрепить изображение</label>
        <input type="file" />
    </div>
    <div class="form-group">
        <div class="button-send-container">
            <button type="button" class="btn" id="ask-question__form-send">Отправить</button>
        </div>
    </div>
    <div class="loader hide" id="form_loader"></div>
</form>
<div id="doctor_mess_ok" style="display:none;">
    <p>
        <strong>Спасибо за вопрос!</strong> Когда врач ответит, мы Вам обязательно сообщим.
    </p>
</div>