@extends('components.table.bs-table')
@section('table-attributes')
    data-sort-name="name"
    data-sort-order="asc"
    data-page-size="100"
    data-page-list="[50,100]"
@endsection
@section('toolbarExt')
    <div class="toolbar-item form-group text-center">
        <label for="dateRangeFilter">Дата создания</label>
        <input id="dateRangeFilter" class="form-control text-center">
    </div>
@endsection

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>

    <th data-field="name" data-sortable="true">Специализация</th>
    <th data-field="comments_count" data-sortable="true">Всего</th>
    <th data-field="avg_rate" data-sortable="true">Сред. рейтинг</th>
    <th data-field="closed_comments_count" data-sortable="true">Скрыто</th>
    <th data-field="open_comments_count" data-sortable="true">Опубликовано</th>
    <th data-field="0_2_comments_count" data-sortable="true">0-2</th>
    <th data-field="2_4_comments_count" data-sortable="true">2-4</th>
    <th data-field="4_6_comments_count" data-sortable="true">4-6</th>
    <th data-field="6_8_comments_count" data-sortable="true">6-8</th>
    <th data-field="8_10_comments_count" data-sortable="true">8-10</th>
@endsection

@section('scripts')
    <script>
        var datepicker = $('#dateRangeFilter').daterangepicker(
            {
                locale: {
                    format: 'YYYY-MM-DD'

                },
                startDate: '{{now()->startOfMonth()->format('Y-m-d')}}',
                endDate: '{{now()->endOfMonth()->format('Y-m-d')}}',
                singleDatePicker: false
            });


        addFilterCallback(function () {

            var dateRange = [
                datepicker.data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm'),
                datepicker.data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm')
            ];
            return [['comments.created_at', 'between', dateRange]];
        });


    </script>
@endsection