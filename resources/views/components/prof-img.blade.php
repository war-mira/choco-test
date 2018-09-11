<div class="parent_cont" style="background-image: url({{file_exists($src) ? URL::asset($src) :URL::asset('images/no-userpic.gif')}})">
</div>
@if((isset($top5)))
    <div class="entity-thumb-img__label entity-thumb-img__label_top">ТОП-5</div>
@endif
@if(isset($comercial))
    <div class="entity-thumb-img__label entity-thumb-img__label_ad">Реклама</div>
@endif