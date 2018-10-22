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