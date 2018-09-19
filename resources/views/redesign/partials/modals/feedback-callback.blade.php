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
                        <div class="desktop-datetime">
                            <div class="date-text-input">
                                <label>Год рождения*</label>
                                <select name="user[birthday]" id="user-birthday" required>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                </select>
                            </div>
                        </div>
                        <div class="mobile-datetime">
                            <label>Год рождения *</label>
                            <select name="user[birthday]" id="user-birthday" required>
                                <option value="2002">2002</option>
                                <option value="2001">2001</option>
                                <option value="2000">2000</option>
                            </select>
                        </div>
                    </div>
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
                            <input type="radio" name="question_notify" id="email_notify"/>
                            <label for="email_notify">Email</label>
                            <input type="radio" name="question_notify" id="mobile_notify"/>
                            <label for="mobile_notify">Телефон</label>
                        </div>
                        <input type="email" id="user-email" class="" name="user[email]" required>
                        <input class="bfh-phone" required
                               name="user[phone]" id="user-phone"
                               type="text" data-mask="+7 (999) 999-99-99">
                    </div>
                </div>
                <div class="form-group">
                    <label>Специализация *</label>
                    <select id="specialization">
                        <option value="1">Акушер</option>
                        <option value="2">Аллерголог</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ваш вопрос</label>
                    <textarea rows="5" id="question-text" name="question[text]" required
                              placeholder="Опишите свою проблему как можно подробнее. Это позволит доктору лучше Вас проконсультировать.">
                    </textarea>
                </div>
                <div class="form-group">
                    <div class="button-send-container">
                        <button type="button" class="btn" id="question__form-send">Отправить</button>
                    </div>
                </div>
            </form>
        <div id="ask_doctor_mess_ok" >
            <p>
                <strong>Спасибо за вопрос!</strong> Когда врач ответит, мы Вам обязательно сообщим.
            </p>
        </div>
    </div>
</div>
<style>
    #ask-doctor-modal-form .tips{
        font-size: 14px;
        text-align: center;
        margin: 15px 0;
    }
</style>