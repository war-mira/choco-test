<div @isset($id) id="{{$id}}" @endisset  class="panel {{$class ?? 'panel-default'}}">
    <div @isset($headingId) id="{{$headingId}}" @endisset class="panel-heading">
        {{$headingContent}}
    </div>
    <div @isset($bodyId) id="{{$bodyId}}" @endisset class="panel-body">
        {{$bodyContent}}
    </div>
</div>