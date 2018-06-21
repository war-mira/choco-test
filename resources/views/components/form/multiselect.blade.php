@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <select id="{{$field}}" name="{{$field}}[]" multiple="multiple">
            @foreach($options as $key => $option)
                <option value="{{isset($idField) ? $option[$idField] : $key}}">
                    {{isset($nameField) ? $option[$nameField] : $option}}
                </option>
            @endforeach
        </select>
    @endslot
@endcomponent
@section('scripts')
    @parent('scripts')
    @push('component_scripts')
        <script>
        var ${{$field}}Select = $('#{{$field}}');
        ${{$field}}Select.multiSelect({
            selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Поиск...'>",
            selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Поиск...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        @foreach($value ?? [] as $key => $option)
        ${{$field}}Select.multiSelect('select', '{{isset($idField) && isset($option[$idField]) ? $option[$idField] : $option}}');
        @endforeach

        </script>@endpush
@endsection
