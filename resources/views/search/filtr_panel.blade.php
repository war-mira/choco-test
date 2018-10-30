<div class="result-control-bar">
    {{ Breadcrumbs::render('search.index', [
    'city' => $city,
    'title' => empty($meta['h1'])?null:$meta['h1']
    ]) }}

    <div class="container">
        <div class="result-control-bar__line" id="filtersGroup">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-count">найдено {{$doctors->total()}} врачей</div>

                <input type="radio" style="display:none;" checked="true" name="order" value="asc">
                <input type="radio" style="display:none;" name="order" value="desc">
            </div>
            <div class="result-control-bar__sort sort-line" id="filtersGroup">
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