@extends('admin.app')
@section('content')
    <div class="content-box-large">
        <div class="container-fluid">
            <h2>Отчет для медцентров №{{$group->id}} ({{$group->from}} - {{$group->to}})</h2>
            <div class="btn-group pull-right">
                <button class="btn btn-primary" data-action="process">Сформировать</button>
                <button class="btn btn-success" data-action="send">Отправить</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary" data-selector="true" data-status="null">Все</button>
                        <button class="btn btn-success" data-selector="true" data-status="0">Н</button>
                        <button class="btn btn-default" data-selector="true" data-status="1">С</button>
                        <button class="btn btn-warning" data-selector="true" data-status="2">О</button>
                    </div>

                </td>
                <td>Id</td>
                <td>Медцентр</td>
                <td>Начало</td>
                <td>Конец</td>
                <td>Статус</td>
                <td>Сформирован</td>
                <td>Ссылка</td>
                <td>Записей</td>
                <td>Email</td>
                <td>Email2</td>
                <td>Отправлен</td>
            </tr>
            </thead>
            <tbody>
            @foreach($group->reports as $report)
                <tr>
                    <td><label><input type="checkbox" class="checkbox" value="1" data-role="row"
                                      data-status="{{$report->status}}"
                                      data-id="{{$report->id}}"></label></td>
                    <td>{{$report->id}}</td>
                    <td>{{$report->medcenter->name}}</td>
                    <td>{{$report->from}}</td>
                    <td>{{$report->to}}</td>
                    <td>{{$report->status_name}}</td>
                    <td>{{$report->formed_at}}</td>
                    <td><a href="{{$report->download_url}}">Файл</a></td>
                    <td>{{$report->total}}</td>
                    <td>
                        <div class="input-group email-input-group" data-field="email">

                            <input type="text" class="form-control email-input" placeholder="Email"
                                   value="{{$report->email}}">
                            <span class="input-group-btn">
                                <button class="btn btn-default email-btn" type="button" data-id="{{$report->id}}"
                                        disabled>Save</button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group email-input-group" data-field="email2">

                            <input type="text" class="form-control email2-input" placeholder="Email2"
                                   value="{{$report->email2}}">
                            <span class="input-group-btn">
                                <button class="btn btn-default email2-btn" type="button" data-id="{{$report->id}}"
                                        disabled>Save</button>
                            </span>
                        </div>
                    </td>
                    <td>{{$report->sent_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    @parent('scripts')
    <script>
        $('[data-selector="true"]').click(function (e) {
            e.preventDefault();
            var status = $(this).data('status');
            var inputs = $('input[data-role=row]');
            if (status != null)
                inputs = inputs.filter('[data-status=' + status + ']');
            if (inputs.filter('*:not(:checked)').length > 0) {
                inputs.prop('checked', true);
            }
            else {
                inputs.prop('checked', false);
            }
        });

        $('[data-action=process]').click(function () {
            $('input[data-role=row]').prop('disabled', true);
            var selected = $('input[data-role=row]:checked');
            var index = 0;
            processReports(selected, 0, 'process');
        });

        $('[data-action=send]').click(function () {
            $('input[data-role=row]').prop('disabled', true);
            var selected = $('input[data-role=row]:checked');
            var index = 0;
            processReports(selected, 0, 'send');
        });

        function processReports(elements, index, action) {
            if (index < elements.length) {
                var id = elements.eq(index).data('id');
                $.get('/medcenter_reports/report/' + id + '/' + action).done(function () {
                    elements.eq(index).parents('tr').addClass('success');
                    processReports(elements, index + 1, action);
                }).fail(function () {
                    elements.eq(index).parents('tr').addClass('danger');
                    processReports(elements, index + 1, action);
                });
            }
        }


        $('.email-input-group').each(function () {
            var field = $(this).data('field');
            var btn = $(this).find('button');
            var input = $(this).find('input');

            input.on('input', function () {
                btn.prop('disabled', false);
            });
            btn.on('click', function () {
                var id = $(this).data('id');

                var saveUrl = '/medcenter_reports/report/' + id + '/save';
                var postData = {
                    _token: "{{csrf_token()}}"
                };
                postData[field] = input.val();
                $.post(saveUrl, postData).done(function () {
                    btn.prop('disabled', true);
                    btn.addClass('btn-success');
                    setTimeout(function () {
                        btn.removeClass('btn-success');
                    }, 500);
                });
            })
        })
    </script>
@endsection