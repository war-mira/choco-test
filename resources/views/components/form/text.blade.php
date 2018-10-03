@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <input class="form-control" name="{{$field}}" type="text"
               @if(isset($required) && $required) required @endif
               @if(isset($readonly) && $readonly) readonly
               @endif id="{{$field}}" value="{{$value ?? null}}">
    @endslot
@endcomponent