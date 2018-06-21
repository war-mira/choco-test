@extends('admin.app')
@section('content')
<link href="{{URL::asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Отчет для врачей</h1>
    </div>
</div>
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
        <label for="exampleInputEmail2">Доктор</label>
        <select class="form-control" id="doctor" name="doctor">

            @foreach($Doctors as $D)
                <option
                        @if($D->id==$Doctor->id)
                        selected="selected"
                        @endif
                        value="{{$D->id}}">
                    {{$D->lastname}} {{$D->firstname}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2"> <br>
        <button id="create_report" class="btn btn-default">Сформировать</button>
    </div>
    <div class="col-md-2"> <br>
        <button id="send_report" class="btn btn-default">Отправить</button>
    </div>
</div>
<table cellspacing="0" class="table table-bordered table-hover">
	<tr>
		<td><b>№</b></td>
		<td  align="center" valign=bottom><b>Дата записи</b></td>
		<td  align="center" valign=bottom><b>ФИО пациента</b></td>
		<td  align="center" valign=bottom><b>Время записи</b></td>
		<td  align="center" valign=bottom><b>Контактные данные пациента</b></td>
		<td  align="center" valign=bottom><b>Примечание</b></td>

	</tr>
  <?php $i=0; ?>
  @forelse($Orders as $Order)
  <?php $i++; ?>
	<tr>
		<td>{{$i}}</td>
        <td>{{ $Order->date_create}}</td>
      <td align="left" valign=bottom>{{$Order['client_info']['name']}}</td>
      <td align="left" valign=bottom>{{$Order->date_event}}</td>
      <td align="left" valign=bottom>{{$Order['client_info']['phone']}}</td>

		<td  align="left" valign=bottom>{{($Order->action)}}</td>

	</tr>
  @empty
  <tr>
    <td>0</td>
    <td>0</td>
    <td  align="left" valign=bottom>0</td>
    <td  align="left" valign=bottom>0</td>
    <td  align="left" valign=bottom>0</td>
    <td  align="left" valign=bottom>0</td>
    <td  align="left" valign=bottom>0</td>
    <td  align="right">0</td>
    <td align="right">0</td>
  </tr>
  @endforelse
  <tr>
    <td></td>
    <td></td>
    <td  align="left" valign=bottom></td>
    <td  align="left" valign=bottom></td>
    <td  align="left" valign=bottom></td>
    <td  align="left" valign=bottom></td>
    <td  align="right"><strong>ИТОГО: </strong></td>
    <td align="right">{{$i*$comission}}</td>
  </tr>
</table>

<script src="{{URL::asset('js/timepicker/jquery-ui-timepicker-addon.js')}}"></script>
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

    $("#create_report").click(function(){
      window.location.href = '{{url('admin/reports/doctor/')}}'+'/'+$("#startdate").val()+'/'+$("#enddate").val()+'/'+$("#doctor option:selected").val();
    })
  });
</script>

@endsection
