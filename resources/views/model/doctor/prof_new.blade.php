<div class="entity-line__img">
    <a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">
    @component('components.prof-img',[  'width'=>140,
                                'height'=>200,
                                'doctor'=>$doctor])
        @slot('src')
            {{$doctor['avatar']}}
        @endslot
        @slot('on_top')
             {{$doctor->on_top}}
        @endslot
        @slot('alt')
            {{$doctor->name}}
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
        @endcomponent</a>
    <br>

    <div class="entity-thumb-img__rating-line rating-line">
        <div class="rating-line__val">{{$doctor->avg_rate}}</div>
        @component('components.rstars',['rating' => $doctor->avg_rate == 0 ? 0:$doctor->avg_rate])
        @endcomponent
    </div>

    <div class="entity-thumb-img__bot-line">
        <a href="{{ route('doctor.item',['doctor'=>$doctor->alias]).'#tab-2' }}" class="entity-thumb-img__reviews">{{$doctor->publicComments()->count()}} отзывов</a>
        <inp-rate obj="doctor" id="{{ $doctor->id }}" type="likes" >
            <template slot="likes">{{ $doctor->likes }}</template>
            <template slot="dislikes">{{ $doctor->dislikes }}</template>
        </inp-rate>
    </div>
</div>
<div class="entity-line__main">
    <h3 class="entity-line__name profiles__title"><a href="{{ route('doctor.item',['doctor'=>$doctor->alias]) }}">{{$doctor['name']}}</a></h3>
    <div class="entity-line__descr">@foreach ($doctor['skills'] as $i=>$skill)<a href="{{$skill->href}}"
                                                                                 style="text-decoration: none">{{$skill->name }}</a>
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
    <div class="doc-line__address">
        @if(count($doctor->jobs))
            <div class="doc-line__address-heading">Прием по адресу:</div>
            <div class="doc-line__address-list">
                @foreach($doctor->jobs as $job)
                    <div class="doc-line__address-item">
                        <div class="doc-line__address-val"><a href="{{ route('doctor.item', ['doctor' => $doctor->alias]) }}">{{$doctor['city']->name}}</a>, {{$job->medcenter ? $job->medcenter->sms_address: ''}}</div>
                        <div class="doc-line__address-clinic-link">
                            @if($job->medcenter)
                                @if($job->medcenter->status == 1)
                                    <a href="{{route('medcenter.item', ['almaty', $job->medcenter->alias])}}">{{$job->medcenter->name}}</a>
                                @else
                                    <span>{{$job->medcenter->name}}</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="entity-line__additional appointment-book-big">
    @if($doctor->partner == \App\Doctor::PARTNER || $doctor->whoIsIt() == \App\Doctor::TYPE[2])
        <div class="appointment-book-big__heading">Записаться на прием</div>
    @endif
    <div class="appointment-book-big__timeline">
        {!! $doctor->timetable !!}
    </div>
        {{--@if($doctor->whoIsIt() == \App\Doctor::TYPE[3])--}}
        {{--<div class="appointment-book-big__bot-line">--}}
            {{--<find-doctor-btn model="{{ \App\Doctor::FIND_DOCTOR_COUNT }}" id="{{ $doctor->id }}">--}}
                {{--<template slot="link-to-modal"></template>--}}
            {{--</find-doctor-btn>--}}
            {{--<a href="{{ route('register') }}" class="btn btn_theme_usual">Это я</a>--}}
        {{--</div>--}}
        {{--@else--}}
            {{--@if( $doctor->whoIsIt() != \App\Doctor::TYPE[4] && $doctor->whoIsIt() != \App\Doctor::TYPE[5])--}}
                {{--<phone-show-btn model="{{ \App\Doctor::SHOW_PHONE_COUNT }}" id="{{ $doctor->id }}">--}}
                    {{--<template slot="phone-number"></template>--}}
                {{--</phone-show-btn>--}}
            {{--@endif--}}
        {{--@endif--}}
        @if($doctor->medcenters)
            @foreach($doctor->medcenters as $medcenter)
                @if(in_array($medcenter->id, \App\Doctor::SHOW_PHONES) || $doctor->	show_phone == \App\Doctor::SHOW_PHONE)
                    <phone-show-btn model="{{ \App\Doctor::SHOW_PHONE_COUNT }}" id="{{ $doctor->id }}" phone="{{ \App\Helpers\HtmlHelper::phoneCode($doctor->showing_phone) }}">
                        <template slot="phone-number"></template>
                    </phone-show-btn>
                @endif
            @endforeach
        @endif
    @if($doctor->partner == \App\Doctor::PARTNER)
        <form action="#" class="">
            <div class="appointment-book-big__bot-line">
                @if(!empty($doctor->price))
                    <div class="appointment-book-big__price">
                        <div class="appointment-book-big__price-text">Прием от:</div>
                        <div class="appointment-book-big__price-val">от {{$doctor->price}} тг</div>
                    </div>
                @endif
                <a href="#order_doctor" data-doc-id="{{$doctor->id}}" data-dname="{{$doctor['name']}}"
                   class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">Записаться<span
                            class="hidden-xl"> онлайн</span></a>
            </div>
        </form>
    @elseif($doctor->show_phone != \App\Doctor::SHOW_PHONE)
            <send-review-btn user="{{ Auth::guest() ? 'guest':'user'}}" type="{{ \App\Comment::typeCommon }}" owner_type="Doctor" owner_id="{{$doctor->id}}">
                <template slot="send-review-btn"></template>
            </send-review-btn>
    @endif


</div>