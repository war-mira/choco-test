@extends('admin.app')
@section('content')
    <link href="{{URL::asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Найти врача, клики</h1>
        </div>
    </div>
    <form>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail2">Начальная дата</label>
                    <input type="text" value="{{ request('date_from') }}" class="form-control" name="date_from" id="startdate" placeholder="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputEmail2">Дата окончания</label>
                    <input type="text" value="{{ request('date_to') }}" class="form-control" name="date_to" id="enddate" placeholder="">
                </div>
            </div>
            <div class="col-md-4">
                <label for="exampleInputEmail2">Город</label>
                <select class="form-control" name="city">
                    @foreach(\App\City::where('status', 1)->get() as $city)
                        <option value="{{ $city->name }}" {{$city->name ==  request('city') ? 'selected':''}}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"> <br>
                <button type="submit" id="create_report" class="btn btn-default">Сформировать</button>
            </div>
        </div>
        <table cellspacing="0" class="table table-bordered table-hover">
            <tr>
                <td  align="center" valign=bottom><b>ID врача</b></td>
                <td  align="center" valign=bottom><b>ФИО врача</b></td>
                <td  align="center" valign=bottom><b>Телефон</b></td>
                <td  align="center" valign=bottom><b>Количество кликов</b></td>
            </tr>
            @if($doctors)
                    @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor['id'] }}</td>
                        <td>{{ $doctor['full_name'] }}</td>
                        <td>{{ isset($doctor['phone']) ? $doctor['phone']:'' }}</td>
                        <td>{{ $doctor['count'] }}</td>
                    </tr>
                    @endforeach
            @endif
        </table>
    </form>

    <script type="text/javascript">
        $(function() {
            $('#startdate').datetimepicker({
                timeFormat: 'HH:mm',
                dateFormat: 'dd.mm.yy',
                stepHour: 1,
                stepMinute: 5
            });

            $('#enddate').datetimepicker({
                timeFormat: 'HH:mm',
                dateFormat: 'dd.mm.yy',
                stepHour: 1,
                stepMinute: 5
            });
        });
    </script>

@endsection
