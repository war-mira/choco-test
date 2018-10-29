@extends('components.table.bs-table')

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="name" data-sortable="true">Навзвание</th>
    <th data-field="active"
        data-sortable="true"
        data-formatter="statusFormatter">Статус
    </th>

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



        function actionFormatter(value, row) {
            return [
                '<a class="update btn btn-default" href="{{$form}}/' + row['id'] + '" target="_blank" title="Update Item">Изменить<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>',
                '<a class="remove btn btn-danger" href="javascript:" title="Delete Item">Удалить<span style="font-size: 15px" class="glyphicon glyphicon-remove-circle"></span></a>',
            ].join('');
        }

        function medcenterFormatter(medcenter) {
            var medcenterName = 'Не указан';
            if (medcenter !== null && medcenter !== undefined)
                medcenterName = medcenter.name;
            return medcenterName;
        }

        function userFormatter(user) {
            var userName = 'Не указан';
            if (user !== null && user !== undefined)
                userName = user.name + ' (id = ' + user.id + ')';
            return userName;
        }


        function cityFormatter(city) {
            var cityName = 'Не указан';
            if (city !== null && city !== undefined)
                cityName = city.name;
            return cityName;
        }

        function statusFormatter(is_active) {

            if(is_active){
                return 'Опубликован'
            }
            return 'Не опубликован';
        }

        function imageFormatter(image) {
            return '<img ' + ((image === undefined || image === null) ? '' : ('src="/' + image.path + '"')) + ' alt="аватар" width="200px">';
        }
    </script>
@endsection