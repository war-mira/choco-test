<div class="entity-line__img">
    @component('components.prof-img',['width'=>$width??'250px','height'=>$height??'250px'])
        @slot('src')
            {{$doctor['avatar']}}
        @endslot
    @endcomponent<br>

    <div class="entity-thumb-img__rating-line rating-line">
        <div class="rating-line__val">{{$doctor->avg_rate}}</div>
        @component('components.rstars',['rating' => $doctor->avg_rate == 0 ? 0:$doctor->avg_rate])
        @endcomponent
    </div>

    <div class="entity-thumb-img__bot-line">
        <a href="#" class="entity-thumb-img__reviews">{{$doctor->publicComments()->count()}} отзывов</a>
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
<div class="entity-line__main">
    <div class="entity-line__name"><a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">{{$doctor['name']}}</a></div>
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
    <div class="doc-line__address">
        <div class="doc-line__address-heading">Прием по адресу:</div>
        <div class="doc-line__address-list">
            @if($doctor->medname)
                @foreach($doctor->medname as $ff)
                    <div class="doc-line__address-item">
                        <div class="doc-line__address-val">{{$ff->map}}</div>
                        <div class="doc-line__address-clinic-link">
                            <a href="#">{{$ff->name}}</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="entity-line__additional">
    <form action="#" class="appointment-book-big">
        <div class="appointment-book-big__heading">Записаться на прием</div>
        <div class="appointment-book-big__date-line">
            <div class="appointment-book-big__date-item date-radio">
                <label class="date-radio__item">
                    <input type="radio" name="date" value="today">
                    <span class="date-radio__text">Сегодня</span>
                </label>
            </div>
            <div class="appointment-book-big__date-item date-radio">
                <label class="date-radio__item">
                    <input type="radio" name="date" value="tomorrow">
                    <span class="date-radio__text">Завтра</span>
                </label>
            </div>
            <div class="appointment-book-big__date-item date-radio js-custom-date">
                <div class="date-radio__item">
                    <input type="radio" name="date" value="custom">
                    <input type="hidden" name="dayweek" />
                    <span class="date-radio__text">Выбрать дату</span>
                    <input type="text" name="custom-date" class="js-custom-date-val">
                    <div class="pickmeup pmu-view-days pmu-hidden"><div class="pmu-instance"><nav><div class="pmu-prev pmu-button" style="visibility: visible;">◀</div><div class="pmu-month pmu-button">Июль, 2018</div><div class="pmu-next pmu-button" style="visibility: visible;">▶</div></nav><nav class="pmu-day-of-week"><div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div></nav><div class="pmu-years"><div class="pmu-button">2012</div><div class="pmu-button">2013</div><div class="pmu-button">2014</div><div class="pmu-button">2015</div><div class="pmu-button">2016</div><div class="pmu-button">2017</div><div class="pmu-selected pmu-button">2018</div><div class="pmu-button">2019</div><div class="pmu-button">2020</div><div class="pmu-button">2021</div><div class="pmu-button">2022</div><div class="pmu-button">2023</div></div><div class="pmu-months"><div class="pmu-button">Янв</div><div class="pmu-button">Фев</div><div class="pmu-button">Мар</div><div class="pmu-button">Апр</div><div class="pmu-button">Май</div><div class="pmu-button">Июн</div><div class="pmu-selected pmu-button">Июл</div><div class="pmu-button">Авг</div><div class="pmu-button">Сен</div><div class="pmu-button">Окт</div><div class="pmu-button">Ноя</div><div class="pmu-button">Дек</div></div><div class="pmu-days"><div class="pmu-not-in-month pmu-button">25</div><div class="pmu-not-in-month pmu-button">26</div><div class="pmu-not-in-month pmu-button">27</div><div class="pmu-not-in-month pmu-button">28</div><div class="pmu-not-in-month pmu-button">29</div><div class="pmu-not-in-month pmu-saturday pmu-button">30</div><div class="pmu-sunday pmu-button">1</div><div class="pmu-button">2</div><div class="pmu-button">3</div><div class="pmu-button">4</div><div class="pmu-button">5</div><div class="pmu-button">6</div><div class="pmu-saturday pmu-button">7</div><div class="pmu-sunday pmu-button">8</div><div class="pmu-button">9</div><div class="pmu-selected pmu-today pmu-button">10</div><div class="pmu-button">11</div><div class="pmu-button">12</div><div class="pmu-button">13</div><div class="pmu-saturday pmu-button">14</div><div class="pmu-sunday pmu-button">15</div><div class="pmu-button">16</div><div class="pmu-button">17</div><div class="pmu-button">18</div><div class="pmu-button">19</div><div class="pmu-button">20</div><div class="pmu-saturday pmu-button">21</div><div class="pmu-sunday pmu-button">22</div><div class="pmu-button">23</div><div class="pmu-button">24</div><div class="pmu-button">25</div><div class="pmu-button">26</div><div class="pmu-button">27</div><div class="pmu-saturday pmu-button">28</div><div class="pmu-sunday pmu-button">29</div><div class="pmu-button">30</div><div class="pmu-button">31</div><div class="pmu-not-in-month pmu-button">1</div><div class="pmu-not-in-month pmu-button">2</div><div class="pmu-not-in-month pmu-button">3</div><div class="pmu-not-in-month pmu-saturday pmu-button">4</div><div class="pmu-not-in-month pmu-sunday pmu-button">5</div></div></div></div></div>
            </div>
        </div>
        <div class="appointment-book-big__time-list">
            @php
            $today = date('n'); $st = 1;
            $week = array(1=>'mond',2=>'tues',3=>'wedn',4=>'thur',5=>'frid',6=>'satu',7=>'sund');
            if($doctor[$week[$today]])
            {
                $nic = unserialize($doctor[$week[$today]]);
                $starttime = $nic[0];  // your start time
                $endtime = $nic[1];  // End time
                $duration = '30';  // split by 30 mins
                $start_time    = strtotime ($starttime); //change to strtotime
                $end_time      = strtotime ($endtime); //change to strtotime
                $add_mins  = $duration * 60;
            }

            @endphp

            @if(isset($nic) && $nic)
            @while($start_time <= $end_time)
                @if($st == 9)<div class="appointment-book-big__time-item_additional"> @endif
                <div class="appointment-book-big__time-item time-radio">
                    <label class="time-radio__item">
                        <input type="radio" name="time" value="@php echo date('H:i',$start_time); @endphp"/>
                        <span class="time-radio__text btn btn_theme_radio noselect">@php echo date('H:i',$start_time); @endphp</span>
                    </label>
                </div>
                @if($start_time == $end_time)</div> @endif
                @php $start_time += $add_mins; $st++; @endphp
            @endwhile
            @endif

        </div>
        <div class="appointment-book-big__custom-time custom-time-btn">
            <button class="custom-time-btn__btn">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <span class="custom-time-btn__text">Другое время</span>
            </button>
        </div>
        <div class="appointment-book-big__bot-line">
            <div class="appointment-book-big__price">
                <div class="appointment-book-big__price-text">Прием от:</div>
                <div class="appointment-book-big__price-val">от {{$doctor['price']}} тг</div>
            </div>
            <a href="#order_doctor" data-doc-id="{{$doctor->id}}" data-dname="{{$doctor['name']}}" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span class="hidden-xl"> онлайн</span></a>
        </div>
    </form>
