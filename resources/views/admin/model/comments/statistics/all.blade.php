@extends('admin.app')
@section('content')
    <div class="row">
        <form>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="exampleInputEmail2">Начальная дата</label>
                    <input type="text" class="form-control" name="start" id="startdate" placeholder=""
                           value="{{$start->format('Y-m-d H:i')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail2">Дата окончания</label>
                    <input type="text" class="form-control" name="end" id="enddate" placeholder=""
                           value="{{$end->format('Y-m-d H:i')}}">
                </div>

            </div>
            <div class="col-md-4"><br>
                <button id="create_report" class="btn btn-default" type="submit">Сформировать</button>
            </div>
        </form>
    </div>

    <h2 class="text-center">Отчет по отзывам</h2>
    <p class="text-center">
        Выбранный период: {{$start}} - {{$end}}
    </p>
    <hr>
    <h4 class="text-center">Общая статистика</h4>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>
                Статус
            </th>
            <th>
                Всего
            </th>
            <th>
                Средний рейтинг
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($statistics as $status)
            <tr>
                <td>
                    {{$status['name']}}
                </td>
                <td>
                    {{$status['total']}}
                </td>
                <td>
                    {{$status['avg']}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <script type="text/javascript">
        $(function () {
            $('#startdate').datetimepicker({});

            $('#enddate').datetimepicker({});
        });
    </script>

@endsection