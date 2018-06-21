@extends('components.table.bs-table')
@section('table-attributes')
    data-sort-name="id"
    data-sort-order="desc"
@endsection
@section('toolbarExt')
    <div class="col-md-12 pull-right">
        <form class="form-inline" action="{{$exportAction}}">
            <div class="form-group">
                <label for="dateTimeColumn">Дата</label>
                <select id="dateTimeColumn" name="dateTimeColumn" class="form-control">
                    <option value="event_date">Приема</option>
                    <option value="created_at">Создания</option>
                </select>
            </div>
            <label for="exportDateBegin">От</label>
            <input class="form-control" type="datetime-local" id="exportDateBegin" name="exportDateBegin"
                   value="{{today()->subDay()->setTime(19,0)->format('Y-m-d\TH:i')}}">
            <label for="exportDateEnd">До</label>
            <input class="form-control" type="datetime-local" id="exportDateEnd" name="exportDateEnd"
                   value="{{today()->setTime(19,0)->format('Y-m-d\TH:i')}}">
            <input class="btn btn-default" type="submit" value="Экспорт">
            @component('components.form.checkbox')
                @slot('field','exportFilterCheckbox')
                @slot('value',false)
                @slot('label','Вкл&nbsp;&nbsp;')
            @endcomponent
        </form>
    </div>
@endsection
@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="from_internet" data-formatter="sourceFormatter" data-sortable="true">Источник</th>
    <th data-field="callback_id" data-formatter="callbackFormatter" data-sortable="true">Из заявки</th>
    <th data-field="created_at" data-sortable="true">Дата создания</th>
    <th data-field="client_info.name">Пациент</th>
    <th data-field="client_info.phone">Телефон</th>
    <th data-field="operator_info.name"> Оператор</th>
    <th data-field="event_date" data-sortable="true"> Дата приема</th>
    <th data-field="doctor" data-sortable="true" data-formatter="medcenterFormatter">Врач</th>
    <th data-field="status" data-sortable="true" data-formatter="statusFormatter">Статус</th>
@endsection


@section('scripts')
    @parent('scripts')
    <script>


        function sourceFormatter(value, row) {
            return value == 1 ? "Сайт" : "Телефон";
        }

        function callbackFormatter(callbackId, row) {
            var view = "Нет";
            if (callbackId)
                view = "<a href='{{route('admin.callbacks.form')}}/" + callbackId + "'>" + callbackId + "</a>";

            return view;
        }

        function actionFormatter(value, row) {
            return '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Изменить<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>';

        }

        function medcenterFormatter(medcenter) {
            var medcenterName = 'Не указан';
            if (medcenter !== null && medcenter !== undefined)
                medcenterName = medcenter.name;
            return medcenterName;
        }

        function statusFormatter(status, row) {
            return row.status_description;
        }

        $(function () {
            addFilterCallback(function () {
                var field = $('#dateTimeColumn').val();
                var operator = 'between';
                var start = $('#exportDateBegin').val();
                var end = $('#exportDateEnd').val();

                var filter = [];
                var filterEnabled = $('#exportFilterCheckbox').prop('checked');
                if (start && end && filterEnabled)
                    filter = [field, operator, [start, end]];
                return [filter];
            });

            $('#exportFilterCheckbox').change(function () {
                $table.bootstrapTable('refresh');
            });
        });


    </script>
@endsection