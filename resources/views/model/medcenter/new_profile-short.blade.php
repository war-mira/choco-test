<div class="entity-line__img">
    <div class="entity-thumb-img">
        <div class="entity-thumb-img__img-wr">
            @component('components.medcenters-img',['width'=>$width??'200px','height'=>$height??'200px','class_min'=>$medcenter->checkImageheight()??'0', 'alt'=>$medcenter->name])
                @slot('src')
                    {{$medcenter->avatar}}
                @endslot
            @endcomponent
                {{--<a href="#" class="entity-thumb-img__add-favorite"></a>--}}
        </div>
        <div class="entity-thumb-img__rating-line rating-line">
            <div class="rating-line__val">{{$medcenter['rate']}}</div>
            @component('components.rstars',['rating' => $medcenter['rate'] == 0 ? 0:$medcenter['rate']])
            @endcomponent
        </div>
        {{--<div class="entity-thumb-img__bot-line">--}}
            {{--<a href="#" class="entity-thumb-img__reviews">{{$medcenter->allComments()->count()}} отзывов</a>--}}

            {{--<inp-rate obj="medcenter" id="{{ $medcenter->id }}" type="likes" >--}}
                {{--<template slot="likes">{{ ($medcenter->likes ? $medcenter->likes : 0) }}</template>--}}
                {{--<template slot="dislikes">{{ ($medcenter->dislikes ? $medcenter->dislikes : 0) }}</template>--}}
            {{--</inp-rate>--}}
        {{--</div>--}}
    </div>
</div>
<div class="entity-line__main">
    <div class="h3 profiles__title">
        <div class="entity-line__name"><a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]) }}">{{$medcenter->name}}</a></div>
    </div>
    {{--<div class="entity-line__descr">--}}
        {{--Многопрофильное медицинское учреждение--}}
    {{--</div>--}}
    <div class="entity-line__about-text">
        <p>
            {!! $medcenter['content_lite'] !!}
        </p>
    </div>
    @if(isset($medcenterType))
    <div class="clinic-line__brief">
        <b>{{$medcenterType->name??''}}</b>
    </div>
    @endif
    <div class="clinic-line__brief">
        <div class="clinic-line__brief-line">
            <div class="clinic-line__brief-item">
                <div class="clinic-line__brief-name">
                    Врачей в клинике:
                </div>
                <div class="clinic-line__brief-descr">
                    <a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]).'#tab-2'  }}">{{$medcenter->publicDoctors()->count()}} врача</a>
                </div>
            </div>
            <div class="clinic-line__brief-item">
                <div class="clinic-line__brief-name">
                    Адрес:
                </div>
                <div class="profiles__desc clinic-line__brief-descr">
                    <a class="link-dotted"
                       href="{{route('medcenters.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias])}}">{{$medcenter['city']->name}}</a>, {{$medcenter['map']}}
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
    <div class="appointment-book-big__heading work-hours__heading">Часы работы</div>
    <div class="appointment-book-big__date-line">

        <div class="work-hours__list">
            <div class="work-hours__item">
                <span>Пн - Пт</span><br/>
                <span>{{ implode('-',$medcenter->work_days(0,4))}}</span>
            </div>
            <div class="work-hours__item">
                <span>Сб</span><br/>
                <span>{{ implode('-',$medcenter->work_days(4,5))}}</span>
            </div>
            <div class="work-hours__item">
                <span>Вс</span><br/>
                <span>{{ implode('-',$medcenter->work_days(5,6))}}</span>
            </div>
        </div>
        <div class="work-hours__book">
            {{--<a href="#order_med" data-doc-id="{{$medcenter->id}}" data-dname="{{$medcenter['name']}}" data-status="6" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span class="hidden-xl"> онлайн</span></a>--}}
            <a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]) }}" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link">Подробнее</a>
        </div>
    </div>
</div>
@include('jsond.place',[
'logo'=>url()->to($medcenter['avatar']),
'name' => $medcenter->name,
'city' => $medcenter->city->name,
'address' => $medcenter->sms_address,
'phone' =>  $medcenter->showing_phone,
'geo'=>$medcenter->geo,
'url'=>route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias])

])