</div>
<!--div class="profiles__right">
    <div class="profiles__header">
        <h3 class="profiles__title">
            <a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">{{$doctor['name']}}</a>
        </h3>
        <p class="profiles__short">
            @if(isset($highlightSkill))
                <a class="skill_href_text"
                   href="{{route('doctors.list',['skill'=>$highlightSkill->alias])}}"
                   style="font-weight: 800">{{ $highlightSkill->name }}</a>
            @endif
            @foreach ($doctor['skills'] as $skillitem)
                @if(!isset($highlightSkill) || ($skillitem->id != $highlightSkill->id))
                    <a class="skill_href_text"
                       href="{{route('doctors.list',['skill'=>$skillitem->alias])}}">{{ $skillitem->name }}</a>
                @endif
            @endforeach
        </p>
    </div>
    <ul class="profiles__desc-list">
        <li><span>Рейтинг:</span> {{round($doctor->avg_rate,1)}}</li>
        <li><span>Стаж:</span> {{$doctor['exp_formatted']}}</li>
        <li><span>Адрес:</span> <a class="link-dotted"
                                   href="{{route('doctors.list')}}">{{$doctor['city']->name}}</a>, {{$doctor['address']}}
        </li>
        <li><span>Выезд на дом:</span>
            @if($doctor['ambulatory']==1)
                Возможен
            @else
                Невозможен
            @endif
        </li>
        <li><span>Принял пациентов: <strong>{{$doctor->orders()->whereIn('status',[1,2])->count()}}</strong></span>
        </li>
    </ul>
    <p class="profiles__price">Стоимость приема: <strong>{{$doctor['price']}} тг.</strong></p>
    <footer class="profiles__footer">
        <a class="button" href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">Записаться на прием</a>
    </footer>
</div-->