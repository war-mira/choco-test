<div class="modal-window" id="signup-modal">
    <div class="modal-close"></div>
    <div class="modal__title">
        Регистрация
    </div>
    <div class="modal__content">
        <div class="account-type__select">
            <div class="account-type__select_option">
                <input id="account-type-signup" name="auth-type" type="radio" class="auth-type__radio"
                       value="account-type--user" checked>
                <label for="account-type-signup">Я пациент</label>
            </div>
            <div class="account-type__select_option">
                <input id="account-type-signin" name="auth-type" type="radio" class="auth-type__radio"
                       value="account-type--doctor">
                <label for="account-type-signin">Я врач</label>
            </div>
        </div>
        <div class="account-type-tabs">
            <div class="account-type--user account-tab account-tab--active">
                <div class="form-title">Заполните контактные данные</div>
                <form action="{{route('register')}}" method="post">
                    {{csrf_field()}}
                    <div class="input-block--text">
                        <input class="input-block__input" name="name" type="text" value=""
                               placeholder="ФИО *" required>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input bfh-phone" name="phone" data-format="+7 (ddd) ddd-dddd"
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}"
                               title="Телефон в формате +7 (XXX) XXX XX-XX" type="text"
                               placeholder="Телефон *" required>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input " name="email" type="email" value=""
                               placeholder="Email">
                    </div>

                    <div class="input-block--text">
                        <select name="city" class="input-city-select">
                            <option value="hide">Ваш город</option>
                            <option value="2010">Актау</option>
                            <option value="2011">Актобе</option>
                            <option value="2010">Астана</option>
                            <option value="2011">Алматы</option>
                            <option value="2010">Актау</option>
                            <option value="2011">Актобе</option>
                            <option value="2010">Астана</option>
                            <option value="2011">Алматы</option>
                        </select>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input " name="password" type="password" value=""
                               placeholder="Пароль" required>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input " name="password_confirmation" type="password"
                               value="" placeholder="Повторите пароль">
                    </div>
                    <button type="submit" class="form-submit-btn">Зарегистрироваться</button>
                </form>
            </div>
            <!-- User tab -->
            <div class="account-type--doctor account-tab">
                <div class="form-title">Заполните контактные данные</div>
                <form action="{{route('register')}}">
                    <input type="hidden" name="is_doctor" value="1">
                    <div class="input-block--text">
                        <input class="input-block__input" id="user_fio" type="text" value="" placeholder="ФИО *"
                               required>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input" id="author_phone" type="text" value=""
                               placeholder="Телефон *" required>
                    </div>
                    <div class="input-block--text inline-input">
                        <input class="input-block__input" id="author_phone" type="email" value="" placeholder="Email">
                    </div>
                    <div class="input-block--text">
                        <input class="input-block__input" id="user_speciality" type="text" value=""
                               placeholder="Специальность">
                    </div>

                    <select id="user_city" name="user_city" class="input-city-select">
                        <option value="hide">Ваш город</option>
                        <option value="2010">Актау</option>
                        <option value="2011">Актобе</option>
                        <option value="2010">Астана</option>
                        <option value="2011">Алматы</option>
                        <option value="2010">Актау</option>
                        <option value="2011">Актобе</option>
                        <option value="2010">Астана</option>
                        <option value="2011">Алматы</option>
                    </select>
                    <button type="submit" class="form-submit-btn">Зарегистрироваться</button>
                </form>
            </div>
            <!-- Doctor tab -->
        </div>
    </div>
</div>