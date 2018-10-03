@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Врач</h1>
@endsection
@section('form')
    <div id="errors-list">

    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $field=>$error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{old('id',$doctor['id'])}}">
        @component('components.bootstrap.nav-tabs')
            @component('components.bootstrap.nav-tab',['id'=>'profile-tab','active'=>true])
                @slot('title')<h5>Профиль</h5>@endslot
                @slot('content')

                    <div class="container-fluid" style="margin-top: 20px">
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-4'])

                                <div class="panel panel-info">
                                    <div class="panel-heading"><h4>Расценки</h4></div>
                                    <div class="panel-body">
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.bootstrap.row')
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','price')
                                                        @slot('value',$doctor['price'] ?? 0)
                                                        @slot('required',true)
                                                        @slot('label','Цена')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','price_repeat')
                                                        @slot('value',$doctor['price_repeat'] ?? 0)
                                                        @slot('required',true)
                                                        @slot('label','Цена повторного приема')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','commission')
                                                        @slot('required',true)
                                                        @slot('value',$doctor['commission'] ?? 0)
                                                        @slot('label','Комиссия')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','discount')
                                                        @slot('required',true)
                                                        @slot('value',$doctor['discount'] ?? 0)
                                                        @slot('label','Скидка')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.checkbox')
                                                        @slot('field','ambulatory')
                                                        @slot('value',$doctor['ambulatory'] ?? null)
                                                        @slot('label','Выезд на дом')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_price')
                                                        @slot('value',old('ambulatory_price',$doctor['ambulatory_price']))
                                                        @slot('label','Цена выезда')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_city_price')
                                                        @slot('value',old('ambulatory_city_price',$doctor['ambulatory_city_price']))
                                                        @slot('label','Цена выезда в городе')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_country_price')
                                                        @slot('value',old('ambulatory_country_price',$doctor['ambulatory_country_price']))
                                                        @slot('label','Цена выезда за городом')
                                                    @endcomponent
                                                @endcomponent
                                            @endcomponent

                                        @endcomponent
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4>Услуги</h4>
                                    </div>
                                    <div class="panel-body list-group" id="itemsList">
                                        @foreach($doctor['items'] ?? [] as $item)
                                            <div class="list-group-item">
                                                <div class="input-group">
                                                    <span class="input-group-addon">id: {{$item->id}}</span>
                                                    <input type="hidden" name="items[{{$loop->iteration}}][id]"
                                                           value="{{$item->id}}">
                                                    <span class="form-control-clear-container">
                                                        <input name="items[{{$loop->iteration}}][name]" type="text"
                                                               class="form-control form-control-clear"
                                                               value="{{$item->name}}" placeholder="Название">
                                                        <input name="items[{{$loop->iteration}}][price]" type="number"
                                                               class="form-control form-control-clear"
                                                               value="{{$item->price}}" placeholder="Цена">
                                                    </span>
                                                    <span class="input-group-btn ">
                                                          <button type="button" class="btn btn-danger btn-h2">
                                                            X
                                                          </button>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="list-group-item">
                                            <button type="button" id="addItemBtn" class="btn btn-success btn-block">+
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <label class="btn btn-block btn-primary">
                                    Импорт excel<input class="form-control-file" name="doctor_excel" form="excel-form"
                                                       style="display: none" type="file" id="import_doctor_excel">
                                </label>
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-8'])
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4>Специализация</h4>
                                    </div>
                                    <div class="panel-body">
                                        @component('components.bootstrap.row')
                                            @component('components.bootstrap.column',['class'=>'col-md-8'])
                                                @component('components.form.text')
                                                    @slot('field','qualification')
                                                    @slot('value', old('qualification',$doctor['qualification']))
                                                    @slot('label','Квалификация')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                                @component('components.form.checkbox')
                                                    @slot('field','child')
                                                    @slot('value',$doctor['child'] ?? null)
                                                    @slot('label','Детский')
                                                @endcomponent
                                                @component('components.form.number')
                                                    @slot('field','child_min_age')
                                                    @slot('value',old('child_min_age',$doctor['child_min_age']))
                                                    @slot('label','С возраста')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.number')
                                                    @slot('field','works_since_year')
                                                    @slot('value',old('works_since_year',$doctor['works_since_year']))
                                                    @slot('label','Стаж с')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.number')
                                                    @slot('field','rate')
                                                    @slot('value',$doctor['rate'] ?? '')
                                                    @slot('readonly',true)
                                                    @slot('label','Рейтинг')
                                                @endcomponent
                                            @endcomponent

                                            @component('components.bootstrap.column',['class'=>'col-md-12'])

                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.multiselect')
                                                    @slot('field','jobs')
                                                    @slot('value',array_pluck($doctor['jobs'] ?? [],'medcenter_id'))
                                                    @slot('placeholder','Медцентры')
                                                    @slot('label','Медцентры')
                                                    @slot('options',\App\Medcenter::orderBy('name')->get())
                                                    @slot('idField','id')
                                                    @slot('nameField','name_with_status')
                                                @endcomponent
                                            @endcomponent
                                        @endcomponent
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4>Описание</h4>
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                            @endcomponent
                        @endcomponent
                    </div>
                @endslot
            @endcomponent

            @component('components.bootstrap.nav-tab',['id'=>'seo-tab'])
                @slot('title')<h5>Seo</h5>@endslot
                @slot('content')
                    <div class="container-fluid" style="margin-top: 20px">
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.text')
                                            @slot('field','meta_h1')
                                            @slot('value',$doctor['meta_h1'] ?? '')
                                            @slot('placeholder','SEO H1')
                                            @slot('label','SEO H1')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.text')
                                            @slot('field','meta_title')
                                            @slot('value',$doctor['meta_title'] ?? '')
                                            @slot('placeholder','SEO заголовок')
                                            @slot('label','SEO заголовок')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                                        @component('components.form.summernote.textarea')
                                            @slot('field','meta_key')
                                            @slot('value',$doctor['meta_key'] ?? '')
                                            @slot('placeholder','SEO ключевые слова')
                                            @slot('label','SEO ключевые слова')
                                        @endcomponent
                                    @endcomponent
                                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                                        @component('components.form.summernote.textarea')
                                            @slot('field','meta_desc')
                                            @slot('value',$doctor['meta_desc'] ?? '')
                                            @slot('placeholder','SEO описание')
                                            @slot('label','SEO описание')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                        @endcomponent
                    </div>

                @endslot
            @endcomponent
            @component('components.bootstrap.nav-tab',['id'=>'jobs-tab'])
                @slot('title')<h5>Расписание</h5>@endslot
                @slot('content')
                    <div class="container-fluid" style="margin-top: 20px">
                        @component('admin.doctors.form.jobs',['doctor'=>$doctor])
                        @endcomponent
                    </div>
                @endslot
            @endcomponent
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
    <form name="excel-form" id="excel-form" method="post" enctype="multipart/form-data"
          action="{{route('admin.doctors.import',['id'=>$doctor['id'] ?? null])}}">
        {{csrf_field()}}
    </form>
    @push('component_scripts')
        <script>
            $('#import_doctor_excel').on('change', function () {
                if (confirm('Отменить импорт нельзя! Вы уверены?')) {
                    $('#excel-form').ajaxSubmit({
                        success: function (doctor) {
                            alert('Врач сохранен!');
                            window.location.assign(@jsroute('admin.doctors.form.view',['id'])(doctor));
                        },
                        error: function (error) {
                            var errors = error.responseJSON.errors;
                            var text = "";
                            $.each(errors, function (field, msgs) {
                                msgs.forEach(function (msg) {
                                    text += msg + "\n";
                                });
                            });
                            alert(text);
                        }
                    });
                }
            });
            var $mainForm = $('#edit-form');
            $mainForm.on('submit', function (e) {
                e.preventDefault(); // prevent native submit
                $(this).ajaxSubmit({
                    success: function (data) {
                        alert('Врач сохранен!');
                    },
                    error: function (error) {
                        var errors = error.responseJSON.errors;
                        var text = "";
                        $.each(errors, function (field, msgs) {
                            msgs.forEach(function (msg) {
                                text += msg + "\n";
                            });
                        });
                        alert(text);
                    }
                });
            });

            var bindCheckboxToDiabled = function (checkbox, controls) {
                checkbox.on('change', function () {
                    controls.prop('disabled', !checkbox.prop('checked'));
                });
                controls.prop('disabled', !checkbox.prop('checked'));
            };
            var $ambulatoryCheckbox = $mainForm.find('#ambulatory');
            var $ambulatoryControls = $mainForm.find('[name="ambulatory_city_price"], [name="ambulatory_country_price"], [name="ambulatory_price"]');

            var $childCheckbox = $mainForm.find('#child');
            var $childControls = $mainForm.find('[name="child_min_age"]');
            bindCheckboxToDiabled($childCheckbox, $childControls);
            bindCheckboxToDiabled($ambulatoryCheckbox, $ambulatoryControls);


            var lastItemIndex = {{count($doctor['items'])}};
            $('#addItemBtn').on('click', function () {
                var $newItem = $(' <div class="list-group-item">\n' +
                    '                                                <div class="input-group">\n' +
                    '                                                    <span class="input-group-addon" >-</span>\n' +
                    '                                                    <input type="hidden" name="items[' + lastItemIndex + '][id]" value="">\n' +
                    '                                                    <input name="items[' + lastItemIndex + '][name]" type="text" class="form-control" value="">\n' +
                    '                                                    <input  name="items[' + lastItemIndex + '][price]" type="text" class="form-control" value="0">\n' +
                    '                                                    <span class="input-group-btn ">\n' +
                    '                                                          <button type="button" class="btn btn-danger btn-h2">\n' +
                    '                                                            X\n' +
                    '                                                          </button>\n' +
                    '                                                    </span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>');
                lastItemIndex++;
                $newItem.find('button').click(function () {
                    $newItem.detach();
                });
                $(this).parent().before($newItem);
            });
            $('#itemsList').find('.list-group-item button.btn-danger').click(function () {
                $(this).parents('.list-group-item').detach();
            });
        </script>
    @endpush
@endsection