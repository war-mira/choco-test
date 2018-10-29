@include('redesign.layouts._header')
<body>
@include('partials.gtm-additionally')
<div class="main-wrap">
    @include('redesign.partials.header')
    {{--<div id="app">--}}
        @yield('content')
    {{--</div>--}}
    @include('redesign.partials.footer')
    <div class="modal-container">
        @include('redesign.partials.modals.modal-login')
        @include('redesign.partials.modals.quick-order')
        @include('redesign.partials.modals.feedback-callback')
        @include('redesign.partials.modals.ask-doctor',['skillsList'=> $skillsList??[]])
    </div>
</div>
@include('redesign.layouts._footer')

</body>
</html>