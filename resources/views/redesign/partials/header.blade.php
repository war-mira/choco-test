<header class="main-header">
    <div class="main-header__container">
        <div class="main-header__line">
            <a href="{{route('home')}}" class="main-header__logo"><img src="{{asset('img/header-logo.png')}}" alt="iDoctor.kz" title="iDoctor.kz"></a>
            <div class="main-header__actions">
                {{--<a href="#" class="main-header__action-item header-link-btn header-link-btn_highlight">--}}
                    {{--<span class="header-link-btn__icon"><i class="icon-6 hover-icon"></i></span>--}}
                    {{--<span>Сотрудничество</span>--}}
                {{--</a>--}}
                @if(Auth::guest())
                <a href="#signin-modal"  rel="modal-link" class="main-header__action-item header-link-btn header-login-btn">
                    <span class="header-link-btn__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                    <span>Вход / Регистрация</span>
                </a>
                @else
                    <a href="@if(Auth::user()->role == \App\User::ROLE_DOCTOR) {{route('cabinet.doctor.personal.index')}}
                            @else {{route('user.profile')}} @endif" class="main-header__action-item header-link-btn header-login-btn">
                        <span class="header-link-btn__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                        <span>Профиль</span>
                    </a>
                @endif
                @include('redesign.partials.cities_select')
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
            <a href="#signin-modal"  rel="modal-link"  class="mobile-menu__item mobile-menu-item">
                <span>Вход / Регистрация</span>
            </a>
            {{--<a href="#" class="mobile-menu__item mobile-menu-item">--}}
                {{--<span>Сотрудничество</span>--}}
            {{--</a>--}}
            <a href="tel:+77272222200" class="mobile-menu__item mobile-menu-item">
                <span>+7 (727) 222-22-00</span>
            </a>
        </div>
    </div>
</header>