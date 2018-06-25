@extends('app')
@section('content')
    <link href="{{asset('css/searchpage.css?asgea')}}" rel="stylesheet">
    @if(!empty($meta['h1']))
    <div class="filter text-center">
        <h1>{{$meta['h1']}}</h1>
    </div>
    @endif
    <div id="app" class="app">
        <form id="search-form">
            <input type="hidden" name="page" value="{{$filter['page']??1}}">
            <div class="search-input-group" id="mainSearch">

                <input type="text" id="searchInput" name="q" style="margin-left: 0" class="search-box search-input"
                       placeholder="Поиск медцентров ..."
                       value="{{$filter['q']??''}}">
            </div>
            <ul class="categories mbottom-40">
                <li class="search-li">
                    <a href="#doctorExtra" data-toggle="collapse"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <label class="text-justify" style="width: 90%">
                        Фильтр
                        <div class="badge badge-info badge-large pull-right"
                             style="margin-top: 10px"><span id="doctorsCountBadge">{{$Medcenters->total()}}</span> медцентров
                        </div>
                    </label>
                </li>
                <li id="doctorExtra" class="collapse in slim-scroll search-li">
                    <ul>
                        <li class="search-li">
                            <div class="material-switch">
                                <input id='ambulatory' type="checkbox" name="ambulatory"
                                       value="1" {{($filter['ambulatory']?? false) ? 'checked':''}}/>
                                <label for='ambulatory' class="label-primary"></label>
                                <span style="color: black">Выезд на дом</span>
                            </div>
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
            </ul>
            <div class="results filter">
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
            </div>
            @if($Medcenters->links() != "")
            <div class="results filter">
                <div class="text-center search-pagination" id="topPagination">
                    {!! $Medcenters->links() !!}
                </div>
            </div>
            @endif
            @foreach($Medcenters as $medcenter)
                <div class="results d-result" data-type="doctor" data-id="{{$medcenter->id}}"
                     id="doctor-result-{{$medcenter->id}}"
                     style="float: right">
                    <div class="list-group-item{{(isset($medcenter['is_top_doc']) && $medcenter['is_top_doc']) ? " pretty_profile" : "" }}">
                        @component('model.medcenter.profile-short',['medcenter'=>$medcenter,'width'=>'250px','highlightSkill'=>$highlightSkill??null])
                        @endcomponent
                    </div>
                </div>
            @endforeach
            @if($Medcenters->links() != "")
            <div class="results d-result" style="float: right">
                <div class="text-center search-pagination" id="bottomPagination">
                    {!! $Medcenters->links() !!}
                </div>
            </div>
            @endif
            @if(!empty($meta['seoText']))
                <div class="results" style="float: right;">{!! $meta['seoText'] !!}</div>
            @endif
        </form>
    </div>
    <script>
        $('.search-input-group select').selectpicker();
        $(function () {


            $('#filtersGroup .btn-radio').click(
                function () {
                    if ($(this).prev('input[name=sort]').prop('checked')) {
                        var order = $('input[name=order]:checked').val();
                        order = (order == 'asc') ? 'desc' : 'asc';
                        $('input[name=order]').val([order]).trigger("change");
                    }
                });
            $('.btn-radio').click(function () {
                var name = $(this).prev().prop('name');
                var value = $(this).prev().prop('value');

                $('input[name=' + name + ']').val([value]).trigger("change");
            });
            var $searchForm = $('#search-form');


            var $typeSelect = $('#typeSelect');
            var $skillSelect = $('#skillSelect');
            var $medcenterSelect = $('#medcenterSelect');
            var doctorPriceSlider = $("#doctor_price").slider({tooltip: "always"}).data('slider');
            var doctorRateSlider = $("#doctor_rate").slider({tooltip: "always"}).data('slider');

            $typeSelect.on('change', function () {
                var type = $(this).val();
                $('.search-category-select').parent().hide();
                $($skillSelect, $medcenterSelect).attr('disabled', true);

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
                    window.location.assign(targetUrl);
                }
            });
            $searchForm.find('#filtersGroup input[name], #mainSearch input[name],#mainSearch select[name]').on('change', function () {
                $searchForm.submit();
            });

            $skillSelect.on('change', function () {
                var url = "{{route('doctors.list')}}";
                var query = "{!!explode('?',url()->full())[1] ?? ""!!}";
                if (query.length > 0)
                    query = '?' + query;
                var skillUrl = url + '/' + $(this).val() + query;
                window.location.assign(skillUrl);
            });

        });
    </script>
@endsection