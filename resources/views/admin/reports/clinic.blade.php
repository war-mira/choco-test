@extends('admin.app')
@section('content')

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail2">Начальная дата</label>
                <input type="text" class="form-control" id="startdate" placeholder="">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail2">Дата окончания</label>
                <input type="text" class="form-control" id="enddate" placeholder="">
            </div>
        </div>
        <div class="col-md-4">
            <label for="exampleInputEmail2">Мед центр</label>
            <select class="form-control" id="medcenter" name="medcenter">

                @foreach($Medcenters as $M)
                    <option
                            @if($M->id==$Medcenter->id)
                            selected="selected"
                            @endif
                            value="{{$M->id}}">
                        {{$M->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2"><br>
            <button id="create_report" class="btn btn-default">Сформировать</button>
        </div>
        <div class="col-md-2"><br>
            <button id="send_report" class="btn btn-default">Скачать</button>
        </div>
    </div>
    <table cellspacing="0" class="table table-bordered table-hover">
        <tr>
            <td><b>№</b></td>
            <td align="center" valign=bottom><b>Дата записи</b></td>
            <td align="center" valign=bottom><b>ФИО пациента</b></td>
            <td align="center" valign=bottom><b>Время записи</b></td>
            <td align="center" valign=bottom><b>Контактные данные пациента</b></td>
            <td align="center" valign=bottom><b>ФИО врача</b></td>
            <td align="center" valign=bottom><b>Статус</b></td>
            <td align="center" valign=bottom><b>Сверка</b></td>
            <td align="center" valign=bottom><b>Примечание</b></td>
        </tr>
        <?php $i = 0; ?>
        @forelse($Orders as $Order)
            <?php $i++; ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$Order->created_at}}</td>
                <td align="left" valign=bottom>{{$Order->client_info['name'] ?? 'Нет'}}</td>
                <td align="left" valign=bottom>{{$Order->event_date}}</td>
                <td align="left" valign=bottom>{{$Order->client_info['phone'] ?? 'Нет'}}</td>
                @if(!empty($Order->doctor))
                    <td align="left" valign=bottom>{{$Order->doctor->firstname}}</td>
                @else
                    <td align="left" valign=bottom>не указан</td>
                @endif
                <td align="left" valign=bottom>{{($Order->status_tag)}}</td>
                <td align="right" sdval="1000" sdnum="1049;"></td>
                <td align="left" valign=bottom>{{($Order->action)}}</td>
            </tr>
        @empty
            <tr>
                <td>0</td>
                <td>0</td>
                <td align="left" valign=bottom>0</td>
                <td align="left" valign=bottom>0</td>
                <td align="left" valign=bottom>0</td>
                <td align="left" valign=bottom>0</td>
                <td align="left" valign=bottom>0</td>
                <td align="right">0</td>
                <td align="right">0</td>
                <td align="right">0</td>
            </tr>
        @endforelse
        <tr>
            <td></td>
            <td></td>
            <td align="left" valign=bottom></td>
            <td align="left" valign=bottom></td>
            <td align="left" valign=bottom></td>
            <td align="left" valign=bottom></td>
            <td align="right">0</td>
            <td align="right"><strong>ИТОГО: </strong></td>
            <td align="right">{{$i*$comission}}</td>
        </tr>
    </table>

    <script src="{{URL::asset('js/timepicker/jquery-ui-timepicker-addon.js')}}"></script>
    <script type="text/javascript">
        $(function () {
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

            $("#create_report").click(function () {
                window.location.href = '{{url('admin/reports/clinic/')}}' + '/' + $("#startdate").val() + '/' + $("#enddate").val() + '/' + $("#medcenter option:selected").val();
            });

            $("#send_report").click(function () {
                window.location.href = '{{url('admin/reports/clinic_excel/')}}' + '/' + $("#startdate").val() + '/' + $("#enddate").val() + '/' + $("#medcenter option:selected").val();
            })
        });
    </script>

@endsection
