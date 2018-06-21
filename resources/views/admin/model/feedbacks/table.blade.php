@extends('components.table.bs-table')

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="name" data-sortable="true">Имя</th>
    <th data-field="phone" data-sortable="true">Телефон</th>
    <th data-field="user_id" data-sortable="true">Пользователь</th>
    <th data-field="text" data-sortable="true">Текст</th>

@endsection

@section('scripts')
    @parent('scripts')
    <script>
        function actionFormatter(value, row) {
            return [
                '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Изменить<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>',
                '<a class="remove btn btn-danger" href="javascript:" title="Delete Item">Удалить<span style="font-size: 15px" class="glyphicon glyphicon-remove-circle"></span></a>',
            ].join('');
        }
    </script>
@endsection