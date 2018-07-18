<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.meta')
    @include('partials.yandex-metrika')
    @include('partials.google-experiment')
    @include('partials.google-analytics')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset("css/bootstrap-datetimepicker.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("bxslider/jquery.bxslider.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/cabinet.css?2v346gh")}}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css?v2346h2') }}">
    <link href="{{URL::asset('css/select2.min.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/material-switch.css')}}">
    <script src="{{URL::asset("bxslider/jquery.bxslider.min.js")}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}">
    <script src="{{asset('js/bootstrap-formhelpers.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"
            integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i"
            crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <link rel="stylesheet" href="{{asset("vendor/bootstrap-slider/css/bootstrap-slider.min.css")}}">

    <link rel="stylesheet" href="{{asset("css/header.css?hw34h")}}">
    <link rel="stylesheet" href="{{asset("css/styles.css?ewg5")}}">
    <link rel="stylesheet" href="{{asset("css/controls.css?hw34h")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/comments.css?hw34h')}}">
    <link rel="stylesheet" href="{{asset("css/load-spinner.css?hw34h")}}">

    <script src="{{asset("vendor/bootstrap-slider/bootstrap-slider.min.js")}}"></script>
    <script src="{{asset('js/infinite-paginator.js?2vg346gh')}}"></script>
    <script src="{{asset('js/infinite-paginator.js?2vg346gh')}}"></script>

    <link rel="stylesheet" href="{{asset("css/typography.css?cv23v46bh")}}">

    <script>
        function copyToClipboard(id) {
            var elt = $("#" + id)[0];
            var plainNum = $(elt).val().match(/\d/g).slice(1).join('');
            var oldFormat = $(elt).data('format');

            $(elt).val("8" + plainNum);
            $(elt).select();
            document.execCommand("copy");
            $(elt).val("+7" + plainNum);
            $(elt).bfhphone({format: oldFormat}).trigger('keyup');

        }

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }
    </script>

</head>
<body>
@component('components.common.header'.(request()->query('header','')))
@endcomponent

<!-- begin wrap -->
<div class="wrap root-wrap">
    <!-- begin content -->
    <div class="content">
        @include('components.reception-modal')
        @include('components.city-modal')
        @include('components.feedback-modal')
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
                <li><a class="icon-facebook" target="_blank" href="https://www.facebook.com/kz.idoctor" rel="nofollow">fb</a></li>
                <li><a class="icon-vk" target="_blank" href="https://vk.com/idoctorkz1" rel="nofollow">vk</a></li>
                <li><a class="icon-instagram" target="_blank" href="https://www.instagram.com/idoctor_kz/" rel="nofollow">ins</a></li>
            </ul>
        </div>
        <div class="pull-right">
            <a class="btn btn-lg btn-default" data-toggle="modal" href="#feedback_modal">Обратная связь</a>
        </div>
        <!-- end footer__copyright -->
    </div>
</footer>


@foreach(\App\Model\Admin\PageNotification::all() as $notification)
    @if($notification->tryShow)
        @component('components.page-notification',compact('notification'))
        @endcomponent
    @endif
@endforeach

<script type="text/javascript">
    $("#setskill").click(function () {
        $("#search_input").val($("#setskill").text());
    });
</script>

</body>
</html>
