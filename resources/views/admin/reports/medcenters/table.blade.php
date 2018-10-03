@extends('components.table.bs-table')

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="name" data-sortable="true">Имя</th>
    <th data-field="from" data-sortable="true">От</th>
    <th data-field="to" data-sortable="true">До</th>
@endsection


@section('scripts')
    @parent('scripts')
    <script>


        function actionFormatter(value, row) {
            return '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Открыть<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>';
        }
    </script>
@endsection