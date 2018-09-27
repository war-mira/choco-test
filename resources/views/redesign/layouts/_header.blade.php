<!DOCTYPE html>
<html lang="ru-RU">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.meta')
    @include('partials.yandex-metrika')
    @include('partials.google-analytics')
    @include('partials.gtm')

    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"> -->
    <link rel="stylesheet" href="{{hotreload("/build/css/app.css")}}">
    @stack('custom.css')

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