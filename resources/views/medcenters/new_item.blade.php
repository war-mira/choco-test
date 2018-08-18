@extends('redesign.layouts.inner-page')

@section('content')
    @include('search.medsearch')

    <section class="entity-line-container">
        <div class="container">
            <div class="search-result__item entity-line doc-line">
                <div class="entity-line__img">
                    <div class="entity-thumb-img">
                        <div class="entity-thumb-img__img-wr">
                                @component('components.prof-img')
                                    @slot('src')
                                        {{$medcenter['avatar']}}
                                    @endslot
                                    @slot('width')
                                        200px
                                    @endslot
                                    @slot('height')
                                        200px
                                    @endslot
                                @endcomponent
                                    <a href="#" class="entity-thumb-img__add-favorite"></a>
                        </div>

                        <div class="entity-thumb-img__rating-line rating-line">
                            <div class="rating-line__val">{{$medcenter['rate']}}</div>
                            @component('components.rstars',['rating' => $medcenter['rate'] == 0 ? 0:$medcenter['rate']])
                            @endcomponent
                        </div>

                        <div class="entity-thumb-img__bot-line">
                            <a href="#" class="entity-thumb-img__reviews">{{$medcenter->allComments()->count()}} отзывов</a>

                            <inp-rate obj="medcenter" id="{{ $medcenter->id }}" type="likes" >
                                <template slot="likes">{{ ($medcenter->likes ? $medcenter->likes : 0) }}</template>
                                <template slot="dislikes">{{ ($medcenter->dislikes ? $medcenter->dislikes : 0) }}</template>
                            </inp-rate>
                        </div>
                    </div>
                </div>

                <div class="entity-line__main">
                    <div class="entity-line__name">
                        {{$meta['h1']}}
                    </div>
                    <div class="entity-line__descr">
                        Многопрофильное медицинское учреждение
                    </div>

                    <div class="entity-line__about-text">
                        <p>
                            {{strip_tags($medcenter->content)}}
                        </p>
                    </div>

                    <div class="clinic-line__brief">
                        <div class="clinic-line__brief-line">
                            <div class="clinic-line__brief-item">
                                <div class="clinic-line__brief-name">
                                    Врачей в клинике:
                                </div>
                                <div class="clinic-line__brief-descr">
                                    <a href="#">{{$medcenter->publicDoctors()->count()}} врача</a>
                                </div>
                            </div>
                            <div class="clinic-line__brief-item">
                                <div class="clinic-line__brief-name">
                                    Адрес:
                                </div>
                                <div class="profiles__desc clinic-line__brief-descr">
                                    <a class="link-dotted"
                                       href="{{route('medcenters.list')}}">{{$medcenter['city']->name}}</a>, {{$medcenter['map']}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-line__appointment-mini appointment-mini">
                        <div class="appointment-mini__heading">
                            Прием от: <span>{{$medcenter['price']}} тг.</span>
                        </div>
                        <div class="appointment-mini__book">
                            <button class="btn btn_theme_usual">Записаться онлайн</button>
                        </div>
                    </div>
                </div>

                <div class="entity-line__additional">

                    <div class="entity-line__map entity-map" id="entity-map">
                        <div class="entity-map__address">
                            <div class="entity-map__address-name">{{$medcenter->city->name}}, {{$medcenter->sms_address}}</div>
                            @if($medcenter['map'])<div class="entity-map__address-descr">({{$medcenter['map']}})</div>@endif
                        </div>
                    </div>
                    @php
                        $center = $medcenter->coordinates;
                    @endphp

                    <script type="text/javascript">
                        ymaps.ready(function () {

                            var myMap = new ymaps.Map("entity-map", {
                                center: [{{ $center }}],
                                zoom: 15
                            });

                            var pl = new ymaps.Placemark([{{ $medcenter->coordinates }}]);
                            myMap.geoObjects.add(pl);

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
                <a href="#" data-tab="tab-1" class="entity-about__tab-item entity-about__tab-item_active">
                    <span class="entity-about__tab-name">О клинике</span>
                </a>

                <a href="#" data-tab="tab-2" class="entity-about__tab-item">
                    <span class="entity-about__tab-name">Врачи клиники</span>
                </a>
                <a href="#" data-tab="tab-3" class="entity-about__tab-item">
                    <span class="entity-about__tab-name">Услуги и цены</span>
                </a>
                <a href="#" data-tab="tab-3" class="entity-about__tab-item">
                    <span class="entity-about__tab-name">Акции и скидки</span>
                </a>
            </div>

            <div class="entity-about__content entity-content">
                <div id="tab-1" class="entity-about-article current">
                    <div class="entity-content__main">
                        <div class="entity-about-article__heading">
                            О клинике
                        </div>
                        {!!str_replace('\r\n',' ',$medcenter->content)!!}
                        <div class="entity-content__profiles entity-profiles">
                            <div class="entity-profiles__heading">Направления работы</div>
                            <div class="entity-profiles__list">
                                @foreach ($medcenter->skills() as $item)
                                     @if($loop->iteration%3 == 1 || $loop->first) <div class="entity-profiles__col"> @endif
                                        <a class="skill_item entity-profiles__item" data-toggle="pill"
                                                                                   id="{{$item->id}}"
                                                                                   href="#skill{{$item->id}}">{{$item->name}}</a>
                                     @if($loop->iteration%3 == 0) </div> @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-content__aside">
                        <div class="entity-content__banner">
                            <img src="{{asset('img/banner.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="entity-about-article">
                    <div class="entity-about__content entity-content">
                        <div class="entity-content__main entity-content__main_single">

                        <div class="doc-list-bar">
                            <div class="doc-list-bar__line">
                                <div class="doc-list-bar__filter">
                                    <select name="spec" placeholder="Специальность врача" class="js-simple-select">
                                        <option value="">Специальность врача</option>
                                        <option value="spec-1">Хирург</option>
                                        <option value="spec-2">Терапевт</option>
                                        <option value="spec-3">Диетолог</option>
                                    </select>
                                </div>
                                <div class="doc-list-bar__sort sort-line">
                                    <div class="sort-line__item">
                                        <span class="sort-line__heading">Сортировать по:</span>
                                    </div>
                                    <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio btn_theme_radio_active">
                                        <span class="sort-line-btn__text">Рейтингу</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Стажу</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Отзывам</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Стоимости</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Посещаемости</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="doc-list">
                            <div class="doc-list__list">

                                            @foreach($medcenter->publicDoctors()->with('medcenters')
                                            ->whereHas(
                                            'medcenters',function($query)use($medcenter)
                                            {
                                            $query->where('medcenters.id',$medcenter->id);
                                            })
                                            ->orderBy('lastname')->get() as $doctor)
                                    <div class="doc-list__item entity-line doc-line">
                                                @include('model.doctor.prof_new')
                                    </div>
                                            @endforeach

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tab-3" class="entity-about-article">

                </div>
                <div id="tab-4" class="entity-about-article">

                </div>
            </div>
        </div>
    </section>

    @include('medcenters.meds_near')

    <!-- begin section -->
    <div class="section top-clear bottom-clear">

        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
            <!--nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a></li>
                    <li class="breadcrumbs__item"><a
                                href="{{route('medcenters.list')}}">Клиники</a>
                    </li>
                    <li class="breadcrumbs__item">{{$medcenter->name}}</li>
                </ul>
            </nav-->
            <!-- end breadcrumbs -->

            <!-- begin middle -->
            <!--div class="middle mtop-20">


                <div class="column column--right mbottom-20">
                    <h1 class="page-title">{{$meta['h1']}}</h1>
                    <h3 class="profiles__short">Многопрофильное медицинское учреждение</h3>
                    <p>
                        @component('components.rating-stars',['rating' => $medcenter['rate']])
                        @endcomponent
                        &nbsp;&nbsp;<a href="#comments">{{$medcenter->allComments()->count()}} отзывов</a>
                    </p>
                    <ul class="profiles__desc-list">
                        <li><span>Врачей: </span>{{$medcenter->publicDoctors()->count()}}</li>
                        <li><span>Специализаций: </span>{{$medcenter->skills()->count()}}</li>
                    </ul>
                    <?php if(!empty($medcenter['price'])){ ?>
                    <p class="profiles__price">Стоимость приема: от <strong>{{$medcenter['price']}} тг</strong></p>
                    <?php } ?>
                    @component('components.ya-share')
                    @endcomponent
                </div>

            </div-->
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->
    <div class="section bg-shadow">

        <!-- begin container -->
        <div class="container">

            <!-- begin middle -->
            <div class="middle">

                <!-- begin sidebar -->
                <aside class="sidebar sidebar--left hidden-xs hidden-sm">
                    <div class="sidebar__section">

                        @component('elements.banners-slider',['position'=>\App\Banner::POSITION_EXT_B['id']])
                        @endcomponent
                    </div>
                </aside>
                <!-- end sidebar -->

                <!-- begin column -->

                <!-- end column -->

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->
    <!--div class="section top-clear bottom-clear hidden-xs hidden-sm">


        <div class="container">

        @component('elements.banners-slider',['position'=>\App\Banner::POSITION_MAIN_B['id']])
        @endcomponent

        </div>


    </div-->
    <!-- end section -->



    <script type="text/javascript">

        ga(function (tracker) {
            var cid = tracker.get('clientId');
            $("#callback_form").find('[name="ga_cid"]').val(cid).trigger('change');
        });

        $("#show_all_comment").click(function () {
            $('#' + this.id).hide();
            $('.reviews__item').show();
            return false;
        });

        var callbackForm = $("form#callback_form");
        $("#save_order").click(function () {
            //Ga target
            ga('send', 'event', {
                eventCategory: 'zapisatsya',
                eventAction: 'click'
            });
            //Ya goal
            yaCounter47714344.reachGoal('registration');

            if (callbackForm[0].checkValidity()) {
                var formData = getFormData(callbackForm);
                $.getJSON("{{route('callback.newDoc')}}", formData)
                    .done(function (json) {
                        $('#mess_ok').show();
                        $("#reg_form").hide()
                    });
                return false;
            }

        });
    </script>
@endsection
