
<img class="doctor--image" src="{{$doctor->getAvatar($width??0,$height??0)}}" alt="{{$meta['h1']??$doctor->name}}">

@if((isset($top5)))
    <div class="entity-thumb-img__label entity-thumb-img__label_top">ТОП-5</div>
@endif
@if(isset($comercial))
    <div class="entity-thumb-img__label entity-thumb-img__label_ad">Реклама</div>
@endif
