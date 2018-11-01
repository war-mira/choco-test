<div class="entity-line__img">
    <div class="mob--switch_rating">
        <div class="rating-line__stars">
            <i aria-hidden="true" class="fa fa-star"></i>
            {{$doctor->avg_rate}}
        </div>
        <a href="{{ route('doctor.item',['doctor'=>$doctor->alias]).'#tab-2' }}" class="entity-thumb-img__reviews">
            {{$doctor->publicComments()->count()}}
        </a>
    </div>
    <a href="{{ route('doctor.item',['doctor'=>$doctor->alias,'city'=>$doctor->city->alias]) }}">
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
        @component('components.rstars',['rating' => $doctor->avg_rate == 0 ? 0:$doctor->avg_rate])
        @endcomponent
        <div class="rating-line__val">{{$doctor->avg_rate}}</div>
    </div>

    <div class="entity-thumb-img__bot-line">
        <a href="{{ route('doctor.item',['doctor'=>$doctor->alias,'city'=>$doctor->city->alias]).'#tab-2' }}"
           class="entity-thumb-img__reviews">{{$doctor->publicComments()->count()}} отзывов</a>
        <inp-rate obj="doctor" id="{{ $doctor->id }}" type="likes">
            <template slot="likes">{{ $doctor->likes }}</template>
            <template slot="dislikes">{{ $doctor->dislikes }}</template>
        </inp-rate>
    </div>
    <div class="entity-thumb-img__scale">
        <div class="percent-color {{$doctor->fillingPercentage['class']}}">
            <div class="filling-scale">
                <div class="progress-bar" style="width: {{ $doctor->fillingPercentage['percent'] }}%"></div>
            </div>
            <div class="progress-text">Заполнено на: <span>{{ $doctor->fillingPercentage['percent'] }}%</span></div>
        </div>
    </div>
</div>
<div class="entity-line__main">
    <h3 class="entity-line__name profiles__title"><a
                href="{{ route('doctor.item',['doctor'=>$doctor->alias,'city'=>$doctor->city->alias]) }}">{{$doctor['name']}}</a>
    </h3>
    <div class="entity-line__descr">
        @foreach ($doctor['skills'] as $i=>$skill)
            <a href="{{$skill->href}}" style="text-decoration: none">
                {{$skill->name }}
            </a>
            @if(count($doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1)) / @endif  @endforeach
    </div>

    <div class="entity-line__features">
        @if($doctor['qualification'])
            <div class="entity-line__qualification">{{$doctor['qualification']}}</div>
        @endif
        <div class="entity-line__feature entity-feature">
            <div class="entity-feature__info">
                <div class="entity-line__label">Стаж {{$doctor->exp_formatted}}</div>
            </div>
            @if(!empty($doctor->price))
                <div class="doctor-mobile-price">
                    Прием от: <span>{{$doctor->price}} тг</span>
                </div>
            @endif
        </div>
    </div>

</div>
<div class="entity-line__additional appointment-book-big">
    <div class="doc-line__address">
        @if(count($doctor->jobs))
            <div class="doc-line__address-heading">Прием по адресу:</div>
            <div class="doc-line__address-list">
                @foreach($doctor->jobs as $job)
                    <div class="doc-line__address-item">
                        <div class="doc-line__address-val"><a
                                    href="{{ route('doctor.item', ['doctor' => $doctor->alias]) }}">{{$doctor['city']->name}}</a>, {{$job->medcenter ? $job->medcenter->sms_address: ''}}
                        </div>
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
    <div class="entity-line__additional appointment-book-big">
        @if($doctor->checkForShowPhone())
            <phone-show-btn model="{{ \App\Doctor::SHOW_PHONE_COUNT }}" id="{{ $doctor->id }}"
                            phone="{{ \App\Helpers\HtmlHelper::phoneCode($doctor->showing_phone) }}">
                <template slot="phone-number"></template>
            </phone-show-btn>
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
                </div>
            </form>
        @endif
        @if(isset($withLabel))
            <div class="appointment-book_label">
                @if(isset($doubleActiveDoctor))
                    <div class="entity-thumb-img__label red entity-thumb-img__label_active double_active">
                        <div class="entity-thumb-img__label_text">
                            <div class="entity-thumb-span_most">Самый</div>
                            активный и отзывчивый
                        </div>
                    </div>
                @elseif(isset($activeCommentsDoctor))
                    <div class="entity-thumb-img__label red entity-thumb-img__label_active">
                        <div class="entity-thumb-img__label_text">
                            <div class="entity-thumb-span_most">Самый</div>
                            активный
                        </div>
                    </div>
                @elseif(isset($responsiveDoctor))
                    <div class="entity-thumb-img__label red entity-thumb-img__label_responsive">
                        <div class="entity-thumb-img__label_text">
                            <div class="entity-thumb-span_most">Самый</div>
                            отзывчивый
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>