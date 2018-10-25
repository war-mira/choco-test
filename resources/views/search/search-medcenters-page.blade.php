@extends('redesign.layouts.inner-page')

@section('content')

    @include('search.medsearch')

    <div id="app" class="app">
        <form id="search-form">

            @include('search.filtr_med',compact('city'))


            <div class="search-result">
                <div class="container">
                    <div class="search-result__city-name">
                        <h1>
                            @if(!empty($meta['h1']))
                                {{$meta['h1']}}
                            @endif
                        </h1>
                    </div>
                    <div class="search-result__list">
                    @foreach($Medcenters as $medcenter)
                        <div class="results d-result search-result__item entity-line clinic-line" data-type="doctor" data-id="{{$medcenter->id}}"
                             id="doctor-result-{{$medcenter->id}}"
                             style="">

                            @component('model.medcenter.new_profile-short',['medcenter'=>$medcenter,'width'=>'250px',
                            'medcenterType' => $medcenterType??null,
                            'highlightSkill'=>$highlightSkill??null])
                            @endcomponent

                        </div>
                    @endforeach
                    </div>

                    @if($Medcenters->links() != "")
                    <div class="results d-result" style="">
                        <div class="text-center search-pagination" id="bottomPagination">
                            {!! $Medcenters->appends(request()->query())->links() !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @if(!empty($meta['seoText']))
                <div class="results" style="float: right;">{!! $meta['seoText'] !!}</div>
            @endif
        </form>
    </div>
    @include('forms.public.order_med_new')

@endsection
@push('custom.js')
    <script>
        if($('.search-input-group select').length)
        {
            $('.search-input-group select').selectpicker();
        }

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

            $('.btn_theme_radio').click(function () {
                var name = $(this).find('input').prop('name');
                var value = $(this).find('input').prop('value');

                $('input[name=' + name + ']').val([value]).trigger("change");
            });
            var $searchForm = $('#search-form');


            var $typeSelect = $('#typeSelect');
            var $skillSelect = $('#skillSelect');
            var $medcenterSelect = $('#medcenterSelect');
            //var doctorPriceSlider = $("#doctor_price").slider({tooltip: "always"}).data('slider');
            //var doctorRateSlider = $("#doctor_rate").slider({tooltip: "always"}).data('slider');

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
                //$searchForm.submit();
                $('form.search-bar__line').submit();
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
@endpush