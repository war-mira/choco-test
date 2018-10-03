@extends('admin.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$tableName??'Таблица'}}</h1>
            <h3><a data-toggle="collapse" href="#filters-list" aria-expanded="true">Фильтры</a></h3>
            <ul id="filters-list" class="nav nav-pills collapse in" role="tablist">
                @yield('toolbarExt')
            </ul>
            <hr/>
            <div class="toolbar custom-toolbar">
                <div class="toolbar-item"><a class="create btn btn-primary" href="{{$form}}" target="_blank">Создать</a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <span class="alert"></span>
            <div class="table-responsive">
                <table id="table"
                       data-show-refresh="true"
                       data-show-columns="true"
                       data-sort="true"
                       data-search="true"
                       data-toolbar=".toolbar"
                       data-url="{{$url}}"
                       data-height="800"
                       width="100%"
                       data-side-pagination="server"
                       data-pagination="true"
                       data-query-params="queryParams"

                        @yield('table-attributes')
                >
                    <thead style="display: none">
                    <tr>
                        @yield('columns')
                        <th data-field="actions"
                            class="col-md-1"
                            data-formatter="actionFormatter"
                            data-events="actionEvents">Actions
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var API_URL = '{{$url}}';

        $modal = $('#modal').modal({show: false});
        $alert = $('.alert').hide();
        var $table;
        $(function () {
            $table = $("#table").bootstrapTable();
        });


        window.actionEvents = {
            'click .remove': function (e, value, row) {
                if (confirm('Are you sure to delete this item?')) {
                    $.ajax({
                        url: API_URL + '/' + row.id,
                        type: 'delete',
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