@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <input class="form-control" id="{{$field}}" name="{{$field}}" type="text"
               value="{{$value->format('Y-m-d H:i')}}"
               data-date-format="yyyy-mm-dd hh:ii">
    @endslot
@endcomponent
@push('component_scripts')
    <script>
        $(function () {
            $('#{{$field}}').datetimepicker();
        });

    </script>@endpush