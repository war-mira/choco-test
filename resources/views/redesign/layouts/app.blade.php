<!DOCTYPE html>
<html lang="ru" class="no-js">
<head>
    @include('partials.meta')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fonts/stylesheet.css">
    <link rel="stylesheet" href="css/custom.css">
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}">
    <script src="{{asset('js/bootstrap-formhelpers.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"
            integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{URL::asset("bxslider/jquery.bxslider.min.css")}}">

    <script src="{{URL::asset("bxslider/jquery.bxslider.min.js")}}" type="text/javascript"></script>

    <!-- GA block -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-44507625-1', 'auto');
        ga('send', 'pageview');

    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-44507625-1"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-44507625-1');

        @if(!Auth::guest())
        gtag('set', {'user_id': '{{auth()->user()->id}}'}); // Задание идентификатора пользователя с помощью параметра user_id (текущий пользователь).
        @endif
    </script>
    <!-- end GA block -->
</head>
<body>
<div class="main-wrap">

    <section class="first-screen">
        <div class="header">
            <div class="container">
                <div class="row">
                    <!-- logo -->
                    <div class="col-sm-2">
                        <a href="#root-link">
                            <img src="img/white_logo.png" alt="">
                        </a>
                    </div>
                    <!-- /logo -->
                    <div class="col-sm-10">
                        <nav class="navibar">
                            <div class="navibar__nav-item">
                                <div class="partnership-btn">
                                    <img class="partnership-btn__icon" src="img/icons/partnership.svg" alt=""><span
                                            class="x14">Сотрудничество</span>
                                </div>
                            </div>
                            <!-- /partnership button -->
                            <div class="navibar__nav-item">
                                <a class="signup-btn" href="{{route('user.profile')}}">
                                    <img class="partnership-btn__icon" src="img/icons/user.svg" alt=""><span
                                            class="x14">Вход / Регистрация</span>
                                </a>
                            </div>
                            <div class="navibar__nav-item">
                                <div class="city-select">
                                    <img class="city-select__icon" src="img/icons/city.svg" alt=""><span class="x14">Алматы</span>
                                </div>
                            </div>
                            <div class="navibar__nav-item">
                                <div class="burger-menu">
                                    <div class="burger-menu__top"></div>
                                    <div class="burger-menu__middle"></div>
                                    <div class="burger-menu__bottom"></div>
                                </div>
                                <div class="main-nav-dropdown">
                                    <div class="main-nav-dropdown__inner">
                                        <ul class="main-nav-dropdown__ul">
                                            <li class="nav-dropdown__item">
                                                <a href="#">
                                                    <span class="dropdown-item__icon"><img src="img/icons/doctors.svg"
                                                                                           alt=""></span>
                                                    <span class="dropdown-item__text">Врачи</span>
                                                </a>
                                            </li>
                                            <li class="nav-dropdown__item">
                                                <a href="#">
                                                    <span class="dropdown-item__icon"><img src="img/icons/clinic.svg"
                                                                                           alt=""></span>
                                                    <span class="dropdown-item__text">Медцентры</span>
                                                </a>
                                            </li>
                                            <li class="nav-dropdown__item">
                                                <a href="#">
                                                    <span class="dropdown-item__icon"><img src="img/icons/tag.svg"
                                                                                           alt=""></span>
                                                    <span class="dropdown-item__text">Акции</span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown__phone">
                                                    <span class="phone__span">Ищете врача? Мы поможем!</span><br>
                                                    <span class="phone__number">+7 (727) 222-22-00</span>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- / Specialities -->
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /header -->
    @yield('header')
    <!-- /Search block -->
    </section>
    <!-- /First screen -->

    @yield('content')
    <footer>
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-sm-2">
                    <a href="{{url('/')}}">
                        <img src="img/white_logo.png" alt="">
                    </a>
                </div>
                <!-- /logo -->
                <div class="col-sm-7">
                    <div class="footer-navs">
                        <nav class="footer-nav">
                            <div class="footer-nav__title">Сервис</div>
                            <ul class="footer-nav__list">
                                <li><a href="#">О нас</a></li>
                                <li><a href="#">О рейтинге</a></li>
                                <li><a href="#">Блог </a></li>
                                <li><a href="#">Партнерам</a></li>
                                <li><a href="#">Правила сервиса</a></li>
                                <li><a href="#">Политика конфиденциальности</a></li>

                            </ul>
                        </nav>
                        <nav class="footer-nav">
                            <div class="footer-nav__title">Пациенту</div>
                            <ul class="footer-nav__list">
                                <li><a href="#">Врачи </a></li>
                                <li><a href="#">Клиники </a></li>
                                <li><a href="#">Специализации </a></li>
                                <li><a href="#">Акции </a></li>
                                <li><a href="#">Справочник заболеваний</a></li>


                            </ul>
                        </nav>
                        <nav class="footer-nav">
                            <div class="footer-nav__title">Врачу</div>
                            <ul class="footer-nav__list">
                                <li><a href="#">Регистрация</a></li>
                                <li><a href="#">Сотрудничество </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /Footer navigation -->
                <div class="col-sm-3">
                    <div class="contacts">
                        <div class="contacts__phone centred">
                            <span class="phone__span">Ищете врача? Мы поможем!</span><br>
                            <span class="phone__number">+7 (727) 222-22-00</span>
                        </div>
                        <div class="contacts__socials">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="socials__item">
                                        <a href="{{$social['fb']}}" target="_blank"><img src="img/icons/fb.svg" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="socials__item">
                                        <a href="{{$social['insta']}}" target="_blank"><img src="img/icons/insta.svg"
                                                                                            alt=""></a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="socials__item">
                                        <a href="{{$social['vk']}}" target="_blank"><img src="img/icons/vk.svg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contacts__checkin-btn">
                            Записаться на прием
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
<!-- Scripts -->

