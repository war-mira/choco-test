<form action="{{route('admin.doctors.form.save',['id'=>$doctor['id']])}}" method="post">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.image')
                        @slot('field','avatar')
                        @slot('value',$doctor['avatar'] ?? '')
                        @slot('placeholder','')
                        @slot('label','')
                    @endcomponent
                @endcomponent
                <div class="col-md-12">
                    @component('components.form.select')
                        @slot('field','status')
                        @slot('value',$doctor['status'] ?? 0)
                        @slot('placeholder','Статус')
                        @slot('label','Статус')
                        @slot('options',\App\Enums\DoctorStatus::$DESCRIPTIONS)
                    @endcomponent
                </div>
                <div class="col-md-12">
                    @component('components.form.select')
                        @slot('field','on_top')
                        @slot('value',$doctor['on_top'] ?? 0)
                        @slot('placeholder','В топе')
                        @slot('label','В топе')
                        @slot('options',[0=>'Нет',1=>'Да'])
                    @endcomponent
                </div>
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','firstname')
                        @slot('value', old('firstname',$doctor['firstname']))
                        @slot('required',true)
                        @slot('label','Имя')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','lastname')
                        @slot('value', old('lastname',$doctor['lastname']))
                        @slot('required',true)
                        @slot('label','Фамилия')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','patronymic')
                        @slot('value', old('patronymic',$doctor['patronymic']))
                        @slot('label','Отчество')
                    @endcomponent
                @endcomponent

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','email')
                        @slot('value', old('email',$doctor['email']))
                        @slot('label','Email')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','phone')
                        @slot('value', old('phone',$doctor['phone']))
                        @slot('label','Phone')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','alias')
                        @slot('value', old('alias',$doctor['alias']))
                        @slot('readonly',true)
                        @slot('label','Ссылка')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.text')
                        @slot('field','address')
                        @slot('value',$doctor['address'] ?? '')
                        @slot('label','Адрес')
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.select2.single')
                        @slot('field','city_id')
                        @slot('value',$doctor['city_id'] ?? 6)
                        @slot('placeholder','Город')
                        @slot('label','Город')
                        @slot('options',\App\City::orderBy('name')->get())
                        @slot('search',true)
                        @slot('idField','id')
                        @slot('nameField','name')
                    @endcomponent
                @endcomponent
            </div>

        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
        </div>
    </div>
</form>