@extends('admin.form')
@section('form')

    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-8'])
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-2'])
                                @component('components.form.text')
                                    @slot('field','id')
                                    @slot('value',$seed['id'] ?? null)
                                    @slot('readonly',true)
                                    @slot('label','Id')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-3'])
                                @component('components.form.text')
                                    @slot('field','created_at')
                                    @slot('value',$seed['created_at'] ?? null)
                                    @slot('readonly',true)
                                    @slot('label','Создан')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-3'])
                                @component('components.form.text')
                                    @slot('field','updated_at')
                                    @slot('value',$seed['updated_at'] ?? null)
                                    @slot('readonly',true)
                                    @slot('label','Изменен')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.select2.single')
                                    @slot('field','operator_id')
                                    @slot('value',$seed['operator_info']['id'] ?? null)
                                    @slot('options',\App\User::getOperators())
                                    @slot('idField','id')
                                    @slot('nameField','name')
                                    @slot('placeholder','Оператор')
                                    @slot('label','Оператор')
                                        @slot('required',true)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.select2.single')
                                    @slot('field','med_id')
                                    @slot('value',$seed['med_id'] ?? 0)
                                    @slot('search',true)
                                    @slot('placeholder','Медцентр')
                                    @slot('label','Медцентр')
                                    @slot('options',\App\Medcenter::where('id',0)->get()->merge(\App\Medcenter::orderBy('name')->where('status',1)->get()))
                                    @slot('idField','id')
                                    @slot('nameField','name')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.select2.single')
                                    @slot('field','doc_id')
                                    @slot('value',$seed['doc_id'] ?? 0)
                                    @slot('search',true)
                                    @slot('placeholder','Доктор')
                                    @slot('label','Доктор')
                                    @slot('options',\App\Doctor::orderBy('lastname')->where('status',1)->get())
                                    @slot('idField','id')
                                    @slot('nameField','name')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.select2.single')
                                    @slot('field','city_id')
                                    @slot('value',$seed['city_id'] ?? 6)
                                    @slot('search',true)
                                    @slot('placeholder','Из города')
                                    @slot('label','Из города')
                                    @slot('options',\App\City::orderBy('name')->get())
                                    @slot('idField','id')
                                    @slot('nameField','name')
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.datetime')
                                    @slot('field','event_date')
                                    @slot('value',$seed['event_date'] ?? \Carbon\Carbon::parse('today noon')->format("Y-m-d H:i"))
                                    @slot('placeholder','Дата приема')
                                    @slot('label','Дата приема')
                                    @slot('min',isset($seed['id']) ? $seed['created_at']->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'))
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                @component('components.form.datetime')
                                    @slot('field','event2_date')
                                    @slot('value',$seed['event2_date'] ?? \Carbon\Carbon::parse('today noon')->format("Y-m-d H:i"))
                                    @slot('placeholder','Дата приема2')
                                    @slot('label','Дата приема2')
                                @endcomponent
                            @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-4'])
                                    @component('components.bootstrap.row')
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.form.select2.single')
                                                @slot('field','send_notify')
                                                @slot('options', ['1' => 'Sms + Email', '0' => 'Не отправлять', '2' => 'Sms', '3' => 'Email'])
                                                @slot('value',$seed['send_notify'] ?? 0)
                                                @slot('placeholder','Уведомления')
                                                @slot('label','Уведомления')
                                            @endcomponent
                                        @endcomponent
                                    @endcomponent
                                    @component('components.bootstrap.row')
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.form.number')
                                                @slot('field','notify_before_minutes')
                                                @slot('value',$seed['notify_before_minutes'] ?? 180)
                                                @slot('label','Напомнить за(мин)')
                                            @endcomponent
                                    @endcomponent
                                @endcomponent
                                @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.nested-select')
                                    @slot('field','status')
                                    @slot('options', \App\Order::STATUS)
                                    @slot('value',$seed['status'] ?? 0)
                                    @slot('label','Статус')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.select2.single')
                                    @slot('field','from_internet')
                                    @slot('value',$seed['from_internet'] ?? 0)
                                    @slot('readonly',isset($seed['id']))
                                    @slot('search',false)
                                    @slot('placeholder','Источник')
                                    @slot('label','Источник')
                                    @slot('options',[0=>'Телефон',1=>'Интернет'])
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.summernote.textarea')
                                    @slot('field','problem')
                                    @slot('value',$seed['problem'] ?? null)
                                    @slot('placeholder','Проблема')
                                    @slot('label','Проблема')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.summernote.textarea')
                                    @slot('field','action')
                                    @slot('value',$seed['action'] ?? null)
                                    @slot('placeholder','Действие')
                                    @slot('label','Действие')
                                @endcomponent
                            @endcomponent
                        @endcomponent

                        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
                    </form>

                </div>
            </div>
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-4'])
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-9">
                            <label class="control-label" for="searchbox">Пациент:</label>
                            <div id="searchbox" class="dropdown">
                                <input class="dropdown-toggle form-control" data-toggle="dropdown" type="text"
                                       id="client-search"
                                       placeholder="Имя, номер, email"
                                       value="{{$seed['client_info']['phone'] ?? ''}}">
                                <div id="client-results"
                                     class="dropdown-menu dropdown-menu-right scrollable-menu"
                                     style="padding: 0; margin-left: 10px; border-radius: 4px; border: none; overflow-y: scroll; max-height: 500px; width: 150%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary" id="new-client-btn"
                                    data-link="{{route('admin.users.form',['name'=>'admin.order-client'])}}">
                                Создать
                            </button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div id="client-form">
                                @component('forms.admin.order-client')
                                    @slot('seed',$seed['client'] ?? $seed['client_info'] ?? [])
                                    @slot('readonly',isset($seed['client']['id']))
                                    @slot('action',route('admin.users.crud.create',['redirect' => 'admin.users.form','redirect_name'=>'admin.order-client']))
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    @endcomponent
    <script>
        var inputTimeout = null;

        var doctorsMedcenters = {!! json_encode($doctorsMedcenters)!!};
        $('#doc_id').change(function () {
            $('#med_id').val(doctorsMedcenters[$(this).val()]).trigger('change');
        });

        $("#client-search").on('input click', function () {
            var input = $(this).val();
            $(this).focus();
            if (inputTimeout !== null)
                clearTimeout(inputTimeout);
            inputTimeout = setTimeout(function () {
                var url = "{{url("/admin/clients/search")}}?q=" + input;
                $("#client-results").load(url);

            }, 500);
        });
    </script>
@endsection