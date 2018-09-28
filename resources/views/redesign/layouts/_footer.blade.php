<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="{{hotreload("/build/js/app.js")}}"></script>

<script type="text/javascript">
    $('.search_event').on('click', function () {
        ga('send', 'event', {
            eventCategory: 'poisk_glavnaya',
            eventAction: 'click'
        });
    });
    var project ={
        messages:{!! \App\Components\ToastrNotification::get()??'[]' !!}
    };

    project.messages.forEach(function(msg){
        try{
            if(msg.type == 'warning'){
                toastr.warning(msg.msg);
            } else if(msg.type == 'success'){
                toastr.success(msg.msg);
            }

        } catch(err){}
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/47714344" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
@stack('custom.js')