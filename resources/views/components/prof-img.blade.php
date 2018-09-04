<div class="parent_cont">
    <img class="entity-thumb-img__img profiles__img profiles__img--circle @if(isset($class_min))@if($class_min > 0 && $class_min >= 200) @else less200 @endif @endif"
     src="{{ file_exists($src) ? URL::asset($src) :URL::asset('images/no-userpic.gif') }}"
     style="max-width:{{$width ?? '120px'}}; max-height:{{$height ?? '120px'}}" alt="{{$alt ?? ''}}"/>
</div>
@if((isset($top5)))
    <div class="entity-thumb-img__label entity-thumb-img__label_top">ТОП-5</div>
@endif
@if(isset($comercial))
    <div class="entity-thumb-img__label entity-thumb-img__label_ad">Реклама</div>
@endif