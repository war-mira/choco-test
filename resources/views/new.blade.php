<!DOCTYPE html>
<html lang="ru">
<head>
    @include('partials.meta')
    @include('partials.yandex-metrika')
    @include('partials.google-analytics')

    <link rel="stylesheet" href="{{asset("css/normalize.css")}}">
    <link rel="stylesheet" href="{{asset("css/slick.css")}}">
    <link rel="stylesheet" href="{{asset("css/lightbox.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/selectize.default.css")}}">
    <link rel="stylesheet" href="{{asset("css/hover-icon.css")}}">
    <link rel="stylesheet" href="{{asset("css/pickmeup.css")}}">
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{URL::asset('css/main1.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('js/jquery-masked-input.js')}}"></script>
    <script src="{{asset('js/slick.min.js')}}"></script>
    <script src="{{asset('js/lightbox.min.js')}}"></script>
    <script src="{{asset('js/selectize.min.js')}}"></script>
    <script src="{{asset('js/pickmeup.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="{{asset('js/scripts.js')}}"></script>

</head>
<body>
@component('components.common.head'.(request()->query('header','')))
@endcomponent

<!-- begin wrap -->
<div class="wrap root-wrap">
    <!-- begin content -->
    <div class="content">
        @php
        /*@include('components.reception-modal')
        @include('components.city-modal')
        @include('components.feedback-modal')*/
        @endphp
        @yield('content')
    </div>
    <!-- end content -->
</div>
<!-- end wrap -->
<!-- begin footer -->
@include('footer')
<!-- end footer -->
@foreach(\App\Model\Admin\PageNotification::all() as $notification)
    @if($notification->tryShow)
        @component('components.page-notification',compact('notification'))
        @endcomponent
    @endif
@endforeach


<script type="text/javascript">

    function get_times(doc,day,obj,fast = '')
    {
        var $ret = '';
        $.getJSON("{{route('get_dt')}}", {day:day,idc:doc})
        .done(function (json) {
            if(json)
            {
                if(!fast){
                    $(obj).parent().parent().parent().parent().find('div.appointment-book-big__time-list').html(json.times);
                }
                else {
                    $(fast).find('.appointment-book-big__time-list,.appointment-book-small__time-list').html(json.times);
                }
            }
        });
    }



    $(function () {
        $('.thumb-control button').click(function (e) {
            e.preventDefault();
            var btn = $(this);
            var $doc = $(this).closest('.search-result__item').data('id'),
                type = $(this).data('type');

            $.getJSON("{{route('rates')}}", {likenot:type,doc:$doc})
                .done(function (json) {
                    btn.closest('.thumb-control').html(json.rates);
                });
        });
        $("#setskill").click(function () {
            $("#search_input").val($("#setskill").text());
        });
    })
</script>

</body>
</html>