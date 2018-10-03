@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <input class="form-control" name="{{$field}}" @if(isset($datetimepicker) && $datetimepicker) type="text"
               @else type="datetime-local" step="60" @endif id="{{$field}}"
               max="{{$max ?? '2100-01-01T00:00'}}" min="{{$min ?? '1890-01-01T00:00'}}"
               value="{{(isset($datetimepicker) && $datetimepicker) ?$value->format('Y-m-d H:i') : $value->format('Y-m-d\TH:i')}}">
    @endslot
@endcomponent
@if(isset($datetimepicker) && $datetimepicker)
    @push('component_scripts')
        <script>
            $(function () {
                $("#{{$field}}").datetimepicker(
                    {
                        timeFormat: 'HH:mm',
                        dateFormat: 'yy-mm-dd',
                        stepHour: 1,
                        stepMinute: 5,
                        onSelect: function (dateText, inst) {
                            $('#{{$field}}').attr('value', dateText);
                        }
                    });
            });

        </script>@endpush
@endif