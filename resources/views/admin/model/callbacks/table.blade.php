@extends('components.table.bs-table')
@section('table-attributes')
    data-sort-name="id"
    data-sort-order="desc"
@endsection
@section('toolbarExt')
    <div class="toolbar-item">
        @component('components.table.filter.dropdown-select')
            @slot('id','status-filter')
            @slot('title')
                <span class="glyphicon glyphicon-cog"></span> Статуc <span class="caret"></span>
            @endslot
            @slot('options',\App\Callback::STATUS)
        @endcomponent
    </div>
@endsection
@section('columns')
    <th data-field="created_at" data-sortable="true">Создан</th>
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="status_name">Статус</th>
    <th data-field="order" data-formatter="orderFormatter">Заказ</th>
    <th data-field="client_name" data-sortable="true">Имя</th>
    <th data-field="client_phone" data-sortable="true">Телефон</th>
    <th data-field="target_type_name">Тип</th>
    <th data-field="target.name">К</th>
@endsection

@section('scripts')
    @parent('scripts')
    <script>
        function actionFormatter(value, row) {
            return '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Открыть<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>';

        }

        function orderFormatter(order) {
            var view = "Нет";
            if (order)
                view = "<a href='{{route('admin.orders.form')}}/" + order.id + "'>" + order.id + "</a>";

            return view;
        }

        $(function () {


            var inputs = $('#status-filter').find('input');
            inputs.change(function () {
                $table.bootstrapTable('refresh');
            });

            addFilterCallback(function () {
                statusValues = $('#status-filter').find('a').filter(function () {
                    return $(this).find('input:checked').length > 0 && !$(this).data('group');
                }).map(function () {
                    return $(this).data('value');
                }).get();
                return [['status', 'in', statusValues]];
            });
        });
    </script>
@endsection