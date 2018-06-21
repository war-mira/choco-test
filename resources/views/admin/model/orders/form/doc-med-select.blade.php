@component('components.bootstrap.row')
    @component('components.bootstrap.column',['class'=>'col-md-6'])
        <label for="doctor-select-input">Врач</label>
        <select class="form-control" name="doc_id" id="doctor-select-input"></select>
    @endcomponent
    @component('components.bootstrap.column',['class'=>'col-md-6'])
        <label for="medcenter-select-input">Медцентр</label>
        <select class="form-control" name="med_id" id="medcenter-select-input"></select>
    @endcomponent
@endcomponent
@push('component_scripts')
    <script>
        $(function () {
            var doctors = @json($doctors);
            var medcenters = @json($medcenters);

            var medSelect = $('#medcenter-select-input');
            var docSelect = $('#doctor-select-input');

            var filterBindedOptions = function (matchIdCallback) {
                return function (params, data) {
                    var matchId = matchIdCallback();
                    if (matchId && data.bind.indexOf(parseInt(matchId)) < 0)
                        return null;

                    // If there are no search terms, return all of the data
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Do not display the item if there is no 'text' property
                    if (typeof data.text === 'undefined') {
                        return null;
                    }


                    // `params.term` should be the term that is used for searching
                    // `data.text` is the text that is displayed for the data object
                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        var modifiedData = $.extend({}, data, true);
                        modifiedData.text += ' (matched)';

                        // You can return modified objects from here
                        // This includes matching the `children` how you want in nested data sets
                        return modifiedData;
                    }

                    // Return `null` if the term should not be displayed
                    return null;
                };
            };

            var doctorsMatcher = filterBindedOptions(function () {
                return parseInt(medSelect.val());
            });
            var medcentersMatcher = filterBindedOptions(function () {
                return parseInt(docSelect.val());
            });


            docSelect.select2({
                data: doctors,
                matcher: doctorsMatcher,
                allowClear: true,
                placeholder: "Выберите врача"
            }).on('select2:select', function (e) {
                var data = e.params.data;
                if (data.bind.length <= 0)
                    medSelect.val(null).trigger('change');
                else if (data.bind.indexOf(parseInt(medSelect.val())) < 0)
                    medSelect.val(data.bind[0]).trigger('change');

            }).val({{$doctor ?? 'null'}}).trigger('change');
            medSelect.select2({
                data: medcenters,
                matcher: medcentersMatcher,
                allowClear: true,
                placeholder: "Выберите медцентр"
            }).on('select2:select', function (e) {
                var data = e.params.data;
                if (data.bind.length <= 0)
                    docSelect.val(null).trigger('change');
                else if (data.bind.indexOf(parseInt(docSelect.val())) < 0)
                    docSelect.val(data.bind[0]).trigger('change');
            }).val({{$medcenter ?? 'null'}}).trigger('change');
        });
    </script>
@endpush