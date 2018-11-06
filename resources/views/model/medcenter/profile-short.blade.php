<div class="profiles__left">
    @component('components.profile-img',['width'=>$width??'250px','height'=>$height??'250px'])
        @slot('src')
            {{$medcenter->avatar}}
        @endslot
    @endcomponent<br>
    @component('components.rating-stars',['rating' => $medcenter['rate'] == 0 ? 5:$medcenter['rate']])
    @endcomponent
    <p class="profiles__reviews" style="font-size: 17px;font-weight: bold;">{{$medcenter->publicComments()->count()}}
        отзывов</p>
</div>
<div class="profiles__right">
    <div class="profiles__header">
        <h3 class="profiles__title">
            <a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]) }}">{{$medcenter->name}}</a>
        </h3>
        <p class="profiles__short">
         <p class="text-black">Многопрофильное медицинское учреждение</p>
        </p>
    </div>
    <ul class="profiles__desc-list">
        <li><span>Рейтинг:</span> {{round($medcenter['rate'],1)}}</li>
        <li><span>Адрес:</span> <a class="link-dotted"
                                   href="{{route('medcenters.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias])}}">{{$medcenter['city']->name}}</a>, {{$medcenter['map']}}
        </li>
        <li><span>Выезд на дом:</span>
            @if($medcenter['ambulatory']==1)
                Возможен
            @else
                Невозможен
            @endif
        </li>
        <li><span>Врачей: <strong>{{$medcenter->publicDoctors()->count()}}</strong></span></li>
        <li><span>Специализаций: <strong>{{$medcenter->skills()->count()}}</strong></span></li>
    </ul>
    <p class="profiles__price">Стоимость приема: <strong>от {{$medcenter['price']}} тг.</strong></p>
    <footer class="profiles__footer">
        <a class="button" href="{{$medcenter->href}}">Подробнее</a>
    </footer>
</div>