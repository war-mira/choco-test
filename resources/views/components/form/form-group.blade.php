<div class="form-group">
    {{$preview ?? ''}}
    @isset($label)
        <label for="{{$field}}" class="control-label">{{$label}}</label>
    @endisset
    {{$control ?? ''}}
</div>