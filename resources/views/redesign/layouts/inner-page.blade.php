<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.meta')
    @include('partials.yandex-metrika')
    @include('partials.google-analytics')

    <title>Главная - iDoctor</title>
    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"> -->
    <link rel="stylesheet" href="{{URL::asset("css/app.css")}}">
    {{--<link rel="stylesheet" href="{{URL::asset("css/normalize.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/slick.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/lightbox.min.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/font-awesome.min.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/selectize.default.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/hover-icon.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/pickmeup.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/magnific-popup.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/main_new.css")}}">--}}
    {{--<link rel="stylesheet" href="{{URL::asset("css/public_new.css")}}">--}}

    {{--<script src="{{URL::asset("js/jquery.min.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/jquery-masked-input.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/slick.min.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/lightbox.min.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/selectize.min.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/pickmeup.min.js")}}"></script>--}}
    {{--<script src="{{URL::asset("js/jquery.magnific-popup.min.js")}}"></script>--}}

</head>
<body>
<div class="main-wrap" id="app">

    @include('redesign.partials.header')
    <section class="index-intro pattern-bg library">
        @include('redesign.partials.nav_line')
        {{--@include('redesign.partials.index.search')--}}
    </section>
    @yield('navigation')
    @yield('breadcrumbs')
    @yield('content')
    @include('redesign.partials.footer')
    <div class="modal-container">
        @include('redesign.partials.modals.modal-login')
        @include('redesign.partials.modals.quick-order')
        @include('redesign.partials.modals.feedback-callback',['skillsList'=> $skillsList??[]])
    </div>
</div>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="{{URL::asset("js/all.js")}}"></script>
<script src="{{URL::asset("js/scripts.js")}}"></script>
<script src="{{URL::asset("js/app.js")}}"></script>
<script type="text/javascript">
    $('.search_event').on('click', function () {
        ga('send', 'event', {
            eventCategory: 'poisk_glavnaya',
            eventAction: 'click'
        });
    });
</script>
@stack('custom.js')
</body>
</html>