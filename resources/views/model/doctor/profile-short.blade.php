<div class="profiles__left">
    @component('components.profile-img',['width'=>$width??'250px','height'=>$height??'250px'])
        @slot('src')
            {{$doctor['avatar']}}
        @endslot
    @endcomponent<br>
    @component('components.rating-stars',['rating' => $doctor->avg_rate == 0 ? 5:$doctor->avg_rate])
    @endcomponent
    <p class="profiles__reviews" style="font-size: 17px;font-weight: bold;">{{$doctor->publicComments()->count()}}
        отзывов</p>
</div>
<div class="profiles__right">
    <div class="profiles__header">
        <h3 class="profiles__title">
            {{$doctor->alias}}
            <a href="{{ route('doctor.item',['doctor'=>$doctor->alias, 'city' => $doctor->city->alias]) }}">{{$doctor['name']}}</a>
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
        <a class="button" href="{{ route('doctor.item',['doctor'=>$doctor->alias, 'city' => $doctor->city->alias]) }}">Записаться на прием</a>
    </footer>
</div>