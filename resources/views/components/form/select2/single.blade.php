@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <select class="form-control" style="width:100%" id="{{$id??$field}}"
                name="{{$field.(isset($index) ? '['.$index.']' : '') }}"
                @if(isset($required) && $required) required @endif
                @if(isset($readonly) && $readonly) disabled @endif>
            @foreach($options as $key => $option)
                <option value="{{isset($idField) ? $option[$idField] : $key}}">
                    {{isset($nameField) ? $option[$nameField] : $option}}
                </option>
            @endforeach
        </select>
    @endslot
@endcomponent
@push('component_scripts')
    <script>
        $(function () {

            var $selectInput = $('#{{$id??$field}}').select2({
                @if(isset($allowClear) && $allowClear) allowClear: true, @endif
                minimumResultsForSearch: 12,
                placeholder: "{{$label??$field}}"
            });
            $selectInput.val('{{isset($index)? ($value[$index] ??  null) : $value}}').trigger('change');
        });
    </script>@endpush