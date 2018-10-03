<div class="modal-window w20" id="signin-modal">
    <div class="modal-close"></div>
    <div class="modal__title py-4">
        Вход
    </div>
    <div class="modal__content">
        <form action="{{route('login')}}" method="post">
            {{csrf_field()}}
            <div class="input-block--text">
                <input class="input-block__input" name="email" type="text" value="" placeholder="Логин" required>
            </div>
            <div class="input-block--text">
                <input class="input-block__input" name="password" type="password" value="" placeholder="Пароль"
                       required>
            </div>
            <button type="submit" class="form-submit-btn">Войти</button>
            <div class="input-block--text x14 text-center">
                <a href="{{ route('password.phone.request-form') }}">
                    Забыли пароль?
                </a>
                |
                <a href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
        </form>
    </div>
</div>