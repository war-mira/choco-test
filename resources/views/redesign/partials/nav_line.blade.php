
<div class="index-nav-line">
    <a href="{{route('home')}}" class="main-header__logo"><img src="{{asset('/img/footer-logo.png')}}" alt="iDoctor.kz" title="iDoctor.kz"></a>
        <div class="container" id="nav-top-container">
            <div class="index-intro__container">
                <nav class="index-nav">
                    <a href="{{route('doctors.list')}}" class="index-nav__item index-nav-item">
                        <span class="index-nav-item__icon"><i class="icon-1 hover-icon"></i></span>
                        <span>Врачи</span>
                    </a>
                    <a href="{{route('medcenters.list')}}" class="index-nav__item index-nav-item">
                        <span class="index-nav-item__icon"><i class="icon-2 hover-icon"></i></span>
                        <span>Медцентры</span>
                    </a>
                    <a href="{{route('library.index')}}" class="index-nav__item index-nav-item">
                        <span class="index-nav-item__icon"><i class="icon-4 hover-icon"></i></span>
                        <span>Медицинская библиотека</span>
                    </a>
                    {{--<a href="#" class="index-nav__item index-nav-item">--}}
                    {{--<span class="index-nav-item__icon"><i class="icon-3 hover-icon"></i></span>--}}
                    {{--<span>Услуги</span>--}}
                    {{--</a>--}}
                    {{--<a href="#" class="index-nav__item index-nav-item">--}}
                    {{--<span class="index-nav-item__icon"><i class="icon-5 hover-icon"></i></span>--}}
                    {{--<span>Акции</span>--}}
                    {{--</a>--}}
                </nav>
                <div class="main-header__actions">
                    {{--<a href="#" class="main-header__action-item header-link-btn header-link-btn_highlight">--}}
                        {{--<span class="header-link-btn__icon"><i class="icon-6 hover-icon"></i></span>--}}
                        {{--<span>Сотрудничество</span>--}}
                    {{--</a>--}}
                    @if(Auth::guest())
                    <a href="#signin-modal"  rel="modal-link" class="main-header__action-item header-link-btn header-login-btn">
                        <span class="header-link-btn__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                        <span>Войти</span>
                    </a>
                    @else
                        <a href="@if(Auth::user()->role == \App\User::ROLE_DOCTOR) {{route('cabinet.doctor.personal.index')}}
                                @else {{route('user.profile')}} @endif" class="main-header__action-item header-link-btn header-login-btn">
                            <span class="header-link-btn__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                            <span>Профиль</span>
                        </a>
                    @endif
                    @include('redesign.partials.cities_select')
                    
                    <div style="max-width: 200px;">
                        <a href="tel:+77272222200" class="main-header__action-item main-header-phone">+7 (727) 222-22-00</a>
                        <a href="tel:+77715033221" class="main-header__action-item main-header-phone" >+7 (771) 503-32-21</a>
                    </div>
                    <div class="nav-toggle main-header__action-item">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
                        
        </div>
    </div>