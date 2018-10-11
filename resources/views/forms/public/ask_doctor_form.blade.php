<form id="ask-doctor-form" class="show-question-form">
    <div class="form-row">
        <div class="form-group col-md-6" id="form-year">
            <select name="user[birthday]" id="ask-user-birthday" required class="form-control js-simple-select">
                <option>Год рождения *</option>
                    @foreach(range((int)date('Y'),1900) as $i)
                <option value="{{$i}}">{{$i}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Ваш пол *</label>
            <div id="user-gender" class="form-radio">
                <input type="radio" name="user[gender]" id="ask-gender_m" value="0" checked required/>
                <label for="gender_m">Мужской</label>
                <input type="radio" name="user[gender]" id="ask-gender_f"  value="1" checked required/>
                <label for="gender_f">Женский</label>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>E-mail *</label>
            <input type="email" id="ask-user-email" class="" name="user[email]" placeholder="example@example.com">
        </div>
        <div class="form-group">
            <label for="mobile_notify">Телефон</label>
            <input class="bfh-phone" name="user[phone]" id="ask-user-phone" type="text" placeholder="+7 (XXX) XXX-XX-XX" data-mask="+7 (999) 999-99-99">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label>Специализация</label>
            <select name="question[skill_id]" class="form-control js-simple-select">
                <option value="40">Выберите специализацию</option>
                @foreach(\App\Skill::getList() as $skill)
                    <option value="{{$skill['id']}}">{{$skill['name']}}</option>
                @endforeach
            </select>
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