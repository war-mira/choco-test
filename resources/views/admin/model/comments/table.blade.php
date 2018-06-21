@extends('components.table.bs-table')
@section('table-attributes')
    data-sort-name="id"
    data-sort-order="desc"
@endsection
@section('toolbarExt')
    <div class="toolbar-item">
        <div class="dropdown" id="statusFilterDropdown">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                        class="glyphicon glyphicon-cog"></span>Статус <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-left dropdown-checkbox-menu" id="status_check_dropdown">
                <li><a href="#" class="small" data-type="all" tabIndex="-1"><input type="checkbox"/>&nbsp;Все</a></li>
                <li class="divider"></li>
                <li><a href="#" class="small" data-value="0" tabIndex="-1"><input type="checkbox"/>&nbsp;Модерация</a>
                </li>
                <li><a href="#" class="small" data-value="1" tabIndex="-1"><input type="checkbox"/>&nbsp;Допущенные</a>
                </li>
                <li><a href="#" class="small" data-value="2" tabIndex="-1"><input type="checkbox"/>&nbsp;Закрытые</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="toolbar-item form-group text-center">
        <label for="dateRangeFilter">Дата создания</label>
        <input id="dateRangeFilter" class="form-control text-center">
    </div>
@endsection

@section('columns')
    <th data-field="id" data-sortable="true">Id</th>
    <th data-field="user_name" data-sortable="true">Автор</th>
    <th data-field="author_id" data-sortable="true">Id(рег)</th>
    <th data-field="user_email" data-width="160px" data-sortable="true">Телефон</th>
    <th data-field="owner" data-formatter="ownerFormatter">О ком</th>
    <th data-field="text" data-sortable="true" data-formatter="textFormatter" data-events="textEvents">Текст</th>
    <th data-field="created_at" data-sortable="true">Дата создания</th>
    <th data-field="status" data-sortable="true" data-events="statusEvents" data-formatter="statusFormatter">Статус</th>
    <th data-field="user_rate" data-sortable="true">Оценка(из 10)</th>
@endsection

@section('scripts')
    @parent('scripts')
    <script>
        var statuses =
            {
                @foreach(App\Comment::STATUS as $code => $name)
                '{{$code}}': '{{$name}}',
                @endforeach
            };

        function ownerFormatter(val, row) {
            if (val)
                return "<a href='" + val.href + "'>" + val.name + "</a>";
            else
                return '-';
        }

        function textFormatter(val, row) {

            var textContent = "<p>" + val + "</p>" + "    <div class=\"collapse\" id=\"comment_replies" + row.id + "\" data-toggle=\"collapse\">\n";
            row.replies.forEach(function (r) {
                textContent += "<div class='well' >" +
                    "<textarea class='form-control' id=\"comment_replytext" + r.id + "\" >" + r.text + "</textarea>" +
                    "<button class='btn btn-primary reply-comment-save' " +
                    " data-url='{{route('admin.comment-reply.save')}}'" +
                    " data-id='" + r.id + "' style='margin-top: 10px'>Сохранить</button>" +
                    "<button class='btn btn-danger reply-comment-delete' " +
                    " data-url='{{route('admin.comment-reply.delete')}}'" +
                    "data-id='" + r.id + "' style='margin-top: 10px'>Удалить</button></div>";
            });
            textContent += "<div class='well' ><textarea class='form-control' id=\"comment_replytext" + row.id + "\" ></textarea>" +
                "<button class='btn btn-primary reply-comment-create' " +
                "data-url='{{route('admin.comment-reply.create')}}'" +
                "data-owner='" + row.id + "' style='margin-top: 10px'>Ответить</button></div>";

            textContent += "                </div>\n" +
                "                <p class=\"reviews__more\">\n" +
                "                    <a class=\"button button--light show-hidden-comments-btn\" data-toggle=\"collapse\"\n" +
                "                       href=\"#comment_replies" + row.id + "\">Ответ (" + row.replies.length + ")</a>\n" +
                "\n" +
                "                </p>";
            return textContent;
        }

        function statusFormatter(val, row) {

            return "<div class=\"dropdown\">\n" +
                "  <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">" + statuses[val] +
                "  <span class=\"caret\"></span></button>\n" +
                "  <ul class=\"dropdown-menu status-dropdown\" data-id='" + row.id + "'>\n" +
                "    <li class='" + (row.status == 0 ? 'active' : '') + "'><a href=\"#\" data-value='0'>Модерация</a></li>\n" +
                "    <li class='" + (row.status == 1 ? 'active' : '') + "'><a href=\"#\" data-value='1'>Допущенный</a></li>\n" +
                "    <li class='" + (row.status == 2 ? 'active' : '') + "'><a href=\"#\" data-value='2'>Закрытый</a></li>\n" +
                "  </ul>\n" +
                "</div>";
        }

        var datepicker = $('#dateRangeFilter').daterangepicker(
            {
                locale: {
                    format: 'YYYY-MM-DD',

                },
                startDate: '{{now()->startOfMonth()->format('Y-m-d')}}',
                endDate: '{{now()->endOfMonth()->format('Y-m-d')}}',
                singleDatePicker: false
            });

        $('#statusFilterDropdown').on('hide.bs.dropdown', function () {
            $table.bootstrapTable('refresh');
        });

        window.statusEvents = {
            'click .status-dropdown a': function (e, value, row) {
                var statusVal = $(this).data('value');
                var url = "{{route('admin.comments.status.set')}}";
                $.get(url, {comment: row.id, status: statusVal, _token: '{{csrf_token()}}'}, function () {
                    $table.bootstrapTable('refresh');
                });
            }
        };

        window.textEvents = {
            'click .reply-comment-save': function (e, value, row) {
                var url = $(this).data('url');
                var replyId = $(this).data('id');
                var replyText = $(this).prev('textarea').val();
                $.post(url, {reply_id: replyId, text: replyText, _token: '{{csrf_token()}}'}, function () {
                    $table.bootstrapTable('refresh');
                });
            },
            'click .reply-comment-delete': function (e, value, row) {
                var url = $(this).data('url');
                var replyId = $(this).data('id');
                $.post(url, {reply_id: replyId, _token: '{{csrf_token()}}'}, function () {
                    $table.bootstrapTable('refresh');
                });
            },
            'click .reply-comment-create': function (e, value, row) {
                var url = $(this).data('url');
                var ownerId = $(this).data('owner');
                var replyText = $(this).prev('textarea').val();
                $.post(url, {owner_id: ownerId, text: replyText, _token: '{{csrf_token()}}'}, function () {
                    $table.bootstrapTable('refresh');
                });
            }
        };

        addFilterCallback(function () {
            return [['owner_type', '<>', 'Comment']];
        });
        addFilterCallback(function () {
            statusValues = $('#status_check_dropdown a').filter(function () {
                return $(this).find('input:checked').length > 0 && !$(this).data('group');
            }).map(function () {
                return $(this).data('value');
            }).get();
            return [['status', 'in', statusValues]];
        });
        addFilterCallback(function () {

            var dateRange = [
                datepicker.data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm'),
                datepicker.data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm')
            ];
            return [['comments.created_at', 'between', dateRange]];
        });

    </script>
@endsection