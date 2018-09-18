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
<noscript>
    <div><img src="https://mc.yandex.ru/watch/47714344" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
@stack('custom.js')