@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        @if(isset($datepicker) && $datepicker)
            <input class="form-control" type="text" id="{{$field}}" name="{{$field}}" pattern="\d{2}-\d{2}-\d{4}"
                   title="дд-мм-гггг (например 01-10-1996)"
                   value="{{$value}}" @if(isset($readonly) && $readonly) readonly @endif>
            @push('component_scripts')
                <script>
                $("#{{\App\Helpers\FormatHelper::jqSelectorName($field)}}").datepicker({dateFormat: 'dd-mm-yy'});
                </script>@endpush
        @else
            <input class="form-control" name="{{$field}}" type="date" id="{{$field}}" max="2100-01-01" min="1890-01-01"
                   value="{{$value}}" @if(isset($readonly) && $readonly) readonly @endif>
        @endif

    @endslot
@endcomponent
