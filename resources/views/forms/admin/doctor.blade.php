@extends('admin.form')
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_redirect" value="admin.doctors.form">
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-9'])
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-2'])
                        @component('components.form.text')
                            @slot('field','id')
                            @slot('value',$seed['id'] ?? null)
                            @slot('readonly',true)
                            @slot('label','Id')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                        @component('components.form.text')
                            @slot('field','firstname')
                            @slot('value',$seed['firstname'] ?? '')
                            @slot('required',true)
                            @slot('label','Имя')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.text')
                            @slot('field','lastname')
                            @slot('value',$seed['lastname'] ?? '')
                            @slot('required',true)
                            @slot('label','Фамилия')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.text')
                            @slot('field','qualification')
                            @slot('value',$seed['qualification'] ?? '')
                            @slot('label','Квалификация')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.text')
                            @slot('field','alias')
                            @slot('value',$seed['alias'] ?? '')
                            @slot('required',true)
                            @slot('label','Ссылка')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.number')
                            @slot('field','works_since_year')
                            @slot('value',$seed['works_since_year'] ?? null)
                            @slot('label','Стаж с')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                        @component('components.form.number')
                            @slot('field','ambulatory_price')
                            @slot('value',$seed['ambulatory_price'] ?? 0)
                            @slot('label','Цена выезда')
                            @slot('required',true)
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.checkbox')
                            @slot('field','child')
                            @slot('value',$seed['child'] ?? null)
                            @slot('label','Детский')
                        @endcomponent
                        @component('components.form.checkbox')
                            @slot('field','ambulatory')
                            @slot('value',$seed['ambulatory'] ?? null)
                            @slot('label','Выезд на дом')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                            @component('components.form.select2.single')
                            @slot('field','rate')
                            @slot('value',$seed['rate'] ?? 5)
                            @slot('placeholder','Рейтинг')
                            @slot('required',true)
                            @slot('label','Рейтинг')
                                @slot('options',[0,1,2,3,4,5,6,7,8,9,10])
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.number')
                            @slot('field','price')
                            @slot('value',$seed['price'] ?? 0)
                            @slot('required',true)
                            @slot('label','Цена')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.number')
                            @slot('field','commission')
                            @slot('required',true)
                            @slot('value',$seed['commission'] ?? 0)
                            @slot('label','Комиссия')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.number')
                            @slot('field','discount')
                            @slot('required',true)
                            @slot('value',$seed['discount'] ?? 0)
                            @slot('label','Скидка')
                        @endcomponent
                    @endcomponent
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.image')
                    @slot('field','avatar')
                    @slot('value',$seed['avatar'] ?? '')
                    @slot('placeholder','Аватар')
                    @slot('label','Аватар')
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.text')
                    @slot('field','address')
                    @slot('value',$seed['address'] ?? '')
                    @slot('label','Адрес')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.select2.single')
                    @slot('field','med_id')
                    @slot('value',$seed['med_id'] ?? 0)
                    @slot('placeholder','Медцентр')
                    @slot('label','Медцентр')
                    @slot('options',\App\Medcenter::orderBy('name')->get())
                    @slot('search',true)
                    @slot('idField','id')
                    @slot('required',true)
                    @slot('nameField','name')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
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
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.bootstrap.column',['class'=>'col-md-12 alert alert-info'])
                    @component('components.bootstrap.collapse')
                        @slot('hiddenId','descriptions_section')
                        @slot('hideText','Скрыть Описание, SEO')
                        @slot('openText','Показать Описание, SEO')
                        @slot('hiddenContent')
                            @component('components.bootstrap.row')
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','content')
                                        @slot('value',$seed['content'] ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Описание')
                                        @slot('label','Описание')
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.row')
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','content_lite')
                                        @slot('value',$seed['content_lite'] ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Краткое описание')
                                        @slot('label','Краткое описание')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','timetable')
                                        @slot('value',$seed['timetable'] ?? '')
                                        @slot('required',false)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','График работы')
                                        @slot('label','График работы')
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
                        @endslot
                    @endcomponent
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.select2.single')
                    @slot('field','status')
                    @slot('value',$seed['status'] ?? 0)
                    @slot('placeholder','Статус')
                    @slot('label','Статус')
                    @slot('options',\App\Doctor::STATUS)
                @endcomponent
                @component('components.form.select2.single')
                    @slot('field','on_top')
                    @slot('value',$seed['on_top'] ?? 0)
                    @slot('placeholder','В топе')
                    @slot('label','В топе')
                    @slot('options',[0=>'Нет',1=>'Да'])
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-9'])
                @component('components.form.multiselect')
                    @slot('field','skills')
                    @slot('value',$seed['skills'] ?? [])
                    @slot('placeholder','Специализации')
                    @slot('label','Специализации')
                    @slot('options',\App\Skill::orderBy('name')->get())
                    @slot('idField','id')
                    @slot('nameField','name')
                @endcomponent
            @endcomponent
        @endcomponent
            <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>

@endsection