<form id="ask-doctor-form" class="show-question-form">
    
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Ваш пол *</label>
            <div id="user-gender" class="form-radio">
                <label class="styled-checkbox_block" for="ask-gender_m">
                    <input type="radio" checked="checked" name="user[gender]" id="ask-gender_m" value="0" required>
                    <span class="checkmark"></span>Мужской
                </label>
                <label class="styled-checkbox_block">
                  <input type="radio" name="user[gender]" id="ask-gender_f" value="1" required>
                  <span class="checkmark"></span>Женский
                </label>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="form-year">
            <label>Год рождения *</label>
            <select name="user[birthday]" id="ask-user-birthday" required class="form-control js-simple-select">
                <option>Год рождения *</option>
                    @foreach(range((int)date('Y'),1900) as $i)
                <option value="{{$i}}">{{$i}}</option>
                @endforeach
            </select>
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
<style>
/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>