@include('redesign.layouts._header')

<body>
@include('partials.gtm-additionally')
<div class="main-wrap" >
    @include('redesign.partials.header')
    <section class="index-intro pattern-bg cabinet">
        @include('redesign.partials.nav_line')
    </section>
    <main class="account-wrapper pattern-bg">
        <div class="container" id="app">
            @yield('content')
        </div>
    </main>
    @include('redesign.partials.footer')
    <div class="modal-container">
        @include('redesign.partials.modals.modal-login')
        @include('redesign.partials.modals.quick-order')
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
@include('redesign.layouts._footer')
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="display: none">
    <filter id="blur">
        <feGaussianBlur stdDeviation="3"/>
    </filter>
</svg>
</body>
</html>
