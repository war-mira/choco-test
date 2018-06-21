
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
		<!-- Bootstrap -->
      <link href="{{URL::asset('admin/css/styles.css')}}" rel="stylesheet">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <link rel="stylesheet" href="{{URL::asset('css/jquery-ui.css')}}">
      <style>
          .update {
              color: #333;

          }

          .remove {
              color: red;
          }

          .alert {
              padding: 0 14px;
              margin-bottom: 0;
              display: inline-block;
          }
      </style>
      <link rel="stylesheet" href="{{asset('vendor/bootstrap-table/bootstrap-table.min.css')}}">
      <link rel="stylesheet" href="{{URL::asset('css/multi-select.css')}}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" rel="stylesheet">
      <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.js"></script>
      <script src="{{asset('vendor/bootstrap-table/bootstrap-table.min.js')}}"></script>
      <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
	  <script src="{{URL::asset('js/jquery-ui.js')}}"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
      <script src="{{asset('assets/bootstrap-table/dist/extensions/select2-filter/bootstrap-table-select2-filter.min.js')}}"></script>
      <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
      <script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
      <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}">
      <script src="{{asset('js/bootstrap-formhelpers.min.js')}}"></script>
    <title>iDoctor</title>
  </head>

  <body>


			<form class="" action="{{ URL::asset('/api/345168965432865/order/save') }}" method="POST">


				<div class="col-xs-12 col-sm-12 col-lg-6">
				  <div class="section clearfix">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">
				    <div class="form-group ">
				      <label for="Appointments_client" class="required">ФИО клиента <span class="required">*</span></label>
				      <input placeholder="client" class="form-control " name="client" id="Appointments_client" type="text" maxlength="250" value="">
						</div>
				    <div class="form-group col-lg-6">
				      <label for="Appointments_phone">Телефон</label>
				      <input placeholder="phone" name="phone"  class="form-control " name="pimageshone" id="Appointments_phone" type="text" maxlength="250" value="{{$phone}}"> </div>

				    <div class="form-group col-lg-6">
				      <label for="Appointments_email">email</label>
				      <input placeholder="email" name="email"   class="form-control " name="email" id="Appointments_email" type="text" maxlength="250" value=""> </div>

				    <div class="form-group">
				      <label for="Appointments_problem">Проблема</label>
				      <textarea maxlength="1000" rows="6" cols="50" class="form-control" name="problem" id="Appointments_problem"></textarea>
				    </div>

				    <div class="form-group">
				      <label for="Appointments_action">Действие</label>
				      <textarea maxlength="1000" rows="6" cols="50" class="form-control" name="action" id="Appointments_action"></textarea>
				    </div>

				    <div class="form-group">
				      <label for="s2id_autogen1">Врач</label>
				      <div  style="width:100%;">

				        <select class="citypicker doc_id select2-offscreen" style="width:100%;" name="doc_id" id="doc_id" tabindex="-1">
				          <option value="0">Выберите врача</option>
									@foreach($Doctors as $Doctor)
										<option value="{{$Doctor->id}}">{{$Doctor->lastname}} {{$Doctor->firstname}}</option>
									@endforeach
				        </select>
				      </div>

				      <div class="form-group">
				        <label for="s2id_autogen2">Мед. центр</label>
				        <select class="citypicker med_id select2-offscreen" style="width:100%;" name="med_id" id="med_id" tabindex="-1">
				          <option value="">Выберите медцентр</option>
                            <option value="0">Нет Мед Центра</option>
									@foreach($Medcenters as $Medcenter)
										<option value="{{$Medcenter->id}}">{{$Medcenter->name}}</option>
									@endforeach
				        </select>
				      </div>

				      <div class="form-group col-lg-6">
				        <label for="Appointments_send_notify">Отправлять уведомления</label>
				        <select class="form-control" name="send_notify" id="Appointments_send_notify">
				          <option value="1">Sms + Email</option>
				          <option value="0">Не отправлять</option>
				          <option value="2">Sms</option>
				          <option value="3" selected="selected">Email</option>
				        </select>
				      </div>

				      <div class="form-group col-lg-6">
				        <label for="Appointments_date_event">Дата приема</label>
                          <input placeholder="date_event" class="form-control" id="date_event" name="date_event"
                                 type="datetime-local" step="60"></div>

				      <div class="form-group col-lg-6">
				        <label for="Appointments_status">Статус</label>
						  <select class="form-control" id="status" name="status">
                              @component('components.multi-dropdown',['options'=> \App\Order::STATUS,'break'=>''])
							  @endcomponent
						  </select>
				      </div>

				      <div class="form-group col-lg-6">
				        <label for="Appointments_date_event2">Дата приема 2</label>
                          <input placeholder="date_event2" class="form-control" id="date_event2" name="date_event2"
                                 type="datetime-local" step="60"></div>
				    </div>
						<input type="text" readonly name="operator_id" value="{{$operator_id}}">
				    <div class="form-group buttons clearfix">
				      <input class="btn btn-default" style="float:right;" type="submit" name="yt0" value="Сохранить"> </div>
				  </div>
				</div>
			</form>

			<script type="text/javascript">
                $(function () {





  					$("#doc_id").select2();
  					$("#med_id").select2();


                });

			</script>

	</body>
</html>
