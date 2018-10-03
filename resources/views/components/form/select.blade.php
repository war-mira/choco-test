@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <select class="form-control" style="width:100%" id="{{$id??$field}}"
                name="{{$field.(isset($index) ? '['.$index.']' : '') }}"
                @if(isset($required) && $required) required @endif
                @if(isset($readonly) && $readonly) disabled @endif>
            @foreach($options as $key => $option)
                <option value="{{isset($idField) ? $option[$idField] : $key}}"
                        {{($value == (isset($idField) ? ($option[$idField] ??  null) : $key)) ? 'selected':''}}>
                    {{isset($nameField) ? $option[$nameField] : $option}}
                </option>
            @endforeach
        </select>
    @endslot
@endcomponent