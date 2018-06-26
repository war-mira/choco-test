<div class="page-nav-container">
    <div class="page-nav-header" id="page-nav">
        <div class="nav-header-logoandcontacts">
            <div class="nav-header-logo">
                <a class="s-collapsing-hide" href="/">
                    <img src="{{asset('images/idoc_logo.png')}}">
                </a>
            </div>
            <div class="nav-header-contacts">

                <a href="tel:+77272222200" id="header-phone-link">
                    <img src="{{asset('images/icons/icon_phone.png')}}"><span>+7 (727) 222 22 00</span>
                </a>
                {{-- <a href="tel:+77715033221">
                     <img src="{{asset('images/icons/icon_phone.png')}}"><span>+7 (771) 503 32 21</span>
                 </a>--}}
            </div>
        </div>

        <div class="nav-header-social">
            <a href="https://t.me/idoctorkz_bot" target="_blank" rel="nofollow">
                <img src="{{asset('images/social/telegram.png')}}">
            </a>
            <a href="https://vk.com/idoctorkz1" target="_blank" rel="nofollow">
                <img src="{{asset('images/social/vk.png')}}">
            </a>
            <a class="desktop-visible" href="https://www.instagram.com/idoctor_kz/" target="_blank" rel="nofollow">
                <img src="{{asset('images/social/instagram.png')}}">
            </a>
            <a class="desktop-visible" href="https://www.facebook.com/kz.idoctor" target="_blank" rel="nofollow">
                <img src="{{asset('images/social/facebook.png')}}">
            </a>
            <button type="button" class="btn-block button desktop-visible" style=" margin-top: 2px"
                    data-toggle="modal"
                    data-target="#reception">
                Быстрая запись
            </button>
        </div>
        <button type="button" class="button desktop-hidden" style=" margin-top: 2px"
                data-toggle="modal"
                data-target="#reception">
            Записаться
        </button>
        <div class="nav-header-links">
            <a href="{{route('medcenters.list')}}" target=""><img src="{{asset('images/icons/icon_building.png')}}">Медцентры</a>
            <a href="{{route('doctors.list')}}" target=""><img src="{{asset('images/icons/icon_expert.png')}}">Врачи</a>
            <a href="/#skills_full_list" target=""><img src="{{asset('images/icons/icon_sale.png')}}">Специализации</a>
        </div>
        <div class="nav-header-auth">
            <div class="header__city desktop-visible"><a href="#city_modal" data-toggle="modal"
                                                         class="link-dotted">{{\App\Helpers\SessionContext::city()->name}}</a>
            </div>
            <div class="dropdown desktop-visible">

                @if(Auth::guest())
                    <a href="#" id="login-dropdown-toggle"
                       class="header__login dropdown-toggle m-collapsing-hide desktop-visible"
                       data-toggle="dropdown">Вход</a>

                    <ul class="dropdown-menu dropdown-menu-right m-collapsing-hide desktop-visible">
                        <li><a href="{{route('login')}}">Логин</a></li>
                        <li><a href="{{route('register')}}">Регистрация</a></li>
                    </ul>
                @else
                    <div class="header__login m-collapsing-hide desktop-visible">
                        <a href="{{route('user.profile')}}" id="login-dropdown-toggle">Профиль
                        </a>
                    </div>
                @endif
            </div>
            <a class="nav-header-mobile-menu-btn" id="mobile-menu-btn" href="javascript:void(0)"><i
                        class="glyphicon glyphicon-menu-hamburger"></i></a>
        </div>


    </div>
    <div class="nav-header-mobile-menu" id="mobile-menu-container">
        <div class="mobile-menu-item mobile-menu-item-group">
            @if(Auth::guest())
                <div class="dropdown">
                    <a href="#" id="login-dropdown-toggle" class="dropdown-toggle m-collapsing-hide"
                       data-toggle="dropdown">
                        <div>
                            <img src="{{asset('images/icons/icon_login.png')}}">Вход
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right m-collapsing-hide" style="width: 100%">
                        <li><a href="{{route('login')}}">Логин</a></li>
                        <li><a href="{{route('register')}}">Регистрация</a></li>
                    </ul>
                </div>
            @else
                <a class="mobile-menu-item-profile" href="{{route('user.profile')}}">
                    <div>
                        <img src="{{asset('images/icons/icon_login.png')}}">Профиль
                    </div>
                </a>

            @endif

            <a class="mobile-menu-item-city" href="#city_modal" data-toggle="modal">
                <div><img src="{{asset('images/icons/icon_city.png')}}">{{\App\Helpers\SessionContext::city()->name}}
                </div>
            </a>

        </div>
        <div class="mobile-menu-item">
            <a class="text-center" href="{{route('doctors.searchPage')}}" target="">
                <div class="menu-item-content">
                    <div><img src="{{asset('images/icons/icon_expert.png')}}">Врачи</div>
                    <div class="color-light-green">{{\App\Doctor::localPublic()->count()}}</div>
                </div>
            </a>
        </div>
        <div class="mobile-menu-item">
            <a class="text-center" href="/medcenters" target="">
                <div class="menu-item-content">
                    <div><img src="{{asset('images/icons/icon_building.png')}}">Медцентры</div>
                    <div class="color-light-green">{{\App\Medcenter::localPublic()->count()}}</div>
                </div>
            </a>
        </div>
        <div class="mobile-menu-item">
            <a class="text-center" href="/#skills_full_list" target="">
                <div class="menu-item-content">
                    <div><img src="{{asset('images/icons/icon_sale.png')}}">Специализации<i
                                class="glyphicon glyphicon-chevron-down"></i></div>
                    <div class="color-light-green">{{\App\Skill::count()}}</div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    var $mobileMenuBtn = $('#mobile-menu-btn');
    var $mobileMenuContainer = $('#mobile-menu-container');
    var $mobileSkillsListBtn = $('#mobile-skills-list');
    $mobileMenuBtn.click(function (e) {
        $mobileMenuContainer.toggleClass("open");
    });

    $(document).click(function (e) {
        if (!$.contains($('.page-nav-container')[0], e.target) && $mobileMenuContainer.hasClass('open')) {
            e.preventDefault();
            $mobileMenuContainer.removeClass("open");
        }

    });
    var lastScrollTop = 0;
    var calcHeight = 150;
    var $nav = $('#page-nav');
    $(window).scroll(function (event) {
        var st = $(this).scrollTop();
        var delta = st - lastScrollTop;
        calcHeight = calcHeight - delta;


        if (calcHeight < 120) {
            calcHeight = 120;
            $nav.addClass('collapsing');
        }
        else if (calcHeight > 150) {
            calcHeight = 150;
            $nav.removeClass('collapsing');
        }

        lastScrollTop = st;
    });

    $('#header-phone-link').click(function () {
        ga('send', 'event', {
            eventCategory: 'phone_number',
            eventAction: 'call'
        });
    });
</script>