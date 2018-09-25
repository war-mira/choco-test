@include('redesign.layouts._header')

<body>
@include('partials.gtm-additionally')
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
<<<<<<< HEAD
@include('redesign.layouts._footer')
=======
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
>>>>>>> aisha-dev
</body>
</html>