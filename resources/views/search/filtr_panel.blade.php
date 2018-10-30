<div class="result-control-bar doctor-bar">
    {{ Breadcrumbs::render('search.index', [
    'city' => $city,
    'title' => empty($meta['h1'])?null:$meta['h1']
    ]) }}

    <div class="container doctor-search">
        <div class="result-control-bar__line" id="filtersGroup">
            <div class="result-control-bar__sort sort-line">
                <select class="sort-select js-simple-select">
                    <option>Сортировать по</option>
                    <option>Рейтингу</option>
                    <option>Стажу</option>
                    <option>Отзывам</option>
                    <option>Стоимости</option>
                    <option>Посещаемости</option>
                </select>
            </div>
        </div>
    </div>
</div>
@push('custom.js')
    <script type="text/javascript">
        $('form.search-bar__line').each(function () {
            var $form = $(this);
            $form.on('change', 'select[data-select="action"]', function () {
                var type = $form.find('option:selected').val();
                var action = '';
                if (type == 'doctor') {
                    action = "{!!route('doctors.list')!!}";
                } else {
                    action = "{!! route('medcenters.list') !!}";
                }
                $form.attr('action', action);
            });
        });
    </script>
@endpush