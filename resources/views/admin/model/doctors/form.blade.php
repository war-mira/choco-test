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
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{old('id',$seed['id'])}}">
        @component('components.bootstrap.nav-tabs')
            @component('components.bootstrap.nav-tab',['id'=>'profile-tab','active'=>true])
                @slot('title')<h5>Профиль</h5>@endslot
                @slot('content')
                    <div class="container-fluid" style="margin-top: 20px">
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <h3>{{old('id',$seed['id'])}}</h3>
                                            </div>
                                            <div class="col-xs-6">
                                                @component('components.form.select')
                                                    @slot('field','status')
                                                    @slot('value',$seed['status'] ?? 0)
                                                    @slot('placeholder','Статус')
                                                    @slot('label','Статус')
                                                    @slot('options',\App\Doctor::STATUS)
                                                @endcomponent
                                            </div>
                                            <div class="col-xs-4">
                                                @component('components.form.select')
                                                    @slot('field','on_top')
                                                    @slot('value',$seed['on_top'] ?? 0)
                                                    @slot('placeholder','В топе')
                                                    @slot('label','В топе')
                                                    @slot('options',[0=>'Нет',1=>'Да'])
                                                @endcomponent
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.form.image')
                                                @slot('field','avatar')
                                                @slot('value',$seed['avatar'] ?? '')
                                                @slot('placeholder','')
                                                @slot('label','')
                                            @endcomponent
                                        @endcomponent
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.bootstrap.row')
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.text')
                                                        @slot('field','firstname')
                                                        @slot('value', old('firstname',$seed['firstname']))
                                                        @slot('required',true)
                                                        @slot('label','Имя')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.text')
                                                        @slot('field','lastname')
                                                        @slot('value', old('lastname',$seed['lastname']))
                                                        @slot('required',true)
                                                        @slot('label','Фамилия')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.text')
                                                            @slot('field','patronymic')
                                                            @slot('value', old('patronymic',$seed['patronymic']))
                                                            @slot('label','Отчество')
                                                        @endcomponent
                                                    @endcomponent
                                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                        @component('components.form.text')
                                                            @slot('field','email')
                                                            @slot('value', old('email',$seed['email']))
                                                            @slot('label','Email')
                                                        @endcomponent
                                                    @endcomponent
                                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                        @component('components.form.text')
                                                            @slot('field','phone')
                                                            @slot('value', old('phone',$seed['phone']))
                                                            @slot('label','Phone')
                                                        @endcomponent
                                                    @endcomponent
                                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                        @component('components.form.text')
                                                        @slot('field','alias')
                                                        @slot('value', old('alias',$seed['alias']))
                                                            @slot('readonly',true)
                                                        @slot('label','Ссылка')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.text')
                                                        @slot('field','address')
                                                        @slot('value',$seed['address'] ?? '')
                                                        @slot('label','Адрес')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.select2.single')
                                                        @slot('field','city_id')
                                                        @slot('value',$seed['city_id'] ?? 6)
                                                        @slot('placeholder','Город')
                                                        @slot('label','Город')
                                                        @slot('options',\App\City::orderBy('name')->get())
                                                        @slot('search',true)
                                                        @slot('idField','id')
                                                        @slot('nameField','name')
                                                    @endcomponent
                                                @endcomponent
                                            @endcomponent
                                        @endcomponent
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading"><h4>Расценки</h4></div>
                                    <div class="panel-body">
                                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                                            @component('components.bootstrap.row')
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','price')
                                                        @slot('value',$seed['price'] ?? 0)
                                                        @slot('required',true)
                                                        @slot('label','Цена')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','price_repeat')
                                                        @slot('value',$seed['price_repeat'] ?? 0)
                                                        @slot('required',true)
                                                        @slot('label','Цена повторного приема')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','commission')
                                                        @slot('required',true)
                                                        @slot('value',$seed['commission'] ?? 0)
                                                        @slot('label','Комиссия')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','discount')
                                                        @slot('required',true)
                                                        @slot('value',$seed['discount'] ?? 0)
                                                        @slot('label','Скидка')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.checkbox')
                                                        @slot('field','ambulatory')
                                                        @slot('value',$seed['ambulatory'] ?? null)
                                                        @slot('label','Выезд на дом')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_price')
                                                        @slot('value',old('ambulatory_price',$seed['ambulatory_price']))
                                                        @slot('label','Цена выезда')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_city_price')
                                                        @slot('value',old('ambulatory_city_price',$seed['ambulatory_city_price']))
                                                        @slot('label','Цена выезда в городе')
                                                    @endcomponent
                                                @endcomponent
                                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                    @component('components.form.number')
                                                        @slot('field','ambulatory_country_price')
                                                        @slot('value',old('ambulatory_country_price',$seed['ambulatory_country_price']))
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
                                        @foreach($seed['items'] ?? [] as $item)
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
                                                    @slot('value', old('qualification',$seed['qualification']))
                                                    @slot('label','Квалификация')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-4'])
                                                @component('components.form.checkbox')
                                                    @slot('field','child')
                                                    @slot('value',$seed['child'] ?? null)
                                                    @slot('label','Детский')
                                                @endcomponent
                                                @component('components.form.number')
                                                    @slot('field','child_min_age')
                                                    @slot('value',old('child_min_age',$seed['child_min_age']))
                                                    @slot('label','С возраста')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.number')
                                                    @slot('field','works_since_year')
                                                    @slot('value',old('works_since_year',$seed['works_since_year']))
                                                    @slot('label','Стаж с')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.number')
                                                    @slot('field','rate')
                                                    @slot('value',$seed['rate'] ?? '')
                                                        @slot('readonly',true)
                                                    @slot('label','Рейтинг')
                                                @endcomponent
                                            @endcomponent

                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                    <table id="doctor-skills-table" class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 100px">Вес</th>
                                                            <th>Специализация</th>
                                                            <th style="width: 90px; text-align: center;">Действия</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(($seed['skills'] ?? []) as $skill)
                                                            @component('admin.model.doctors.form.skill-row',['id'=>$loop->iteration,'skill'=>$skill])
                                                            @endcomponent
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="3" class="bg-success">
                                                                <a href="#" class="add-row">Добавить</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    @push('component_scripts')
                                                    <script>
                                                        var $skillsTable = $('#doctor-skills-table');
                                                        var sortTable = function () {
                                                            var sorted = $skillsTable.find('tr[data-id]').sort(function (a, b) {
                                                                var an = parseInt($(a).find('input[type="number"]').val()),
                                                                    bn = parseInt($(b).find('input[type="number"]').val());

                                                                if (an < bn) {
                                                                    return 1;
                                                                }
                                                                if (an > bn) {
                                                                    return -1;
                                                                }
                                                                return 0;
                                                            });
                                                            sorted.each(function (index, element) {
                                                                var weightInputName = 'skills[' + index + '][weight]';
                                                                var skillIdInputName = 'skills[' + index + '][id]';
                                                                $(element).find('input[type="number"]').attr('name', weightInputName);
                                                                $(element).find('select').attr('name', skillIdInputName);
                                                            });

                                                            sorted.detach().prependTo($skillsTable.find('tbody'));
                                                        };
                                                        var buildSkillRow = function () {

                                                            var dataIds = $skillsTable.find('tr[data-id]').map(function () {
                                                                return $(this).data("id");
                                                            }).get();
                                                            var lastSkillRow = dataIds.length > 0 ? Math.max.apply(Math, dataIds) : 0;
                                                            var nextId = lastSkillRow + 1;
                                                            $.get('{{route('admin.doctors.forms.skill-row')}}', {id: nextId}, function (rowHtml) {
                                                                var row = $(rowHtml);
                                                                row.find('.delete-row').click(function (e) {
                                                                    e.preventDefault();
                                                                    var id = $(this).data('id');
                                                                    row.detach();
                                                                });
                                                                row.find('input[type="number"]').on('change', sortTable);
                                                                $skillsTable.prepend(row);
                                                            });
                                                        };
                                                        $skillsTable.find('input[type="number"]').on('change', sortTable);

                                                        $skillsTable.find('.add-row').click(function (e) {
                                                            e.preventDefault();
                                                            buildSkillRow($skillsTable);
                                                        });

                                                        $skillsTable.find('.delete-row').click(function (e) {
                                                            e.preventDefault();
                                                            var id = $(this).data('id');
                                                            $skillsTable.find('tr[data-id="' + id + '"]').detach();
                                                        })
                                                    </script>
                                                    @endpush
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.multiselect')
                                                    @slot('field','jobs')
                                                    @slot('value',array_pluck($seed['jobs'] ?? [],'medcenter_id'))
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
                                        @component('components.bootstrap.row')
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','preview_text')
                                                    @slot('value',$seed['preview_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Краткое описание')
                                                    @slot('label','Краткое описание')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                                @component('components.form.summernote.time-table')
                                                    @slot('field','timetable')
                                                    @slot('value',$seed ?? '')
                                                    @slot('required',false)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','График работы')
                                                    @slot('label','График работы')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','about_text')
                                                    @slot('value',$seed['about_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Описание')
                                                    @slot('label','Описание')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','treatment_text')
                                                    @slot('value',$seed['treatment_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Лечение')
                                                    @slot('label','Лечение')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','exp_text')
                                                    @slot('value',$seed['exp_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Опыт')
                                                    @slot('label','Опыт')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','grad_text')
                                                    @slot('value',$seed['grad_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Образование')
                                                    @slot('label','Образование')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','community_text')
                                                    @slot('value',$seed['community_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Клубы общества')
                                                    @slot('label','Клубы общества')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','certs_text')
                                                    @slot('value',$seed['certs_text'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Дипломы сертификаты')
                                                    @slot('label','Дипломы сертификаты')
                                                @endcomponent
                                            @endcomponent
                                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                                @component('components.form.summernote.textarea')
                                                    @slot('field','farm_partners')
                                                    @slot('value',$seed['farm_partners'] ?? '')
                                                    @slot('required',true)
                                                    @slot('formId','edit-form')
                                                    @slot('placeholder','Фарм сотруд')
                                                    @slot('label','Фарм сотруд')
                                                @endcomponent
                                            @endcomponent
                                        @endcomponent
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
                                            @slot('value',$seed['meta_h1'] ?? '')
                                            @slot('placeholder','SEO H1')
                                            @slot('label','SEO H1')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.text')
                                            @slot('field','meta_title')
                                            @slot('value',$seed['meta_title'] ?? '')
                                            @slot('placeholder','SEO заголовок')
                                            @slot('label','SEO заголовок')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                                        @component('components.form.summernote.textarea')
                                            @slot('field','meta_key')
                                            @slot('value',$seed['meta_key'] ?? '')
                                            @slot('placeholder','SEO ключевые слова')
                                            @slot('label','SEO ключевые слова')
                                        @endcomponent
                                    @endcomponent
                                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                                        @component('components.form.summernote.textarea')
                                            @slot('field','meta_desc')
                                            @slot('value',$seed['meta_desc'] ?? '')
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
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
    <form name="excel-form" id="excel-form" method="post" enctype="multipart/form-data"
          action="{{route('admin.doctors.import',['id'=>$seed['id'] ?? null])}}">
        {{csrf_field()}}
    </form>
    @push('component_scripts')
        <script>
            $('#import_doctor_excel').on('change', function () {
                if (confirm('Отменить импорт нельзя! Вы уверены?')) {
                    $('#excel-form').ajaxSubmit({
                        success: function (doctor) {
                            alert('Врач сохранен!');
                            window.location.assign('{{route('admin.doctors.form')}}/' + doctor.id);
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
                        if (!$mainForm.find('[name=id]').val())
                            window.location.assign('{{route('admin.doctors.form')}}/' + data.id);
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


            var lastItemIndex = {{count($seed['items'])}};
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