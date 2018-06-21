<div class="header" role="banner">
    <div class="container" style="z-index: 10;">
        <div class="header__logo">
            <a href="{{url('/')}}">
                <img src="{{ URL::asset('images/idoc_logo.png?2042365') }}" width="" height="" alt="iDoctor">
            </a>
        </div>
        <div class="header__phone header__phone--mobile">
            <div style="width: 100%; display: block">
                <a style="text-decoration: none; width: 100%; display: block; text-align: center; font-size: 18px;"
                   href="tel:+77272222200">
                    <span>+7 (727) 222 22 00</span>
                </a><br>
                <a style="text-decoration: none; width: 100%; display: block; text-align: center; font-size: 18px;"
                   href="tel:+77715033221">
                    <span>+7 (771) 503 32 21</span>
                </a>
            </div>
            <div style="width: 100%; margin-top: 5px;  display: block; font-weight: bold; border: 1px solid black; border-radius: 3px;">
                <span class="header__phone-num" style="font-size: 12px">Пн-пт 8:00 - 19:00</span>
                <span class="header__phone-num" style="font-size: 12px">Сб-Вс 9:00 - 15:00</span>
            </div>
        </div>

        <a href="#777" class="header__menu"></a>
        <div class="header__menu-content">
            <div class="header__city">Ваш город:<br><a href="#city_modal" data-toggle="modal"
                                                       class="link-dotted">{{\App\Helpers\SessionContext::city()->name}}</a>
            </div>
            <div class="header__phone">
                Мы поможем найти врача:<br>
                <a style="text-decoration: none;" href="tel:+77272222200"><span style="font-size: 20px"
                                                                                class="header__phone-num">+7 (727) 222 22 00,</span></a>
                <a style="text-decoration: none;" href="tel:+77715033221"><span style="font-size: 20px"
                                                                                class="header__phone-num">+7 (771) 503 32 21</span></a>
            </div>
            <div style="display: inline-block">
                <span class="header__phone-num" style="font-weight: bold">Пн-пт 8:00 - 19:00</span><br/>
                <span class="header__phone-num" style="font-weight: bold">Сб-Вс 9:00 - 15:00</span>
            </div>


            <div class="header__button">
                <button type="button" data-toggle="modal" data-target="#reception" class="button button--light">
                    Быстрая запись
                </button>
            </div>
            @if (Auth::guest())
                <div class="header__login">Профиль:<br><a href="{{url('login')}}">Войти</a> <br> <a
                            href="{{url('register')}}">Регистрация</a></div>
            @else
                <div class="header__login">Профиль:<br><a href="{{url('profile')}}">{{ Auth::user()->name }}</a>
                    @endif
                </div>
        </div>
    </div>
</div>