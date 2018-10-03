@extends('admin.app')
@section('content')
    <div class="row">
        <form method="post">
            {{csrf_field()}}
            <div class="col-md-12">

                <div class="col-sm-4" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='start_date'>
                            <input type='text' class="form-control" name="start" value="{{$start->format('m/Y')}}"/>
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='end_date'>
                            <input type='text' value="{{$end->format('m/Y')}}" name="end" class="form-control"/>
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"><br>
                <button id="create_report" class="btn btn-default" type="submit">Сформировать</button>
            </div>
        </form>

        <script type="text/javascript">
            $(function () {
                var startDateInput = $('#start_date');
                var endDateInput = $('#end_date');
                startDateInput.datetimepicker({
                    viewMode: 'years',
                    format: 'mm/yyyy',
                    minView: 'year',
                    startView: 'year',
                    language: 'ru'
                });
                endDateInput.datetimepicker({
                    viewMode: 'years',
                    format: 'mm/yyyy',
                    minView: 'year',
                    startView: 'year',
                    language: 'ru'
                });

            });
        </script>




@endsection
