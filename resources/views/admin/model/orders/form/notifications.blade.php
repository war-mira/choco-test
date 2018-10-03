<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$tableName??'Таблица'}}</h1>
        <h3><a data-toggle="collapse" href="#filters-list" aria-expanded="true">Фильтры</a></h3>
        <ul id="filters-list" class="nav nav-pills collapse in" role="tablist">
            @yield('toolbarExt')
        </ul>
        <hr/>
        <div class="toolbar custom-toolbar">
            <div class="toolbar-item"><a class="create btn btn-primary"
                                         data-type="{{\App\Enums\SmsNotification\NotificationType::NEW}}"
                                         href="javascript:">
                    После оформления</a>
            </div>
            <div class="toolbar-item"><a class="create btn btn-primary"
                                         data-type="{{\App\Enums\SmsNotification\NotificationType::PRE}}"
                                         href="javascript:">
                    Напоминание о приеме</a>
            </div>
            <div class="toolbar-item"><a class="create btn btn-primary"
                                         data-type="{{\App\Enums\SmsNotification\NotificationType::POST}}"
                                         href="javascript:">
                    Для отзыва</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <span class="alert"></span>
        <div class="table-responsive">
            <table id="orderNotificatiionsTable"
                   data-show-refresh="true"
                   data-show-columns="true"
                   data-sort="true"
                   data-search="true"
                   data-toolbar=".toolbar"
                   data-url="{{$url}}"
                   data-height="800"
                   data-side-pagination="server"
                   data-pagination="true"
                   data-query-params="queryParams"
                   data-sort-name="id"
                   data-sort-order="desc"
            >
                <thead style="display: none">
                <tr>
                    <th data-field="id" data-sortable="true">Id</th>
                    <th data-field="type_description" data-sortable="false">Тип уведомления</th>
                    <th data-field="client_phone" data-sortable="false">Телефон</th>
                    <th data-field="text" data-sortable="true" data-formatter="truncateEllipsis" data-width="350px">
                        Текст
                    </th>
                    <th data-field="send_at" data-sortable="true">Время отправки
                    </th>
                    <th data-field="confirm_status_description">Подтверждено</th>
                    <th data-field="send_status_description">Статус отправки</th>
                    <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@section('scripts')
    <script>

        $alert = $('.alert').hide();
        var $table;
        $(function () {
            $table = $("#orderNotificatiionsTable").bootstrapTable();
            $('.toolbar .create').click(function () {
                var type = $(this).data('type');
                $.ajax({
                    url: "{{$create}}",
                    type: 'post',
                    data: {type: type},
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    success: function () {
                        $table.bootstrapTable('refresh');
                        showAlert('Delete item successful!', 'success');
                    },
                    error: function () {
                        showAlert('Delete item error!', 'danger');
                    }
                })
            })
        });

        function truncateEllipsis(value, row) {
            return '<div class="truncate-ellipsis">\n' +
                '    <span>\n' +
                value +
                '    </span>\n' +
                '</div>';
        }


        window.dateActionEvents = {
            'click button': function (e, value, row) {
                var id = row.id;
                var val = $(this).parent().parent().find('input').val();
                $.ajax({
                    url: row.save_url,
                    type: 'post',
                    data: {send_at: val},
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    success: function () {
                        $table.bootstrapTable('refresh');
                        showAlert('Delete item successful!', 'success');
                    },
                    error: function () {
                        showAlert('Delete item error!', 'danger');
                    }
                })
            }
        };

        function actionFormatter(value, row) {
            return [
                '<a class="confirm btn btn-default" href="javascript:" data-status="1" title="Update Item">Принять<span style="font-size: 15px" class="glyphicon glyphicon-edit"></span></a>',
                '<a class="confirm btn btn-danger" href="javascript:" data-status="-1" title="Delete Item">Отклонить<span style="font-size: 15px" class="glyphicon glyphicon-remove-circle"></span></a>',
            ].join('');
        }

        window.actionEvents = {
            'click .confirm': function (e, value, row) {
                var status = $(this).data('status');
                if (confirm('Подтвердить уведомление?')) {
                    $.ajax({
                        url: row.save_url,
                        type: 'post',
                        data: {confirm_status: status},
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        success: function () {
                            $table.bootstrapTable('refresh');
                            showAlert('Delete item successful!', 'success');
                        },
                        error: function () {
                            showAlert('Delete item error!', 'danger');
                        }
                    })
                }
            }
        };

        function showAlert(title, type) {
            $alert.attr('class', 'alert alert-' + type || 'success')
                .html('<i class="glyphicon glyphicon-check"></i> ' + title).show();
            setTimeout(function () {
                $alert.hide();
            }, 3000);
        }

        var qParamsCallbacks = [];
        var qParamFiltersCallbacks = [];

        function addParamsCallback(callback) {
            qParamsCallbacks.push(callback);
        }

        function addFilterCallback(callback) {
            qParamFiltersCallbacks.push(callback);
        }

        function queryParams(params) {
            $.extend(params, {_token: "{{csrf_token()}}"});

            qParamsCallbacks.forEach(function (callback) {
                var paramsChunk = callback();
                $.extend(true, params, paramsChunk);
            });
            params.filter = [];

            qParamFiltersCallbacks.forEach(function (callback) {
                var filters = callback();
                params.filter = $.merge(params.filter, filters);
            });

            return params;
        }
    </script>
@endsection