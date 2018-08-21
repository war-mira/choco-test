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
                                     @if($loop->iteration%3 == 0 || $loop->last) </div> @endif
                                @endforeach
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
                            <div class="doc-list-bar__line" id="medoc_filter" data-action="{{route('medcenter.doctors',['medcenter'=>$medcenter->alias])}}">
                                <input type="hidden" name="orderm" value="DESC" />
                                <input type="hidden" name="fname" value="rate" />
                                <div class="doc-list-bar__filter">
                                    <select name="spec" placeholder="Специальность врача" class="js-simple-select">
                                        <option value="">Специальность врача</option>
                                        @if($medcenter->skills())
                                            @foreach($medcenter->skills() as $skill)
                                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="doc-list-bar__sort sort-line">
                                    <div class="sort-line__item">
                                        <span class="sort-line__heading">Сортировать по:</span>
                                    </div>
                                    <a href="#" data-name="rate" class="sort-line__item sort-line-btn btn btn_theme_radio btn_theme_radio_active">
                                        <span class="sort-line-btn__text">Рейтингу</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" data-name="works_since" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Стажу</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" data-name="comments_count" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Отзывам</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" data-name="price" class="sort-line__item sort-line-btn btn btn_theme_radio">
                                        <span class="sort-line-btn__text">Стоимости</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" data-name="orders_count" class="sort-line__item sort-line-btn btn btn_theme_radio">
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
                                            ->orderBy('lastname')->get()->slice(0,$visible) as $doctor)
                                                <div class="doc-list__item entity-line doc-line">
                                                    @include('model.doctor.prof_new')
                                                </div>
                                            @endforeach

                            </div>
                            <div class="hidden_more">

                            </div>

                            <div class="doc-list__more">
                                <a href="#" data-url="{{route('medcenter.doctors',['city'=>$medcenter->city->alias,'medcenter'=>$medcenter->alias])}}" class="btn btn_theme_more">Еще
                                    <span id="docsLeftText">{{$ost}}</span> врачей</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tab-3" class="entity-about-article">
                    <div class="entity-content__main">
                        <div class="">
                            <div class="entity-about-article__service-list entity-service-list">
                                @foreach($skils->get() as $tr)
                                    <div class="entity-service-list__item service-item">
                                        <div class="service-item__name">
                                            <div class="service-item__name-text">{{$tr['name']}}</div>
                                            <div class="service-item__name-descr">(органы мошонки, предстательная железа, мочевой пузырь)</div>
                                        </div>
                                        <div class="service-item__price">
                                            <div class="service-item__price-val">5000 тг</div>
                                            <a href="#" class="service-item__price-book btn btn_theme_usual">Записаться онлайн</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="entity-content__aside">
                        <div class="entity-content__banner">
                            <img src="{{asset('img/banner.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div id="tab-4" class="entity-about-article">

                </div>
            </div>
        </div>
    </section>

    @include('medcenters.meds_near')

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    @if(!empty($meta['seoText']))
        <!-- begin section -->
        <div class="section top-clear">

            <!-- begin container -->
            <div class="container">

                <!-- begin middle -->
                <div class="middle">

                    {!! $meta['seoText'] !!}

                </div>
                <!-- end middle -->

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->
    @endif

    <script type="text/javascript">
        $(function () {
            var offset = {{$visible}};
            var limit = 10;
            $('.doc-list__more a').click(function (e) {
                e.preventDefault;
                var source = $(this).data('url');
                $.get(source, {offset: offset}, function (medcenters) {
                    $('.hidden_more').append($(medcenters.view));
                    offset = medcenters.offset;
                    $('#docsLeftText').text(medcenters.left);
                    if (medcenters.left <= 0)
                        $('.doc-list__more .btn_theme_more').prop('disabled', true);
                });

            });

            $('#medoc_filter select').change(function (e) {
                e.preventDefault;
                var data = $('#medoc_filter').find('select, input').serializeArray();
                $.get($('#medoc_filter').data('action'), data, function (docs) {
                    $('.doc-list__list').html(docs.view);
                    $('#docsLeftText').text(docs.left);
                });
            });

            $('#medoc_filter a.sort-line__item').click(function (e) {
                e.preventDefault;
                e.stopPropagation;
                $(this).find('i').removeClass('fa-chevron-down');
                var cat = $(this).is('.btn_theme_radio_active'), asdes = $('input[name="orderm"]').val(), order = 'DESC';
                order = ((cat) ? (asdes == 'DESC' ? 'ASC' : 'DESC') : (asdes == 'DESC' ? 'DESC' : 'ASC'));
                var upd = ((order == 'DESC') ? 'fa-chevron-down' : 'fa-chevron-up');
                $(this).find('i').addClass(upd);
                $('input[name="orderm"]').val(order);
                $(this).parent().find('a').removeClass('btn_theme_radio_active');
                $(this).addClass('btn_theme_radio_active');
                $('#medoc_filter').find('input[name="fname"]').val($(this).data('name'));



                var data = $('#medoc_filter').find('select, input').serializeArray();
                $.get($('#medoc_filter').data('action'), data, function (docs) {
                    $('.doc-list__list').html(docs.view);
                });
                return false;
            });
        });

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
