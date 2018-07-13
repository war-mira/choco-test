<section class="entity-line-container">
    <div class="container">
        <div class="search-result__item entity-line doc-line">
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
                        @endcomponent
                        <a href="#" class="entity-thumb-img__add-favorite"></a>
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
                            &nbsp;&nbsp;<a  class="entity-thumb-img__reviews" href="#comments">{{$doctor->publicComments()->count()}} отзывов</a>
                            <?php }else { ?>
                            &nbsp;&nbsp;<a href="#comments">Нет отзывов</a>
                            <?php } ?>
                        <div class="entity-thumb-img__thumb-control thumb-control">
                            <button class="thumb-control__item">
                                <span class="thumb-control__val">0</span>
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </button>
                            <button class="thumb-control__item">
                                <span class="thumb-control__val">0</span>
                                <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entity-line__main">
                <div class="entity-line__name">{{$doctor['name']}}</div>
                <div class="entity-line__descr">@foreach ($doctor['skills'] as $i=>$skill)<a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                    @if(count($doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1)) / @endif  @endforeach</div>
                @if($doctor['qualification'])<div class="entity-line__label">{{$doctor['qualification']}}</div>@endif
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
                <div class="entity-line__about-text">
                    @foreach(App\Doctor::CONTENTS as $field=>$title)
                        @if(!empty(trim($doctor[$field])) && $doctor[$field] != '0' && strlen($doctor[$field])>10 && $field == 'about_text')
                            <div>{!! str_replace('\r\n', '<br />', $doctor[$field]) !!}</div>
                        @endif
                    @endforeach
                    <div class="entity-line__about-text-more">
                        <a href="#">Подробнее</a>
                    </div>
                </div>
                <form action="#" class="entity-line__appointment-book-small appointment-book-small">
                    <div class="appointment-book-small__line">
                        <div class="appointment-book-small__when">
                            <div class="appointment-book-small__top-line">
                                <div>Записаться на прием:</div>
                                <div class="appointment-book-small__date js-appointment-book-date">
                                    <div class="appointment-book-small__date-text">Сегодня</div>
                                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                    <input type="text" name="date" value="today" class="js-custom-date-val">
                                </div>
                            </div>
                            @if(isset($doctor['timetable']) && $doctor['timetable'] != '')
                                {{ $doctor['timetable'] }}
                            @endif
                            <div class="appointment-book-small__time-list">

                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">09:00</span>
                                    </label>
                                </div>

                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">10:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">11:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">12:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">14:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">15:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">16:00</span>
                                    </label>
                                </div>
                                <div class="appointment-book-small__time-item time-radio">
                                    <label class="time-radio__item">
                                        <input type="radio" name="time" value="09:00">
                                        <span class="time-radio__text btn btn_theme_radio">17:00</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="appointment-book-small__action">
                            <button class="appointment-book-small__book-btn btn btn_theme_usual">Записаться</button>
                            <div class="appointment-book-small__price">
                                <div class="appointment-book-small__price-text">Стоимость приема</div>
                                <div class="appointment-book-small__price-val">от {{$doctor['price']}} тг</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="entity-line__additional">
                <div class="entity-line__map entity-map" id="entity-map">
                    <div class="entity-map__address">
                        <div class="entity-map__address-name">{{$doctor->medc_map->map}}</div>
                        @if($doctor['address'])<div class="entity-map__address-descr">({{$doctor['address']}})</div>@endif
                    </div>
                </div>

                <script type="text/javascript">

                    ymaps.ready(function () {

                        //адрес в виде строки
                        var myGeocoder = ymaps.geocode("{{($doctor->medc_map->map ? $doctor->medc_map->map : $doctor['address'])}}");

                        myGeocoder.then( function (res) {
                                var coords = res.geoObjects.get(0).geometry.getCoordinates();
                                ymaps.ready(function(){
                                    var map = new ymaps.Map("entity-map", {
                                        center: coords,
                                        zoom: 15,
                                        controls: ['zoomControl']
                                    });
                                    var address = new ymaps.GeoObject({
                                        geometry: {
                                            type: "Point",
                                            coordinates: coords
                                        }
                                    });
                                    map.geoObjects.add(address);
                                });
                            }, function (err) {
                                console.log('Ошибка инициализации карты');
                            }
                        );
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
                <span class="entity-about__tab-name">О враче</span>
            </a>

            <a href="#" data-tab="tab-2" class="entity-about__tab-item">
                <span class="entity-about__tab-name">Отзывы</span>
                <span class="entity-about__tab-count">{{$doctor->publicComments()->count()}}</span>
            </a>
            <a href="#" data-tab="tab-3" class="entity-about__tab-item">
                <span class="entity-about__tab-name">Акции и скидки</span>
            </a>
        </div>

        <div class="entity-about__content entity-content">
            <div id="tab-1" class="entity-about-article current">
                <div class="entity-content__main">
                @foreach(App\Doctor::CONTENTS as $field=>$title)
                    @if(!empty(trim($doctor[$field])) && $doctor[$field] != '0' && strlen($doctor[$field])>10)
                        <span class="entity-about-article__heading">{{$title}}</span>
                        <div>{!! str_replace('\r\n', '<br />', $doctor[$field]) !!}</div>
                    @endif
                @endforeach
                </div>
                <div class="entity-content__aside">
                    <div class="entity-content__banner">
                        <img src="{{asset('img/banner.jpg')}}" alt="">
                    </div>
                </div>
            </div>

            <div id="tab-2" class="entity-about-article">
                <div class="entity-content__main">

                    <div class="entity-reviews">
                        <div class="entity-reviews__top-line">
                            <div class="entity-reviews__filter filter-line tabz">
                                <a href="#" data-tab="taz1" class="filter-line__item btn btn_theme_radio filter-btn btn_theme_radio_active">
                                    Все отзывы
                                </a>
                                <a href="#" data-tab="taz2" class="filter-line__item btn btn_theme_radio filter-btn">
                                    <span>Положительные</span>
                                    <span class="filter-btn__count">{{\App\Comment::where('owner_id', $doctor->id)->where('user_rate','>',5)->where('owner_type', 'Doctor')->where('status', 1)->count()}}</span>
                                </a>

                                <a data-tab="taz3" href="#" class="filter-line__item btn btn_theme_radio filter-btn"><span>Отрицательные<span class="filter-btn__count">
                                            {{\App\Comment::where('owner_id', $doctor->id)->where('user_rate','<=',5)->where('owner_type', 'Doctor')->where('status', 1)->count()}}
                                        </span></span></a>
                            </div>
                            <div class="entity-reviews__about">
                                <div class="entity-reviews__about-text">У нас только реальные отзывы</div>
                                <a href="#" class="entity-reviews__about-link">Как формируется рейтинг?</a>
                            </div>
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
                    <div class="entity-content__banner">
                        <img src="{{asset('img/banner.jpg')}}" alt="">
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>