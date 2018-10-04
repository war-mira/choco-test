@extends('components.table.bs-table')
@section('filters')
    @component('components.table.filter-group')
        @component('components.table.filter.text')
            @slot('name','name')
            @slot('title','Имя')
            @slot('column',['patronymic', 'firstname', 'lastname'])
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('name','status')
            @slot('title','Статус')
            @slot('column','status')
            @slot('options',\App\Enums\DoctorStatus::$DESCRIPTIONS)
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('relation','skills')
            @slot('name','skill')
            @slot('title','Специализация')
            @slot('column','skills.id')
            @slot('options',\App\Helpers\SelectOptions::skills())
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('name','city')
            @slot('title','Город')
            @slot('column','city_id')
            @slot('options',\App\Helpers\SelectOptions::cities())
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('relation','medcenters')
            @slot('name','medcenter')
            @slot('title','Медцентр')
            @slot('column','medcenters.id')
            @slot('options',\App\Helpers\SelectOptions::medcenters())
        @endcomponent
    @endcomponent
@endsection


@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="firstname" data-sortable="true">Имя</th>
    <th data-field="lastname" data-sortable="true">Фамилия</th>
    <th data-field="city_name">Город</th>
    <th data-field="medcenters" data-formatter="medcentersFormatter">Медцентр</th>
    <th data-field="skills" data-formatter="skillsFormatter">Специализация</th>
    <th data-field="status_name">Статус</th>
    <th data-field="updated_at" data-sortable="true">Изменен</th>
    <th data-field="action" data-formatter="actionFormatter">Действия</th>
@endsection


@section('scripts')
    @parent('scripts')
    <script>
        function medcentersFormatter(medcenters) {
            return medcenters.map(function (medcenter) {
                return medcenter.name;
            }).join(",<br> ");
        }
        function skillsFormatter(skills) {
            return skills.map(function (skill) {
                return skill.name;
            }).join(",<br> ");
        }

        function actionFormatter(val, row) {
            var form = @jsroute('admin.doctors.form.view',['id'])(row);
            return '<a href="' + form + '" >Открыть</a>';
        }
    </script>
@endsection