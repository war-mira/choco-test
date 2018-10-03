@foreach($options as $option)
    @if(isset($option['children']) && count($option['children']) > 0)
        <optgroup label="{{$break.$option['name']}}">
            @component('components.multi-dropdown',['options' => $option['children'],'break' => $break.'&nbsp;&nbsp;&nbsp;'])
            @endcomponent
        </optgroup>
    @else
        <option value="{{$option['id']}}">{{$break.$option['name']}}</option>
    @endif
@endforeach