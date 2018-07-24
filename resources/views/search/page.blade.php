@extends('new')
@section('content')
    @include('search.search_box')

    <div id="app" class="app">
        <form id="search-form">
            @include('search.filtr_panel')
            <input type="hidden" name="page" value="{{$filter['page']??1}}">
            <!--div class="search-input-group" id="mainSearch">
                <select data-style="search-type-input" id="typeSelect">
                    <option value="all">Все врачи</option>
                    <option value="skills">Специализации</option>
                </select>
                <select data-style="search-skill-select search-category-select"
                        data-live-search="true" id="skillSelect">
                    <option value="">Все</option>
                    {{--@foreach($skills as $skill)--}}
                        <option value="
{{--{{$skill->alias}}--}}
                ">
{{--{{$skill->name}}--}}
                </option>
                    {{--@endforeach--}}
                </select>
                <select data-style="search-medcenter-select search-category-select"
                        data-live-search="true"
                        id="medcenterSelect">
                    {{--@foreach($medcenters as $medcenter)--}}
                        <option value="
{{--{{$medcenter->alias}}--}}
                ">
{{--{{$medcenter->name}}--}}
                </option>
                    {{--@endforeach--}}
                </select>
                <input type="text" id="searchInput" name="q" class="search-box search-input"
                       placeholder="Поиск врачей..."
                       value="{{$filter['q']??''}}">
            </div-->
            <!--ul class="categories mbottom-40">
                <li class="search-li">
                    <a href="#doctorExtra" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <label class="text-justify" style="width: 90%">
                        Фильтр
                        <div class="badge badge-info badge-large pull-right"
                             style="margin-top: 10px"><span id="doctorsCountBadge">{{$doctors->total()}}</span> врачей
                        </div>
                    </label>
                </li>
                <li id="doctorExtra" class="collapse in slim-scroll search-li">
                    <ul>
                        <li class="search-li">
                            <div class="material-switch">
                                <input id='is_child' type="checkbox" name="child"
                                       value="1" {{($filter['child']?? false) ? 'checked':''}}/>
                                <label for='is_child' class="label-primary"></label>
                                <span style="color: black">Только детский</span>
                            </div>

                        </li>
                        <li class="search-li">
                            <div class="material-switch">
                                <input id='ambulatory' type="checkbox" name="ambulatory"
                                       value="1" {{($filter['ambulatory']?? false) ? 'checked':''}}/>
                                <label for='ambulatory' class="label-primary"></label>
                                <span style="color: black">Выезд на дом</span>
                            </div>
                        </li>
                        <li class="search-li" style="line-height: 30px;color: black">
                            <p>Стаж работы</p>
                            <b>0&nbsp;&nbsp;</b>
                            <input id="doctor_exp" type="text" value="" class="default-slider" name="exp_range"
                                   data-slider-min="0"
                                   data-slider-max="70"
                                   data-slider-step="1"
                                   data-slider-value="[{{$filter['exp_range'] ?? '0,70'}}]"/>
                            <b>&nbsp;&nbsp;70 лет</b>
                        </li>
                        <li class="search-li" style="line-height: 30px;color: black">
                            <p>Цена приема</p>
                            <b>0&nbsp;&nbsp;</b>
                            <input id="doctor_price" type="text" value="" class="default-slider" name="price_range"
                                   data-slider-min="0"
                                   data-slider-max="20000"
                                   data-slider-step="500"
                                   data-slider-value="[{{$filter['price_range'] ?? '0,20000'}}]"/>
                            <b>&nbsp;&nbsp;20 тыс</b>
                        </li>
                        <li class="search-li" style="line-height: 30px;color: black">
                            <p>Рейтинг</p>
                            <b>0&nbsp;&nbsp;</b>
                            <input id="doctor_rate" type="text" value="" class="default-slider" name="rate_range"
                                   data-slider-min="0"
                                   data-slider-max="5"
                                   data-slider-step="1"
                                   data-slider-value="[{{$filter['rate_range'] ?? '0,5'}}]"/>
                            <b>&nbsp;&nbsp;5</b>
                        </li>
                    </ul>
                </li>
                <li class="search-li">
                    <button type="submit" class="btn btn-success pull-right" style="margin-top: 10px">Применить</button>
                </li>
            </ul-->
            <!--div class="results filter">
                <span>Упорядочить</span>
                <div class="btn-group" id="filtersGroup">

                    <input type="radio" style="display:none;" name="order" value="asc">
                    <input type="radio" style="display:none;" name="order" value="desc">

                    <input type="radio" style="display:none;" name="sort" value="rate">
                    <button type="button" class="btn btn-default btn-radio" data-field="rate">
                        По Рейтингу&nbsp;
                        <span class="glyphicon glyphicon-chevron-down desc-label"></span>
                        <span class="glyphicon glyphicon-chevron-up asc-label"></span>
                    </button>
                    <input type="radio" style="display:none;" name="sort" value="exp">
                    <button type="button" class="btn btn-default btn-radio" data-field="exp">
                        По Стажу&nbsp;
                        <span class="glyphicon glyphicon-chevron-down desc-label"></span>
                        <span class="glyphicon glyphicon-chevron-up asc-label"></span>
                    </button>
                    <input type="radio" style="display:none;" name="sort" value="comments_count">
                    <button type="button" class="btn btn-default btn-radio" data-field="comments_count">
                        По Отзывам&nbsp;
                        <span class="glyphicon glyphicon-chevron-down desc-label"></span>
                        <span class="glyphicon glyphicon-chevron-up asc-label"></span>
                    </button>
                    <input type="radio" style="display:none;" name="sort" value="price">
                    <button type="button" class="btn btn-default btn-radio" data-field="price">
                        По цене&nbsp;
                        <span class="glyphicon glyphicon-chevron-down desc-label"></span>
                        <span class="glyphicon glyphicon-chevron-up asc-label"></span>
                    </button>
                </div>
                <div class="pull-right">

                </div>
            </div-->

            <div class="search-result">
                <div class="container">
                    <div class="search-result__list">

                        @if($comercial)
                        @foreach($comercial->get() as $doctor)
                            <div class="search-result__item entity-line doc-line" data-type="doctor" data-id="{{$doctor->id}}"
                                 id="doctor-result-{{$doctor->id}}" >
                                @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'comercial'=>true])
                                @endcomponent
                            </div>
                        @endforeach
                        @endif

                        @if($doctorsTop)
                            @foreach($doctorsTop as $doctor)
                                <div class="search-result__item entity-line doc-line" data-type="doctor" data-id="{{$doctor->id}}"
                                     id="doctor-result-{{$doctor->id}}" >
                                    @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'top5'=>true])
                                    @endcomponent
                                </div>
                            @endforeach
                        @endif

                        @foreach($doctors as $doctor)
                            <div class="search-result__item entity-line doc-line" data-type="doctor" data-id="{{$doctor->id}}"
                                 id="doctor-result-{{$doctor->id}}" >
                                    @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null])
                                    @endcomponent
                            </div>
                        @endforeach
                        @include('forms.public.order_doc')
                    </div>
                </div>
                @if($doctors->links() != "")
                    <div class="results filter">
                        <div class="text-center search-pagination" id="topPagination">
                            {!! $doctors->links() !!}
                        </div>
                    </div>
                @endif
            </div>

        </form>
    </div>
    <script>

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        //$('.search-input-group select').selectpicker();
        $(function () {

            $('#filtersGroup .sort-line__item').click(
                function () {
                    if ($(this).find('input[name=sort]').prop('checked')) {
                        var order = $('input[name=order]:checked').val();
                        order = (order == 'asc') ? 'desc' : 'asc';
                        $('input[name=order]').val([order]).trigger("change");
                    }
                }
            );

            if($('input[name="q"]').val().length)
            {
                $('.search-bar__item_search').find('input').val($('input[name="q"]').val().trim());
            }

            $('select[name="type"]').change(function () {
                $(".js-search-select")[0].selectize.clearOptions();

                var tp = $(this).val();

                if(tp == 'medcenters')
                {
                    $('div.search-bar__item_search').find('input').val('');
                }

                $.ajax({
                    type: 'post',
                    url:"{{url('getdata')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        ttype:tp,
                        query:$('.search-bar__item').find('input').val()
                    },
                    success: function(data) {
                        $(".js-search-select")[0].selectize.clearOptions();

                        for (var i = 0; i < data.length; i++) {
                            $(".js-search-select")[0].selectize.addOption(data[i]);
                        }
                        if($('input[name="medc"]').val().length)
                        {
                            $(".js-search-select")[0].selectize.setValue($('input[name="medc"]').val(),false);
                        }
                        
                    }
                });
            });

            $('div.search-bar__item_search').find('input').on('keyup',function (e) {
               var serachv = $(this).val();

                if(serachv.length >= 3)
                {
                    $('input[name="q"]').val(serachv);
                    $('input[name="q"]').change();
                }
            });

            $('a.sort-line__item').click(function () {
                $('a.sort-line__item').removeClass('btn_theme_radio_active');
                $(this).addClass('btn_theme_radio_active');
                var name = $(this).find('input').prop('name');
                var value = $(this).find('input').prop('value');
                $('input[name=' + name + ']').val([value]).trigger("change");
                $('form.search-bar__line').find('input[name="sort"]').val(value);
                $('form.search-bar__line').find('input[name="order"]').val($('input[name=order]:checked').val());

                if($(this).find('i.fa').is('.fa-chevron-down'))
                {
                    $(this).find('i.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }
                else{
                    $(this).find('i.fa').addClass('fa-chevron-down').removeClass('fa-chevron-up');
                }
                //console.log(name + ' ' + value + ' ' + $('input[name=order]:checked').val());
            });

            var $searchForm = $('#search-form');
            var $filteron = $('#filtersGroup');
            var $typeSelect = $('select[name="type"]');
            var $skillSelect = $('select[name="name_md"]');
            var $medcenterSelect = $('#medcenterSelect');
            /*var doctorExpSlider = $("#doctor_exp").slider({tooltip: "always"}).data('slider');
            var doctorPriceSlider = $("#doctor_price").slider({tooltip: "always"}).data('slider');
            var doctorRateSlider = $("#doctor_rate").slider({tooltip: "always"}).data('slider');

            $typeSelect.on('change', function () {
                var type = $(this).val();
                $('.search-category-select').parent().hide();

                if (type === 'medcenters') {
                    $(this).parent().removeClass('full-select');
                    $('.search-medcenter-select').parent().show();
                    $medcenterSelect.attr('disabled', false)
                }
                else if (type === 'skills') {
                    $(this).parent().removeClass('full-select');
                    $('.search-skill-select').parent().show();
                    $skillSelect.attr('disabled', false)
                }
                else {
                    $(this).parent().addClass('full-select');
                }
            });
            */

            $typeSelect.val('{{isset($filter['skill']) ? 'skills' : 'all'}}').trigger('change');
            $skillSelect.val('{{$filter['skill'] ?? null}}').trigger('change');
            $medcenterSelect.val('{{$filter['medcenter'] ?? null}}').trigger('change');
            $('input[name=sort]').val(['{{$filter['sort'] ?? 'rate'}}']).trigger('change');
            $('input[name=order]').val(['{{$filter['order'] ?? 'desc'}}']).trigger('change');

            $typeSelect.on('change', function () {
                if ($(this).val() === 'all') {
                    var url = "{{route('doctors.list')}}";
                    var query = "{!!explode('?',url()->full())[1] ?? ""!!}";
                    if (query.length > 0)
                        query = '?' + query;
                    var targetUrl = url + query;
                    //window.location.assign(targetUrl);
                }
            });

            $filteron.on('change', function () {
                var url = "{{route('doctors.list')}}";
                var query = "{!!explode('?',url()->full())[1] ?? ""!!}";
                if (query.length > 0)
                    query = '?' + query;
                var targetUrl = url + query;
                //window.location.assign(targetUrl);
            });

            $searchForm.find('#filtersGroup input[name], #mainSearch input[name],#mainSearch select[name]').on('change', function () {
                //$searchForm.submit();
                $('form.search-bar__line').submit();
            });

            $skillSelect.on('change', function () {
                var $type = $('select[name="type"]').val();
                console.log($type);
                if($type == 'medcenters' || $('input[name="medc"]').val())
                {
                    $('input[name="q"]').val('');
                    var url = "{{route('doctors.list')}}";
                    var query = "{!!explode('?',url()->full())[1] ?? ""!!}";
                    if (query.length > 0)
                        query = '?' + query;
                    var skillUrl = url + '/' + $(this).val() + query;

                    if($(this).val() != $('input[name="medc"]').val() || $('input[name="medc"]').val() == '')
                    {
                        window.location.assign(skillUrl);
                    }
                }
            });

            var callbackForm = $('form#callback_form');

            $("#save_order").click(function (e) {
                e.preventDefault();
                ga('send', 'event', {
                    eventCategory: 'zapisatsya',
                    eventAction: 'click'
                });
                //Ya goal
                yaCounter47714344.reachGoal('registration');

                if (callbackForm[0].checkValidity()) {
                    var formData = new FormData(callbackForm[0]);
                    console.log(getFormData(callbackForm));
                    formData.ga_cid =
                        $.getJSON("{{route('callback.newDoc')}}", getFormData(callbackForm))
                            .done(function (json) {
                                $.magnificPopup.close();
                                $.magnificPopup.open({
                                    items: {
                                        src: '#callback_mess_ok',
                                        type: 'inline'
                                    }
                                });
                            });
                }
            });
        });
    </script>
@endsection