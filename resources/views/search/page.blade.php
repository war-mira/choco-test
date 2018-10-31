@extends('redesign.layouts.inner-page')
@section('content')
    @include('search.search_box')

    <div id="app" class="app">
        <form id="search-form">
            @include('search.filtr_panel')
            <input type="hidden" name="page" value="{{$filter['page']??1}}">
            <div class="search-result">
                <div class="container">
                    <div class="search-result__list">
                        <div class="search-result__city-name">
                            <h1>
                                @if(!empty($meta['h1']))
                                    {{$meta['h1']}}
                                @endif
                            </h1>
                        </div>
                        <div class="search-result__spec-descr">
                            <p>Топ лучших специалистов в {{ $city->name }}. Список {{ isset($skill) ? mb_strtolower($skill->name).'ов' : '' }} с фото, отзывами, рейтингом и проверенными контактами.</p>
                            <p>Быстрый поиск и запись на прием к {{isset($skill) ? mb_strtolower($skill->name).'у':'' }} на iDoctor.kz.</p>
                        </div>
                        @if(isset($comercial))
                            @if($comercial)
                                @foreach($comercial->get() as $doctor)
                                    <div class="search-result__item entity-line doc-line" data-type="doctor"
                                         data-id="{{$doctor->id}}"
                                         id="doctor-result-{{$doctor->id}}">
                                        @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'comercial'=>true])
                                        @endcomponent
                                    </div>
                                @endforeach
                            @endif
                        @endif

                        @if(isset($doctorsTop))
                        @if($doctorsTop)
                            @foreach($doctorsTop as $doctor)
                                <div class="search-result__item entity-line doc-line" data-type="doctor"
                                     data-id="{{$doctor->id}}"
                                     id="doctor-result-{{$doctor->id}}">
                                    @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'top5'=>true])
                                    @endcomponent
                                </div>
                            @endforeach
                        @endif
                        @endif
                        @if(isset($doubleActiveDoctor))
                            <div class="search-result__item entity-line doc-line" data-type="doctor"
                                 data-id="{{$doubleActiveDoctor->id}}"
                                 id="doctor-result-{{$doubleActiveDoctor->id}}">
                                @component('model.doctor.prof_new',['doctor'=>$doubleActiveDoctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'doubleActiveDoctor'=>true, 'withLabel' => true])
                                @endcomponent
                            </div>
                        @elseif(isset($activeCommentsDoctor))
                            <div class="search-result__item entity-line doc-line" data-type="doctor"
                                 data-id="{{$activeCommentsDoctor->id}}"
                                 id="doctor-result-{{$activeCommentsDoctor->id}}">
                                @component('model.doctor.prof_new',['doctor'=>$activeCommentsDoctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'activeCommentsDoctor'=>true, 'withLabel' => true])
                                @endcomponent
                            </div>
                        @elseif(isset($activeAnswersDoctor))
                            <div class="search-result__item entity-line doc-line" data-type="doctor"
                                 data-id="{{$activeAnswersDoctor->id}}"
                                 id="doctor-result-{{$activeAnswersDoctor->id}}">
                                @component('model.doctor.prof_new',['doctor'=>$activeAnswersDoctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null,'responsiveDoctor'=>true, 'withLabel' => true])
                                @endcomponent
                            </div>
                        @endif
                        <div class="doctor_list content_scroll__block">
                            @foreach($doctors as $doctor)
                                <div class="search-result__item entity-line doc-line" data-type="doctor"
                                     data-id="{{$doctor->id}}"
                                     id="doctor-result-{{$doctor->id}}">
                                    @component('model.doctor.prof_new',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        @include('partials.loader')
                        @include('forms.public.order_doc')
                    </div>
                </div>
                @if($doctors->links() != "")
                    <div class="results filter">
                        <div class="container">
                            <div class="text-center search-pagination" id="topPagination">
                                {!! $doctors->appends(request()->query())->links() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if(isset($otherCityDoctors))
                <div class="search-result">
                    <div class="container">
                        <div class="search-result__list">
                            <div class="search-result__city-name">
                                <h2>
                                    Врачи в других городах
                                </h2>
                            </div>

                            <div class="doctor_list content_scroll__block">
                                @foreach($otherCityDoctors as $otherCityDoctor)
                                    <div class="search-result__item entity-line doc-line" data-type="doctor"
                                         data-id="{{$otherCityDoctor->id}}"
                                         id="doctor-result-{{$otherCityDoctor->id}}">
                                        @component('model.doctor.prof_new',['doctor'=>$otherCityDoctor,'width'=>'250px','highlightSkill'=>$highlightSkill??null])
                                        @endcomponent
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            @endif
        </form>
    </div>


@endsection

@push('custom.js')
<script>
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

        if ($('input[name="q"]').val().length) {
            $('.search-bar__item_search').find('input').val($('input[name="q"]').val().trim());
        }

        $('select[name="type"]').change(function () {

            var tp = $(this).val();
            var q = $('.search-bar__item').find('input').val();

            if (tp == 'medcenters') {
                $('div.search-bar__item_search').find('input').val('');
            }

            $.ajax({
                type: 'post',
                url: "{{url('getdata')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ttype: tp,
                    query: $('.search-bar__item').find('input').val()
                }
            });
        });

        $('div.search-bar__item_search').find('input').on('keyup', function (e) {
            var serachv = $(this).val();

            if (serachv.length >= 3) {
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

            if ($(this).find('i.fa').is('.fa-chevron-down')) {
                $(this).find('i.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
            else {
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
            if ($type == 'medcenters' || $('input[name="medc"]').val()) {
                $('input[name="q"]').val('');
                var url = "{{route('doctors.list')}}";
                var query = "{!!explode('?',url()->full())[1] ?? ""!!}";
                if (query.length > 0)
                    query = '?' + query;
                var skillUrl = url + '/' + $(this).val() + query;

                if ($(this).val() != $('input[name="medc"]').val() || $('input[name="medc"]').val() == '') {
                    window.location.assign(skillUrl);
                }
            }
        });
    });

</script>
@endpush