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
        @include('redesign.partials.modals.feedback-callback')
        @include('redesign.partials.modals.ask-doctor',['skillsList'=> $skillsList??[]])
    </div>
</div>

@include('redesign.layouts._footer')

</body>
</html>