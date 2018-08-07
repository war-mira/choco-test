<div class="parent_cont">
    <img class="entity-thumb-img__img profiles__img profiles__img--circle"
     src="{{ file_exists($src) ? URL::asset($src) :URL::asset('images/no-userpic.gif') }}"
     style="max-width:{{$width ?? '120px'}}; max-height:{{$height ?? '120px'}}" alt="" />
</div>
@if((isset($top5)))
    <div class="entity-thumb-img__label entity-thumb-img__label_top">ТОП-5</div>
@endif
@if(isset($comercial))
    <div class="entity-thumb-img__label entity-thumb-img__label_ad">Реклама</div>
@endif