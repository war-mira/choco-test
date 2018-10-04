<div class="search-result-item">
    <div class="row">
        <div class="col-4 col-sm-3 padding-y">
            <div class="search-result-item__image">
                @if ($doctor['top5'] ?? false)
                    <div class="search-result-item__ticker">
                        Топ-5
                    </div>
                @endif

                <div class="search-result-item__photo">
                    {{--<div class="search-result-item__favorite-btn">
                        <i class="fa-icon fa-none"></i>
                    </div>--}}
                    <a href="{{$doctor['href']}}"><img src="{{asset($doctor['avatar'])}}"
                                                       alt=""></a>
                </div>

                @if ($doctor['top5'] ?? false)
                    <div class="search-result-item__ticker-bottom">
                    </div>
                @endif
            </div>
            <!-- /Image -->

            <div class="search-result-item__ranking">
                <div class="ranking__rating-view">
                    <div class="rating-view__rating-digit">{{round($doctor['avg_rate'],1)}}</div>
                    <div class="rating-view__rating-stars ">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class=" view-rating-star{{$doctor['avg_rate'] >= ($i-1) ? $doctor['avg_rate'] >= ($i-0.5) ? '' : ' star--half': ' star--empty'}}"></i>
                        @endfor
                    </div>
                </div>

                <div class="ranking__feedbacks"><a class="ranking__feedbacks__link"
                                                   href="{{$doctor['href']}}#comments">{{$doctor['comments_count']}}
                        отзывов</a></div>
                <div class="ranking__marks">
                    <div class="ranking-marks positive-mark">{{$doctor['positive_comments_count']}}</div>
                    <div class="ranking-marks negative-mark">{{$doctor['negative_comments_count']}}</div>
                </div>
            </div>
            <!-- /Rating -->
        </div>
        <!-- /Col sm 3 -->
        <div class="col-8 col-sm-5 padding-y">
            <div class="search-result-item__name"><a href="{{$doctor['href']}}">{{$doctor['name']}}</a></div>
            <div class="search-result-item__speciality">{{$doctor['skills_list']}}</div>
            <div class="search-result-ticker">{{$doctor['qualification']}}</div>
            <div class="search-result-description">
                <div class="search-result-description__params">
                    <div class="row">
                        <div class="col-4 col-sm-4">
                            <div class="param__item">
                                <div class="param__icon"><img src="{{asset("img/icons/exp.png")}}"
                                                              alt=""></div>
                                <div class="param__text">
                                    <div class="param__text__title">Стаж работы</div>
                                    <div class="param__text__data">{{$doctor['exp']}}</div>
                                </div>
                            </div>
                        </div>
                        <!-- /Param 1 -->
                        <div class="col-4 col-sm-4">
                            <div class="param__item">
                                <div class="param__icon"><img src="{{asset("img/icons/away.png")}}"
                                                              alt=""></div>
                                <div class="param__text">
                                    <div class="param__text__title">Выезд на дом</div>
                                    <div class="param__text__data">{{$doctor['ambulatory']}}</div>
                                </div>
                            </div>
                        </div>
                        <!-- /Param 2 -->
                        <div class="col-4 col-sm-4">
                            <div class="param__item">
                                <div class="param__icon"><img src="{{asset("img/icons/babydoc.png")}}"
                                                              alt=""></div>
                                <div class="param__text">
                                    <div class="param__text__title">Детский врач</div>
                                    <div class="param__text__data">{{$doctor['child']}}</div>
                                </div>
                            </div>
                        </div>
                        <!-- /Param 3 -->
                    </div>

                    <div class="row pt20 responsive_hide">
                        @foreach ($doctor['medcenters'] as $medcenter)
                            <div class="col-sm-6">
                                <div class="param__item">

                                    <div class="param__text">
                                        <div class="param__text__title">
                                            @if ($loop->first)
                                                Прием по адресу:
                                            @else
                                                <br />
                                            @endif
                                        </div>

                                        <div class="param__text__data">{{$medcenter['map']}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /Search result description -->
                </div>
            </div>
        </div>
        <!-- /Search result info-->

        <div class="col-sm-4">
            <div class="search-results-widget"
                 style="height: auto;">
                <div class="results-widget-title">Запись на прием</div>

                <div class="results-widget-content">
                    <div class="widget-datepick"
                         data-doctor="{{ $doctor['alias'] }}">
                        <ul class="widget-datepick__day-select day-select">
                            <li class="day-option">
                                <input type="radio"
                                       id="date-radio-today"
                                       name="day"
                                       value="{{ now()->startOfDay()->format('d.m.Y') }}">

                                <label for="date-radio-today">Сегодня</label>
                            </li>

                            <li class="day-option">
                                <input type="radio"
                                       id="date-radio-tomorrow"
                                       name="day"
                                       value="{{ now()->addDay()->startOfDay()->format('d.m.Y') }}">

                                <label for="date-radio-tomorrow">Завтра</label>
                            </li>

                            <li class="day-option"
                                style="width: 105px;">
                                <div class="input-group date">
                                    <input type="text"
                                           name="day"
                                           class="input-datepicker"
                                           value="Другой день">

                                    <label class="input-group-addon">
                                        <i class=""><img src="{{ asset('img/icons/calendar.svg') }}"
                                                         alt=""></i>
                                    </label>
                                </div>
                            </li>
                        </ul>

                        <div class="swiper-container">
                            <ul class="widget-datepick__time-select time-list"></ul>
                        </div>

                        <div class="widget-datepick-order-section text-center">
                            <div class="inner"
                                 style="display: none;">
                                <div class="param__item responsive_inline ">
                                    <div class="param__text">
                                        <div class="param__text__title">Стоимость приема:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="price-container"></span>
                                            тг.
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item responsive_inline pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">Мед. центр:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="med-container"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item responsive_inline pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">Прием по адресу:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="address-container"></span>
                                        </div>
                                    </div>
                                </div>

                                <a href="javascript:void(0)"
                                   data-role="open-order-modal"
                                   class="widget-order-section__order-btn">
                                    Записаться
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('refactoring/order/order.js') . '?' . rand() }}"></script>
@endpush