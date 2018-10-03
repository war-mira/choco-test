<!DOCTYPE html>
<html lang="ru">
<head>
    @include('partials.meta')
    @include('partials.yandex-metrika')
    @include('partials.google-analytics')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/material-switch.css')}}">
    <link rel="stylesheet" href="{{asset("css/main.css?ewg5")}}">
    <link rel="stylesheet" href="{{asset("css/feedback.css?ewg5")}}">
</head>
<body>

<!-- begin wrap -->
<div class="wrap doctors-feedback-wrap">
        @include('components.common.feedback-header')
    <!-- begin content -->
    <div class="content">
        @yield('content')
    </div>
    <!-- end content -->
</div>
<!-- end wrap -->
<!-- begin footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <!-- begin footer__copyright -->
        <div class="footer__copyright">
            <div class="footer__copyright-text">
                <p>&copy;2013–2017 ТОО “iDoctor.kz”</p>
                <p class="footer__phone">
                    <a href="tel:+7(727)2222200" style="text-decoration: none;"><span>+7 (727) 222 22 00</span></a>
                </p>

                {{--<p class="footer__phone">
                    <a style="text-decoration: none;" href="tel:+7(771)5033221"><span>+7 (771) 503 32 21</span></a>
                </p>--}}
                <p>Все права защищены.</p>
            </div>
            <ul class="footer__social">
                <li><a class="icon-facebook" target="_blank" href="https://www.facebook.com/kz.idoctor">fb</a></li>
                <li><a class="icon-vk" target="_blank" href="https://vk.com/idoctorkz1">vk</a></li>
                <li><a class="icon-instagram" target="_blank" href="https://www.instagram.com/idoctor_kz/">ins</a></li>
            </ul>
        </div>
        <div class="pull-right">
            <a class="btn btn-lg btn-default" data-toggle="modal" href="#feedback_modal">Обратная связь</a>
        </div>
        <!-- end footer__copyright -->
    </div>
</footer>
</body>
</html>
