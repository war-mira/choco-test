<div class="modal-window" id="question__modal">
    <div class="moodal-close-bg"></div>
    <div class="modal-close"></div>
    <div class="modal__content">
        <div class="modal__title">
            Задать вопрос врачу
        </div>
            <form id="ask-doctor-modal-form">
                <div class="tips">
                    Задайте свой вопрос квалифицированному врачу и получите бесплатный ответ. Сервис iDoctor.kz гарантирует вашу
                    100% анонимность.
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="desktop-datetime">
                            <div class="date-text-input">
                                <label>Год рождения*</label>
                                <input type="text" id="user-birthday"
                                       pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                       name="user[birthday]" placeholder="Год рождения"
                                       data-pmu-date="" required>
                            </div>
                        </div>
                        <div class="mobile-datetime">
                            <label>Год рождения *</label>
                            <input type="datetime-local" id="user-birthday"
                                   pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                   name="user[birthday-mobile]" placeholder="Выберите дату рождения"
                                   required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ваш пол *</label>
                        <select type="text" id="user-gender" class="" name="user[gender]" required>
                            
                                <option value="0">Муж</option>
                                <option value="1">Жен</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" id="user-email" class="" name="user[email]" required>
                    </div>
                    <div class="form-group">
                        <label>Телефон *</label>
                        <input class="bfh-phone" required
                               name="user[phone]" id="user-phone"
                               type="text" data-mask="+7 (999) 999-99-99">
                    </div>
                </div>

                <div class="form-group">
                    <label>Ваш вопрос</label>
                    <textarea rows="5" id="question-text" name="question[text]" required
                              placeholder="Опишите свою проблему как можно подробнее. Это позволит доктору лучше Вас проконсультировать."></textarea>
                </div>
                <div class="form-group">
                    <div class="button-send-container">
                        <button type="button" id="question__form-send">Отправить</button>
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