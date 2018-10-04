@extends('components.table.bs-table')

@section('filters')
    @component('components.table.filter-group')
        @component('components.table.filter.text')
            @slot('name','name')
            @slot('title','Имя')
            @slot('column','name')
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('name','status')
            @slot('title','Статус')
            @slot('column','status')
            @slot('options',\App\Enums\DoctorStatus::$DESCRIPTIONS)
        @endcomponent
        @component('components.table.filter.dropdown-select')
            @slot('relation','doctors.skills')
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
    @endcomponent
@endsection

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="name" data-sortable="true">Навзвание</th>
    <th data-field="city_name">Город</th>
    <th data-field="status_name">Статус</th>
    <th data-field="actions"
        data-width="160px"
        data-formatter="statusActionFormatter"
        data-events="statusActionEvents">Действия
    </th>
    <th data-field="action" data-formatter="actionFormatter"></th>
@endsection


@section('scripts')
    @parent('scripts')
    <script>
        window.statusActionEvents = {
            'click .status-action': function (e, value, row) {
                var scope = $(this).data('scope');
                var status = $(this).data('status');
                var medId = row.id;
                if (confirm('Вы уверены?')) {
                    $.ajax({
                        url: "{{route('admin.medcenters.setstatus')}}",
                        type: 'get',
                        data: {
                            id: medId,
                            status: status,
                            scope: scope
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        success: function () {
                            $table.bootstrapTable('refresh');
                            showAlert('Status changed!', 'success');
                        },
                        error: function () {
                            showAlert('Status change error!', 'danger');
                        }
                    })
                }
            }
        };

        function statusActionFormatter(value, row) {
            return "<div class='dropdown'>            " +
                "            <a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Изменить статус <i\n" +
                "                                    class=\"glyphicon glyphicon-chevron-down\"></i></a>\n" +
                "                        <ul class=\"dropdown-menu\">\n" +
                "                            <li><a href=\"#\" class='status-action' data-status='0' data-scope='self' data-id='" + row.id + "'>Скрыть медцентр</a></li>\n" +
                "                            <li><a href=\"#\" class='status-action' data-status='0' data-scope='all' data-id='" + row.id + "'>Скрыть медцентр и врачей</a></li>\n" +
                "                            <li><a href=\"#\" class='status-action' data-status='1' data-scope='self' data-id='" + row.id + "'>Опубликовать медцентр</a></li>\n" +
                "                            <li><a href=\"#\" class='status-action' data-status='1' data-scope='all' data-id='" + row.id + "'>Опубликовать медцентр и врачей</a></li>\n" +
                "                        </ul>\n" +
                "                    </div>"
        }



        function actionFormatter(val, row) {
            var form = @jsroute('admin.medcenters.form.view',['id'])(row);
            return '<a href="' + form + '" >Открыть</a>';
        }
    </script>
@endsection