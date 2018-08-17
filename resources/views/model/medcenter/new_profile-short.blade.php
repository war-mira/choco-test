<div class="entity-line__img">
    <div class="entity-thumb-img">
        <div class="entity-thumb-img__img-wr">
            @component('components.prof-img',['width'=>$width??'200px','height'=>$height??'200px'])
                @slot('src')
                    {{$medcenter->avatar}}
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
            <a href="#" class="entity-thumb-img__reviews">{{$medcenter->publicComments()->count()}} отзывов</a>

            <inp-rate obj="medcenter" id="{{ $medcenter->id }}" type="likes" >
                <template slot="likes">{{ ($medcenter->likes ? $medcenter->likes : 0) }}</template>
                <template slot="dislikes">{{ ($medcenter->dislikes ? $medcenter->dislikes : 0) }}</template>
            </inp-rate>
        </div>
    </div>
</div>
<div class="entity-line__main">
    <div class="h3 profiles__title">
        <div class="entity-line__name"><a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]) }}">{{$medcenter->name}}</a></div>
    </div>
    <div class="entity-line__descr">
        Многопрофильное медицинское учреждение
    </div>
    <div class="entity-line__about-text">
        <p>
            {{strip_tags($medcenter['content'])}}
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
    <!--ul class="profiles__desc-list">
        <li><span>Выезд на дом:</span>
            @if($medcenter['ambulatory']==1)
                Возможен
            @else
                Невозможен
            @endif
        </li>
        <li><span>Специализаций: <strong>{{$medcenter->skills()->count()}}</strong></span></li>
    </ul-->
    <!--p class="profiles__price">Стоимость приема: <strong>от {{$medcenter['price']}} тг.</strong></p-->
    <!--footer class="profiles__footer">
        <a class="button" href="{{$medcenter->href}}">Подробнее</a>
    </footer-->
</div>

<div class="entity-line__additional">
    <form action="#" class="appointment-book-big">
        <div class="appointment-book-big__heading work-hours__heading">Часы работы</div>
        <div class="appointment-book-big__date-line">

            <div class="work-hours__list">
                <div class="work-hours__item">
                    <span>Пн - Пт</span><br/>
                </div>
                <div class="work-hours__item">
                    <span>Сб</span><br/>
                </div>
                <div class="work-hours__item">
                    <span>Вс</span><br/>
                </div>
            </div>

            <!--div class="appointment-book-big__date-item date-radio">
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
                    <span class="date-radio__text">Часы работы</span>
                    <input type="text" name="custom-date" class="js-custom-date-val">
                    <div class="pickmeup pmu-view-days pmu-hidden"><div class="pmu-instance"><nav><div class="pmu-prev pmu-button" style="visibility: visible;">◀</div><div class="pmu-month pmu-button">Июль, 2018</div><div class="pmu-next pmu-button" style="visibility: visible;">▶</div></nav><nav class="pmu-day-of-week"><div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div></nav><div class="pmu-years"><div class="pmu-button">2012</div><div class="pmu-button">2013</div><div class="pmu-button">2014</div><div class="pmu-button">2015</div><div class="pmu-button">2016</div><div class="pmu-button">2017</div><div class="pmu-selected pmu-button">2018</div><div class="pmu-button">2019</div><div class="pmu-button">2020</div><div class="pmu-button">2021</div><div class="pmu-button">2022</div><div class="pmu-button">2023</div></div><div class="pmu-months"><div class="pmu-button">Янв</div><div class="pmu-button">Фев</div><div class="pmu-button">Мар</div><div class="pmu-button">Апр</div><div class="pmu-button">Май</div><div class="pmu-button">Июн</div><div class="pmu-selected pmu-button">Июл</div><div class="pmu-button">Авг</div><div class="pmu-button">Сен</div><div class="pmu-button">Окт</div><div class="pmu-button">Ноя</div><div class="pmu-button">Дек</div></div><div class="pmu-days"><div class="pmu-not-in-month pmu-button">25</div><div class="pmu-not-in-month pmu-button">26</div><div class="pmu-not-in-month pmu-button">27</div><div class="pmu-not-in-month pmu-button">28</div><div class="pmu-not-in-month pmu-button">29</div><div class="pmu-not-in-month pmu-saturday pmu-button">30</div><div class="pmu-sunday pmu-button">1</div><div class="pmu-button">2</div><div class="pmu-button">3</div><div class="pmu-button">4</div><div class="pmu-button">5</div><div class="pmu-button">6</div><div class="pmu-saturday pmu-button">7</div><div class="pmu-sunday pmu-button">8</div><div class="pmu-button">9</div><div class="pmu-selected pmu-today pmu-button">10</div><div class="pmu-button">11</div><div class="pmu-button">12</div><div class="pmu-button">13</div><div class="pmu-saturday pmu-button">14</div><div class="pmu-sunday pmu-button">15</div><div class="pmu-button">16</div><div class="pmu-button">17</div><div class="pmu-button">18</div><div class="pmu-button">19</div><div class="pmu-button">20</div><div class="pmu-saturday pmu-button">21</div><div class="pmu-sunday pmu-button">22</div><div class="pmu-button">23</div><div class="pmu-button">24</div><div class="pmu-button">25</div><div class="pmu-button">26</div><div class="pmu-button">27</div><div class="pmu-saturday pmu-button">28</div><div class="pmu-sunday pmu-button">29</div><div class="pmu-button">30</div><div class="pmu-button">31</div><div class="pmu-not-in-month pmu-button">1</div><div class="pmu-not-in-month pmu-button">2</div><div class="pmu-not-in-month pmu-button">3</div><div class="pmu-not-in-month pmu-saturday pmu-button">4</div><div class="pmu-not-in-month pmu-sunday pmu-button">5</div></div></div></div></div>
            </div-->
            <div class="work-hours__book">
                <a href="#order_doctor" data-doc-id="{{$medcenter->id}}" data-dname="{{$medcenter['name']}}" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span class="hidden-xl"> онлайн</span></a>
            </div>
        </div>
    </form>
</div>