<select

@foreach($attributes ?? [] as $attribute => $value)
    @if($value === null)
        {{$attribute}}
    @else
        {{$attribute}}="{{$value}}"
    @endif
@endforeach
class="form-control {{$class ?? ''}}" id="{{$id ?? $name}}" name="{{$name}}" >
@foreach($options as $key => $option)
    <option value="{{$option->{$valAttr ?? 'id'}  ?? $key}}">{{$option->{$nameAttr ?? 'name'} ?? $option}}</option>
    @endforeach
    </select>
    {{$append ?? ''}}