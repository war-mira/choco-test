<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная - iDoctor</title>
    <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"> -->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/lightbox.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/selectize.default.css">
    <link rel="stylesheet" href="/css/hover-icon.css">
    <link rel="stylesheet" href="/css/pickmeup.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/main_new.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-masked-input.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/lightbox.min.js"></script>
    <script src="/js/selectize.min.js"></script>
    <script src="/js/pickmeup.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="/js/scripts.js"></script>


</head>
<body>
<div class="main-wrap">

    @include('redesign.partials.header')
    @yield('content')
    @include('redesign.partials.footer')
    @include('redesign.partials.modal-login')
</div>
</body>
</html>
