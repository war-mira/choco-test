<header class="main-header">
    <div class="main-header__container">
        <div class="main-header__line">
            <a href="/" class="main-header__logo"><img src="{{asset('images/idoc_logo.png')}}" alt="iDoctor.kz" title="iDoctor.kz"></a>
            <div class="main-header__actions">
                <a href="#" class="main-header__action-item header-link-btn header-link-btn_highlight">
                    <span class="header-link-btn__icon"><i class="icon-6 hover-icon"></i></span>
                    <span>Сотрудничество</span>
                </a>
                <div href="#" class="main-header__action-item header-link-btn header-login-btn">
                    <span class="header-link-btn__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                    @if(Auth::guest())
                        <span><a href="{{route('login')}}">Логин</a> / <a href="{{route('register')}}">Регистрация</a></span>
                    @else
                         <a href="{{route('user.profile')}}" id="login-dropdown-toggle">Профиль</a>
                    @endif
                </div>
                <div class="main-header__action-item main-header-location">
                    <select name="location" class="js-header-location" placeholder="Алматы">
                        <option value="6">Алматы</option>
                        <option value="2">Астана</option>
                        <option value="3">Усть-Каменогорск</option>
                    </select>
                </div>
                <a href="tel:+77272222200" class="main-header__action-item main-header-phone">+7 (727) 222-22-00</a>
                <div class="nav-toggle main-header__action-item">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="mobile-menu pattern-bg">
            <div href="#" class="mobile-menu__item mobile-menu-item">
                @if(Auth::guest())
                    <span><a href="{{route('login')}}">Логин</a> / <a href="{{route('register')}}">Регистрация</a></span>
                @else
                    <a href="{{route('user.profile')}}" id="login-dropdown-toggle">Профиль</a>
                @endif
            </div>
            <a href="#" class="mobile-menu__item mobile-menu-item">
                <span>Сотрудничество</span>
            </a>
            <a href="tel:+77272222200" class="mobile-menu__item mobile-menu-item">
                <span>+7 (727) 222-22-00</span>
            </a>
        </div>
    </div>
</header>