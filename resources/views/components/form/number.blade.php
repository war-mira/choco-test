@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <input class="form-control"
               name="{{$field}}"
               type="number"
               @if(isset($readonly) && $readonly) readonly @endif
               @if(isset($required) && $required) required @endif
               id="{{$field}}"
               value="{{$value ?? null}}">
    @endslot
@endcomponent