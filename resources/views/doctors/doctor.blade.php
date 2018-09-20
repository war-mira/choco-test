<section class="entity-line-container">
    <div class="container">
        <div class="search-result__item entity-line doc-line" data-id="{{$doctor->id}}">
            <div class="entity-line__img">
                <div class="entity-thumb-img">
                    <div class="entity-thumb-img__img-wr">
                        @component('components.prof-img')
                            @slot('src')
                                {{$doctor['avatar']}}
                            @endslot
                            @slot('width')
                                250px
                            @endslot
                            @slot('height')
                                250px
                            @endslot
                            @slot('on_top')
                                {{$doctor->on_top}}
                            @endslot
                            @slot('alt')
                                {{$doctor->name}}
                            @endslot
                        @endcomponent
                    </div>
                    <div class="entity-thumb-img__rating-line rating-line">
                        <div class="rating-line__val">{{$doctor->avg_rate}}</div>
                        <div class="rating-line__stars">
                            @component('components.rstars',['rating' => $doctor->avg_rate == 0 ? 5:$doctor->avg_rate])
                            @endcomponent
                        </div>
                    </div>
                    <div class="entity-thumb-img__bot-line">
                        <?php if(!empty($doctor->publicComments()->count())){ ?>
                        &nbsp;&nbsp;<a class="entity-thumb-img__reviews"
                                       href="#comments">{{$doctor->publicComments()->count()}} отзывов</a>
                        <?php }else { ?>
                        &nbsp;&nbsp;<a href="#comments">Нет отзывов</a>
                        <?php } ?>
                        <inp-rate obj="doctor" id="{{ $doctor->id }}" type="likes">
                            <template slot="likes">{{ $doctor->likes }}</template>
                            <template slot="dislikes">{{ $doctor->dislikes }}</template>
                        </inp-rate>
                    </div>
                </div>
            </div>
            <div class="entity-line__main">
                <div class="entity-line__name"><h1>{{$doctor['name']}}</h1></div>
                <div class="entity-line__descr">@foreach ($doctor['skills'] as $i=>$skill)<a href="{{$skill->href}}"
                                                                                             style="text-decoration: none">{{$skill->name }}</a>
                    @if(count($doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1)) / @endif  @endforeach</div>
                @if($doctor['qualification'])
                    <div class="entity-line__label">{{$doctor['qualification']}}</div>@endif
                <div class="entity-line__features">
                    <div class="entity-line__feature entity-feature">
                        <div class="entity-feature__icon">
                            <img src="{{asset('img/icon-doc.svg')}}" alt="">
                        </div>
                        <div class="entity-feature__info">
                            <div class="entity-feature__name">Стаж работы</div>
                            <div class="entity-feature__descr">{{$doctor->exp_formatted}}</div>
                        </div>
                    </div>
                    <div class="entity-line__feature entity-feature">
                        <div class="entity-feature__icon">
                            <img src="{{asset('img/icon-truck.svg')}}" alt="">
                        </div>
                        <div class="entity-feature__info">
                            <div class="entity-feature__name">Выезд на дом</div>
                            @if($doctor['ambulatory']==1)
                                <div class="entity-feature__descr entity-feature__descr_positive">Да</div>
                            @else
                                <div class="entity-feature__descr entity-feature__descr_negative">Нет</div>
                            @endif
                        </div>
                    </div>
                    <div class="entity-line__feature entity-feature">
                        <div class="entity-feature__icon">
                            <img src="{{asset('img/icon-baby.svg')}}" alt="">
                        </div>
                        <div class="entity-feature__info">
                            <div class="entity-feature__name">Детский врач</div>
                            @if($doctor['child']==1)
                                <div class="entity-feature__descr entity-feature__descr_positive">Да</div>
                            @else
                                <div class="entity-feature__descr entity-feature__descr_negative">Нет</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="entity-line__about-block">
                    @if(!empty(trim($doctor->about_text)) && trim($doctor->about_text) != '0')
                        <div class="entity-line__about-text">
                            <div>{!! str_replace('\r\n', '<br />', $doctor->about_text) !!}</div>
                        </div>
                        @if(strlen($doctor->about_text) > 465)
                            <div class="entity-line__about-text-more">
                                <a href="#">Подробнее</a>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="entity-line__additional appointment-book-small">
                    {{--@if($doctor->partner == \App\Doctor::PARTNER || $doctor->whoIsIt() == \App\Doctor::TYPE[2])--}}
                    <div class="appointment-book-big__heading">Записаться на прием</div>
                    {{--@endif--}}
                    <div class="appointment-book-small-header-block">
                        <div class="appointment-book-small__line">
                            <div class="appointment-book-small__timeline">
                                {!! $doctor->timetable !!}
                            </div>
                            @if($doctor->whoIsIt() == \App\Doctor::TYPE[3] || $doctor->whoIsIt() == \App\Doctor::TYPE[5])
                                <div class="appointment-book-small__bot-line">
                                    <find-doctor-btn model="{{ \App\Doctor::FIND_DOCTOR_COUNT }}"
                                                     id="{{ $doctor->id }}">
                                        <template slot="link-to-modal"></template>
                                    </find-doctor-btn>
                                    <a href="{{ route('register') }}" class="btn btn_theme_usual btn_it-is-me">Это я</a>
                                </div>
                            @else
                                @if( $doctor->whoIsIt() != \App\Doctor::TYPE[4] && $doctor->whoIsIt() != \App\Doctor::TYPE[5])
                                    <phone-show-btn model="{{ \App\Doctor::SHOW_PHONE_COUNT }}" id="{{ $doctor->id }}">
                                        <template slot="phone-number"></template>
                                    </phone-show-btn>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if($doctor->partner == \App\Doctor::PARTNER || $doctor->whoIsIt() == \App\Doctor::TYPE[2])
                        <form action="#" class="">
                            <div class="appointment-book-small__line">
                                @if(!empty($doctor->price))
                                    <div class="appointment-book-small__price">
                                        <div class="appointment-book-small__price-text">Прием от:</div>
                                        <div class="appointment-book-small__price-val">от {{$doctor->price}} тг</div>
                                    </div>
                                @endif
                                <a href="#order_doctor" data-doc-id="{{$doctor->id}}" data-dname="{{$doctor['name']}}"
                                   class="appointment-book-small__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span
                                            class="hidden-xl"> онлайн</span></a>
                            </div>
                        </form>
                    @endif
                </div>

            </div>
            <div class="entity-line__additional">
                @if(count($doctor->medcenters) >1)
                    <div class="entity-line__address-select">
                        <select class="js-simple-select js-select-medcenter">
                            @foreach($doctor->medcenters as $medcenter)
                                <option data-data='{"address": "{{trim($medcenter->sms_address)}}"}'
                                        value="{{ $medcenter->coordinates }}">{{ $medcenter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="entity-line__map entity-map" id="entity-map">
                    <div class="entity-map__address">
                        <div class="entity-map__address-name">{{$doctor->city->name}}
                            , {{$doctor->medcenters->first() ? $doctor->medcenters->first()->sms_address:''}}</div>
                        @if($doctor['address'])
                            <div class="entity-map__address-descr">({{$doctor['address']}})</div>@endif
                    </div>
                </div>
                @if(count($doctor->medcenters))
                    @php
                        $center = $doctor->medcenters->first()->coordinates;
                    @endphp
                @else
                    @php
                        $center = \App\Medcenter::find($doctor->med_id)->coordinates;
                    @endphp
                @endif
                <script type="text/javascript">
                    ymaps.ready(function () {

                        var myMap = new ymaps.Map("entity-map", {
                            center: [{{ $center }}],
                            zoom: 15
                        });

                                @foreach($doctor->medcenters as $med)
                        var pl = new ymaps.Placemark([{{ $med->coordinates }}]);
                        myMap.geoObjects.add(pl);
                        @endforeach

                        $('.js-select-medcenter').on('change', function () {
                            let medcenterCoords = $(this).val();
                            let address = $(this).parents('.entity-line__address-select').find('.selectize-control').find('.items').find('div').data('address');
                            $('.entity-map__address-name').text(address);

                            myMap.panTo(
                                [medcenterCoords.split(", ")]
                            )
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</section>

<section class="entity-about">
    <div class="container">
        <div class="entity-about__tab-line tabs">
            <a href="#" data-tab="tab-1" class="entity-about__tab-item">
                <h2 class="entity-about__tab-name">О враче</h2>
            </a>

            <a href="#" data-tab="tab-2" class="entity-about__tab-item entity-about__tab-item_active">
                <h2 class="entity-about__tab-name">Отзывы<span
                            class="entity-about__tab-count">{{$doctor->publicComments()->count()}}</span>
                </h2>
            </a>
            {{--<a href="#" data-tab="tab-3" class="entity-about__tab-item">--}}
            {{--<h2 class="entity-about__tab-name">Акции и скидки</h2>--}}
            {{--</a>--}}
        </div>

        <div class="entity-about__content entity-content">
            <div id="tab-1" class="entity-about-article">
                <div class="entity-content__main">
                    @foreach(App\Doctor::CONTENTS as $field=>$title)
                        @if(!empty(trim($doctor[$field])) && $doctor[$field] != '0' && strlen($doctor[$field])>10)
                            <h3><span class="entity-about-article__heading">{{$title}}</span></h3>
                            <div>{!! str_replace('\r\n', '<br />', $doctor[$field]) !!}</div>
                        @endif
                    @endforeach
                </div>
                <div class="entity-content__aside">
                    @component('elements.side-banner',['position' => App\Banner::POSITION_EXT_C['id']])@endcomponent
                </div>
            </div>

            <div id="tab-2" class="entity-about-article current">
                <div class="entity-content__main">

                    <div class="entity-reviews">
                        <div class="entity-reviews__top-line">
                            <div class="entity-reviews__filter filter-line tabz">
                                <a href="#" data-tab="taz1"
                                   class="filter-line__item btn btn_theme_radio filter-btn btn_theme_radio_active">
                                    Все отзывы
                                </a>
                                <a href="#" data-tab="taz2" class="filter-line__item btn btn_theme_radio filter-btn">
                                    <span>Положительные</span>
                                    <span class="filter-btn__count">{{\App\Comment::where('owner_id', $doctor->id)->where('user_rate','>',5)->where('owner_type', 'Doctor')->where('status', 1)->count()}}</span>
                                </a>

                                <a data-tab="taz3" href="#"
                                   class="filter-line__item btn btn_theme_radio filter-btn"><span>Отрицательные<span
                                                class="filter-btn__count">
                                            {{\App\Comment::where('owner_id', $doctor->id)->where('user_rate','<=',5)->where('owner_type', 'Doctor')->where('status', 1)->count()}}
                                        </span></span></a>
                            </div>
                            {{--<div class="entity-reviews__about">--}}
                            {{--<div class="entity-reviews__about-text">У нас только реальные отзывы</div>--}}
                            {{--<a href="#" class="entity-reviews__about-link">Как формируется рейтинг?</a>--}}
                            {{--</div>--}}
                        </div>
                        <div id="taz1" class="entity-about-articl current">
                            <div class="entity-reviews__list">
                                @component('components.comms',['comments'=>$doctor->publicComments()->get(),'owner'=>['type'=>'Doctor','id'=>$doctor->id]])
                                    @slot('title') @endslot
                                    @slot('visible',5)
                                    @slot('url',route('doctor.comments',['doctor'=>$doctor->alias]))
                                @endcomponent
                            </div>

                        </div>
                        <div id="taz2" class="entity-about-articl">
                            <div class="entity-reviews__list">
                                @component('components.comms',['comments'=>$doctor->publicComments()->where('user_rate','>',5)->get(),'owner'=>['type'=>'Doctor','id'=>$doctor->id]])
                                    @slot('title') @endslot
                                    @slot('visible',5)
                                    @slot('url',route('doctor.comments',['doctor'=>$doctor->alias]))
                                @endcomponent
                            </div>
                        </div>
                        <div id="taz3" class="entity-about-articl">
                            <div class="entity-reviews__list">
                                @component('components.comms',['comments'=>$doctor->publicComments()->where('user_rate','<=',5)->get(),'owner'=>['type'=>'Doctor','id'=>$doctor->id]])
                                    @slot('title') @endslot
                                    @slot('visible',5)
                                    @slot('url',route('doctor.comments',['doctor'=>$doctor->alias]))
                                @endcomponent
                            </div>
                        </div>
                    </div>

                </div>
                <div class="entity-content__aside">
                    <div class="entity-content__banner">
                        @component('components.comform',['comments'=>$doctor->publicComments()->get(),'owner'=>['type'=>'Doctor','id'=>$doctor->id]])
                            @slot('title') @endslot
                            @slot('visible',5)
                            @slot('url',route('doctor.comments',['doctor'=>$doctor->alias]))
                        @endcomponent
                    </div>
                </div>
            </div>

            <div id="tab-3" class="entity-about-article">
                <div class="entity-content__main">

                </div>
                <div class="entity-content__aside">
                    @component('elements.side-banner',['position' => App\Banner::POSITION_EXT_C['id']])@endcomponent
                </div>
            </div>
        </div>
    </div>
</section>
@include('forms.public.order_doc')