<div class="parent_cont">
    <img class="entity-thumb-img__img"
     src="{{ file_exists($src) ? URL::asset($src) :URL::asset('images/no-userpic.gif') }}"
     style="max-width:{{$width ?? '120px'}}; max-height:{{$height ?? '120px'}}" alt="">
</div>