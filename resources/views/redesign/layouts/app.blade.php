@include('redesign.layouts._header')
<body>
@include('partials.gtm-additionally')
<div class="main-wrap" >
    <div id="app"></div>
    @include('redesign.partials.header')
    @yield('content')
    @include('redesign.partials.footer')
    <div class="modal-container">
        @include('redesign.partials.modals.modal-login')
        @include('redesign.partials.modals.quick-order')
        @include('redesign.partials.modals.feedback-callback')
    </div>
</div>

@include('redesign.layouts._footer')

</body>
</html>