@extends('redesign.layouts.app')
@section('content')
    <section class="search-screen">
        <div class="header inner-template">
            @include('redesign.partials.header')
        </div>
        <!-- /Title block -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="inner-template main-search-block">
                        @component('redesign.partials.index.search',compact('child', 'type', 'ambulatory', 'q','skill','district'))
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!-- /Search block -->
    </section>
    <section class="search-results">
        <div class="search-results__toolbar">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="search-results__toolbar__request">
                            {{($q??'Все врачи').' в г.'.$city->name}}
                        </div>
                        <div class="search-results__toolbar__results-qty">Найдено: <span
                                    class="search-results-qty-number">{{$total}}</span>
                        </div>
                    </div>
                    <!-- /Search results qty -->
                    <div class="col-12 col-sm-9">
                        <div class="search-results__sort  order-{{$order??'desc'}}" id="search-sort-toolbar">
                            <input type="hidden" name="order" value="{{$order??'desc'}}" form="search_form">
                            <ul class="sort-container">
                                <li class="sort-label">
                                    Сортировать по:
                                </li>
                                <li class="sort-type-item">
                                    <input id="sort_rate" type="radio" name="sort" value="rate" form="search_form"
                                           @if(($sort??false)=='rate') checked @endif>
                                    <label for="sort_rate" class="sort-type-item__order">Рейтингу</label>
                                </li>
                                <li class="sort-type-item">
                                    <input id="sort_exp" type="radio" name="sort" value="works_since" form="search_form"
                                           @if(($sort??false)=='works_since') checked @endif>
                                    <label for="sort_exp" class="sort-type-item__order">Стажу</label>
                                </li>
                                <li class="sort-type-item">
                                    <input id="sort_comments" type="radio" name="sort" value="comments_count"
                                           form="search_form" @if(($sort??false)=='comments_count') checked @endif>
                                    <label for="sort_comments" class="sort-type-item__order">Отзывы</label>
                                </li>
                                <li class="sort-type-item">
                                    <input id="sort_price" type="radio" name="sort" value="price" form="search_form"
                                           @if(($sort??false)=='price') checked @endif>
                                    <label for="sort_price" class="sort-type-item__order">Стоимости</label>
                                </li>
                                <li class="sort-type-item">
                                    <input id="sort_pop" type="radio" name="sort" value="orders_count"
                                           form="search_form"
                                           @if(($sort??false)=='popularity') checked @endif>
                                    <label for="sort_pop" class="sort-type-item__order">Посещаемости</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /Search results qty -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($doctors as $doctor)
                    <div class="col-sm-12">
                        @component('redesign.doctors.partials.profile-card',compact('doctor'))
                        @endcomponent
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{$pagination}}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            var sortContainer = $('#search-sort-toolbar');
            sortContainer.find('input[name="sort"]').click(function (e) {
                var order = sortContainer.find('input[name="order"]').val();
                if ($(this).prop('checked')) {
                    newOrder = order == 'asc' ? 'desc' : 'asc';
                    sortContainer.find('input[name="order"]').val(newOrder);
                    sortContainer.removeClass('order-' + order).addClass('order-' + newOrder);
                }
                $('#search_form').submit();
            });
        });
    </script>
@endsection
@push('modals')
    @include('redesign.partials.modals.extended-order')
@endpush