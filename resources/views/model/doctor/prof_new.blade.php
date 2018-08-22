<div class="entity-line__img">
    @component('components.prof-img',['width'=>$width??'250px','height'=>$height??'250px'])
        @slot('src')
            {{$doctor['avatar']}}
        @endslot
        @slot('on_top')
             {{$doctor->on_top}}
        @endslot
        @if(isset($comercial))
            @slot('comercial')
                {{$comercial}}
            @endslot
        @endif
        @if(isset($top5))
            @slot('top5')
                {{$top5}}
            @endslot
        @endif
    @endcomponent<br>

    <div class="entity-thumb-img__rating-line rating-line">
        <div class="rating-line__val">{{$doctor->avg_rate}}</div>
        @component('components.rstars',['rating' => $doctor->avg_rate == 0 ? 0:$doctor->avg_rate])
        @endcomponent
    </div>

    <div class="entity-thumb-img__bot-line">
        <a href="#" class="entity-thumb-img__reviews">{{$doctor->publicComments()->count()}} отзывов</a>
        <inp-rate obj="doctor" id="{{ $doctor->id }}" type="likes" >
            <template slot="likes">{{ $doctor->likes }}</template>
            <template slot="dislikes">{{ $doctor->dislikes }}</template>
        </inp-rate>
    </div>
</div>
<div class="entity-line__main">
    <h3 class="entity-line__name profiles__title"><a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">{{$doctor['name']}}</a></h3>
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
                @if($doctor->jobs)
                    @foreach($doctor->jobs as $job)
                        <div class="doc-line__address-item">
                            <div class="doc-line__address-val"><a href="{{ route('doctor.item', $doctor->alias) }}">{{$doctor['city']->name}}</a>, {{$job->medcenter ? $job->medcenter->sms_address: ''}}</div>
                            <div class="doc-line__address-clinic-link">
                                <a href="{{$job->medcenter ? route('medcenter.item', $job->medcenter->alias):'#'}}">{{$job->medcenter ? $job->medcenter->name:''}}</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
<div class="entity-line__additional">
    @if($doctor->partner == \App\Doctor::PARTNER)
    <form action="#" class="appointment-book-big">
        <div class="appointment-book-big__heading">Записаться на прием</div>
        <div class="appointment-book-big__timeline">
            {!! $doctor->timetable !!}
        </div>
        <div class="appointment-book-big__bot-line">
            @if(!empty($doctor->price))
                <div class="appointment-book-big__price">
                    <div class="appointment-book-big__price-text">Прием от:</div>
                    <div class="appointment-book-big__price-val">от {{$doctor->price}} тг</div>
                </div>
            @endif
            <a href="#order_doctor" data-doc-id="{{$doctor->id}}" data-dname="{{$doctor['name']}}" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span class="hidden-xl"> онлайн</span></a>
        </div>
    </form>
    @else
        <div class="appointment-book-big__bot-line">
            <div class="appointment-book-big__price">
                <div class="appointment-book-big__price-text">Прием от:</div>
                <div class="appointment-book-big__price-val">от {{$doctor['price']}} тг</div>
            </div>
            <phone-show-btn obj="doctor" id="{{ $doctor->id }}" type="ololo">
                <template slot="phone-number"></template>
            </phone-show-btn>
        </div>
    @endif
</div>