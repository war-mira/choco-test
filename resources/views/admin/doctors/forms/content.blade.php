<form action="{{route('admin.doctors.form.save',['id'=>$doctor['id']])}}" method="post">
    {{csrf_field()}}
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-6'])
            @component('components.form.summernote.textarea')
                @slot('field','preview_text')
                @slot('value',$doctor['preview_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Краткое описание')
                @slot('label','Краткое описание')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-6'])
            @component('components.form.summernote.textarea')
                @slot('field','timetable')
                @slot('value',$doctor['timetable'] ?? '')
                @slot('required',false)
                @slot('formId','edit-form')
                @slot('placeholder','График работы')
                @slot('label','График работы')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','about_text')
                @slot('value',$doctor['about_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Описание')
                @slot('label','Описание')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','treatment_text')
                @slot('value',$doctor['treatment_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Лечение')
                @slot('label','Лечение')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','exp_text')
                @slot('value',$doctor['exp_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Опыт')
                @slot('label','Опыт')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','grad_text')
                @slot('value',$doctor['grad_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Образование')
                @slot('label','Образование')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','community_text')
                @slot('value',$doctor['community_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Клубы общества')
                @slot('label','Клубы общества')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','certs_text')
                @slot('value',$doctor['certs_text'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Дипломы сертификаты')
                @slot('label','Дипломы сертификаты')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.summernote.textarea')
                @slot('field','farm_partners')
                @slot('value',$doctor['farm_partners'] ?? '')
                @slot('required',true)
                @slot('formId','edit-form')
                @slot('placeholder','Фарм сотруд')
                @slot('label','Фарм сотруд')
            @endcomponent
        @endcomponent
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
        </div>
    @endcomponent
</form>