<script>
    $(document).ready(function () {
        $(".burger-menu").on('click', function (event) {
            event.preventDefault();
            $(".burger-menu").toggleClass('burger-menu--x');
        });

        $('#searchform').on('focus', function (e) {
            $('.search-results').toggleClass('search-results--fold');
        });

        $('#searchform').on('focusout', function (e) {
            $('.search-results').toggleClass('search-results--fold');
        });


        $('.burger-menu').on('click', function (e) {
            $('.main-nav-dropdown').toggleClass('dropdown--fold');
        });


        $('select').each(function () {
            var $this = $(this), numberOfOptions = $(this).children('option').length;

            $this.addClass('select-hidden');
            $this.wrap('<div class="select"></div>');
            $this.after('<div class="select-styled"></div>');

            var $styledSelect = $this.next('div.select-styled');
            $styledSelect.text($this.children('option').eq(0).text());

            var $list = $('<ul />', {
                'class': 'select-options'
            }).insertAfter($styledSelect);

            for (var i = 0; i < numberOfOptions; i++) {
                $('<li />', {
                    text: $this.children('option').eq(i).text(),
                    rel: $this.children('option').eq(i).val()
                }).appendTo($list);
            }

            var $listItems = $list.children('li');

            $styledSelect.click(function (e) {
                e.stopPropagation();
                $('div.select-styled.active').not(this).each(function () {
                    $(this).removeClass('active').next('ul.select-options').hide();
                });
                $(this).toggleClass('active').next('ul.select-options').toggle();
            });

            $listItems.click(function (e) {
                e.stopPropagation();
                $styledSelect.text($(this).text()).removeClass('active');
                $this.val($(this).attr('rel'));
                $list.hide();
                //console.log($this.val());
            });

            $(document).click(function () {
                $styledSelect.removeClass('active');
                $list.hide();
            });

        });


    });


</script>
<!-- /Scripts -->
</html>
