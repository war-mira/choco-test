@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <select id="{{$field}}" name="{{$field}}" class="form-control">
            @foreach($options as $option)
                @if(isset($option['children']) && count($option['children']) > 0)
                    <optgroup label="{{($break ?? '').$option['name']}}">
                        @component('components.multi-dropdown',['options' => $option['children'],'break' => ($break ?? '').'&nbsp;&nbsp;&nbsp;'])
                        @endcomponent
                    </optgroup>
                @else
                    <option value="{{$option['id']}}">{{($break ?? '').$option['name']}}</option>
                @endif
            @endforeach
        </select>
    @endslot
@endcomponent
@push('component_scripts')
    <script>
        $(function () {


        var ${{$field}}Select = $('#{{$field}}');
        ${{$field}}Select.val('{{$value}}').trigger('change');
        })
    </script>@endpush