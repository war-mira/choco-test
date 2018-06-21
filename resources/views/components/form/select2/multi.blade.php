@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <select class="form-control select2" style="width:100%" id="{{$field}}" name="{{$field}}" multiple>
            @foreach($options as $key => $option)
                <option value="{{isset($idField) ? $option[$idField] : $key}}">{{isset($nameField) ? $option[$nameField] : $option}}</option>
            @endforeach
        </select>
    @endslot
@endcomponent
@push('component_scripts')
    <script>
        $(function () {
                @php $_field = str_replace(['[',']'],['',''],$field) @endphp
        var ${{$_field}}Select = $('#{{$field}}');
        ${{$_field}}Select.select2();
            @foreach($value as $item)
        {
            ${{$_field}}Select.select2('select', '{{$item}}').trigger('change');
        }
        @endforeach
        $(".select2").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            if ($(this).find(":selected").length > 1) {
                var $second = $(this).find(":selected").eq(-1);
                $second.after($element);
            } else {
                $element.detach();
                $(this).prepend($element);
            }

            $(this).trigger("change");
        });
        });

    </script>@endpush