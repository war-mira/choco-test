<div class="index-intro__search-bar search-bar index-search-bar">
    <form action="{{($type ?? 'doctor') == 'doctor'? route('doctors.list',['skill'=>$skill->alias?? null]) : route('medcenters.list')}}" class="search-bar__line index-search-bar__line">
        <div class="search-bar__item search-bar__item_type">
            <select name="type" placeholder="Поиск медцентра" class="js-simple-select js-type-select" data-select="action">
                <option data-action="{{route('doctors.list')}}" value="doctor">Поиск врача</option>
                <option  data-action="{{route('medcenters.list')}}" value="medcenter">Поиск медцентра</option>
            </select>
        </div>
        <div class="search-bar__item search-bar__item_search">
            <input id="searchform" name="q" value="{{$q ?? ""}}"  placeholder="Введите специальность или фамилию врача" class="js-search-input"  autocomplete="off">
            <label for="searchform" class="input-block__icon"><img src="{{asset('/img/icons/search-inactive.png')}}" alt=""></label>
            <div class="live-search">
                <div class="live-search__inner" id="liveresults">
                </div>
            </div>
        </div>
        <div class="search-bar__item search-bar__item_region">
            <select name="district" placeholder="Алмалинский район" class="js-simple-select js-select-region">
                @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-bar__item search-bar__item_submit">
            <button class="btn search_event">Найти</button>
        </div>
    </form>
</div>

<script>
    var liveSearchXHR = null;

    function livesearch() {
        var input = $("#searchform").val();

        if (liveSearchXHR !== null)
            liveSearchXHR.abort();

        setTimeout(function () {
            var url = "{{url("/ajax/index_search")}}?q=" + input;
            liveSearchXHR = $.get(url, function (data, textStatus) {
                $("#liveresults").html(data);
            });
        }, 300);
    }

    $("#searchform").on('input', livesearch);

    $('form').each(function () {
        var $form = $(this);
        $form.on('change', 'select[data-select="action"]',  function () {
            var type = $form.find('option:selected').val();
            var action = '';
            if (type == 'doctor'){
                action = "{!!route('doctors.list')!!}";
            }else {
                action = "{!! route('medcenters.list') !!}";
            }
            $form.attr('action', action);
        });
    });

    $('.search_event').on('click', function () {
        ga('send', 'event', {
            eventCategory: 'poisk_glavnaya',
            eventAction: 'click'
        });
    })

</script>