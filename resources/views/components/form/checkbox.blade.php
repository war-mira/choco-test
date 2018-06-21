@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <div class="material-switch pull-right">
            <input type="hidden" name="{{$field}}" value="0" id="{{$field}}_off" @if($value != 1) checked @endif>
            <input id="{{$field}}" name="{{$field}}" type="checkbox" value="1" @if($value == 1) checked @endif />
            <label for="{{$field}}" class="label-primary"></label>
        </div>
    @endslot
@endcomponent
@push('component_scripts')
    <script>
        $(function () {
            $('#{{$field}}').on('change', function () {
                $('#{{$field}}_off').prop('checked', !$(this).prop('checked'));
            })
        });

    </script>@endpush