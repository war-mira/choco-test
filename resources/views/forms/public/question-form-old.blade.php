<form class="question__form" id="question__form">
    <div class="tips">
        Задайте свой вопрос квалифицированному врачу и получите бесплатный ответ. Сервис iDoctor.kz гарантирует вашу 100% анонимность.
    </div>
    <div class="form-group col-md-6">
        <label>Email *</label>
        <input type="email" id="user-email" class="" name="user[email]" required>
    </div>
    <div class="form-group col-md-6">
        <label>Телефон *</label>
        <input class="bfh-phone" data-format="+7 (ddd) ddd-dddd" required
               pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="user[phone]" id="user-phone"
               type="text">
    </div>
    <div class="form-group col-md-6">
        <label>Город</label>
        <input type="text" id="user-city" class="" name="user[city]">
    </div>
    <div class="form-group col-md-6">
        <label>Ваш пол *</label>
        <select type="text" id="user-gender" class="" name="user[gender]" required>
            @foreach(\App\QuestionUser::GENDERS as $key => $gender)
                <option value="{{ $key }}">{{$gender}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6" id="datetime-group">
        <label>Дата рождения *</label><br>
        <input class="datepicker"
               name="user[birthday]" id="user-birthday" type="text" required>
    </div>
    <div class="form-group col-md-12">
        <label>Ваш вопрос</label>
        <textarea rows="5" id="question-text" name="question[text]" required placeholder="Опишите свою проблему как можно подробнее. Это позволит доктору лучше Вас проконсультировать."></textarea>
    </div>
    <div class="form-group col-md-12">
        <button type="button" id="question__form-send">Отправить</button>
    </div>
</form>