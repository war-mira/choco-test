<div class="modal-window" id="question__modal">
    <div class="moodal-close-bg"></div>
    <div class="modal-close"></div>
    <div class="modal__content">
        <div class="modal__title">
            Задать вопрос врачу
        </div>
        <form id="ask-doctor-modal-form" class="show-question-form">
                <div class="tips">
                    Задайте свой вопрос квалифицированному врачу и получите бесплатный ответ. Сервис iDoctor.kz гарантирует вашу
                    100% анонимность.
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Год рождения*</label>
                        <select name="select" id="user-birthday" required="">
                            <?php for($i = 1900 ; $i < date('Y'); $i++){ echo "<option value=".$i.">$i</option>"; }?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Ваш пол *</label>
                        <div id="user-gender" class="" name="user[gender]" required>
                            <input type="radio" name="gender" id="gender_m"/>
                            <label for="gender_m">Мужской</label>
                            <input type="radio" name="gender" id="gender_f"/>
                            <label for="gender_m">Женский</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Куда Вам прислать ответ? *</label>
                        <div id="user-gender" class="" name="user[gender]" required>
                            <input type="radio" name="question_notify" id="email_notify" onclick="answerInfoType();"/>
                            <label for="email_notify">Email</label>
                            
                            <input type="radio" name="question_notify" id="mobile_notify" onclick="answerInfoType();"/>
                            <label for="mobile_notify">Телефон</label>
                        </div>
                        <input type="email" id="user-email" class="" name="user[email]" style="display:none" placeholder="email@mail.com">
                        <input class="bfh-phone" name="user[phone]" id="user-phone" style="display:none" type="text" placeholder="+7 (XXX) XXX-XX-XX" data-mask="+7 (999) 999-99-99">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Специализация *</label>
                        <select name="skill">
                            @foreach($skillsList as $skill)
                                <option value="">{{$skill['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ваш вопрос</label>
                    <textarea rows="5" id="question-text" name="question[text]" required
                              placeholder="Опишите свою проблему как можно подробнее. Это позволит доктору лучше Вас проконсультировать.">
                    </textarea>
                    
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
            </form>
        <div id="ask_doctor_mess_ok" style="display:none;">
            <p>
                <strong>Спасибо за вопрос!</strong> Когда врач ответит, мы Вам обязательно сообщим.
            </p>
        </div>
    </div>
</div>


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
<style>
    .show-question-form .form-row{
        margin-bottom: 10px;
    }
</style>