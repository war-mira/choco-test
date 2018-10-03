@extends('components.table.bs-table')
@section('table-attributes')
    data-sort-name="id"
    data-sort-order="desc"
@endsection
@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="name" data-sortable="true">Заголовок</th>
    <th data-field="description-lite" data-sortable="true">Контент</th>
    @endsection

@section('scripts')
    @parent('scripts')
    <script>
        function statusFormatter(val, row) {
            return row.status_name;
        }

        function actionFormatter(value, row) {
            return [
                '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Изменить<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>',
                '<a class="remove btn btn-danger" href="javascript:" title="Delete Item">Удалить<span style="font-size: 15px" class="glyphicon glyphicon-remove-circle"></span></a>',
            ].join('');
        }
    </script>
@endsection