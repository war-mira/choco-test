@extends('components.table.bs-table')

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="firstname" data-sortable="true">Имя</th>
    <th data-field="lastname" data-sortable="true">Фамилия</th>
    <th data-field="city" data-sortable="true" data-formatter="cityFormatter">Город</th>
    <th data-field="medcenters" data-formatter="medcentersFormatter">Медцентр</th>
    <th data-field="status"
        data-sortable="true"
        data-formatter="statusFormatter">Статус
    </th>
    <th data-field="created_at" data-sortable="true">Создан</th>
    <th data-field="updated_at" data-sortable="true">Изменен</th>
@endsection


@section('scripts')
    @parent('scripts')
    <script>


        var statuses =
            {
                @foreach(App\Doctor::STATUS as $code => $name)
                '{{$code}}': '{{$name}}',
                @endforeach
            };


        function medcentersFormatter(medcenters) {
            return medcenters.map(function (medcenter) {
                return medcenter.name;
            }).join(",<br> ");
        }

        function userFormatter(user) {
            var userName = 'Не указан';
            if (user !== null && user !== undefined)
                userName = user.name + ' (id = ' + user.id + ')';
            return userName;
        }

        function statusFormatter(val) {
            return statuses[val];
        }

        function actionFormatter(value, row) {
            return [
                '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Изменить<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>',
                '<a class="remove btn btn-danger" href="javascript:" title="Delete Item">Удалить<span style="font-size: 15px" class="glyphicon glyphicon-remove-circle"></span></a>',
            ].join('');
        }

        function cityFormatter(city) {
            var cityName = 'Не указан';
            if (city !== null && city !== undefined)
                cityName = city.name;
            return cityName;
        }

        function imageFormatter(image) {
            return '<img ' + ((image === undefined || image === null) ? '' : ('src="/' + image.path + '"')) + ' alt="аватар" width="200px">';
        }
    </script>
@endsection