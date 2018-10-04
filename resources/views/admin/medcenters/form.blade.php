@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Медцентр</h1>
@endsection
@section('form')
    <form id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-9'])
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-2'])
                        @component('components.form.text')
                            @slot('field','id')
                            @slot('value',$medcenter['id'] ?? null)
                            @slot('readonly',true)
                            @slot('label','Id')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-10'])
                        @component('components.form.text')
                            @slot('field','name')
                            @slot('value',$medcenter['name'] ?? null)
                            @slot('label','Название')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.text')
                            @slot('field','alias')
                            @slot('value',$medcenter['alias'] ?? null)
                            @slot('label','Ссылка')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.number')
                            @slot('field','geo_lat')
                            @slot('value',$medcenter['geo_lat'] ?? null)
                            @slot('label','geo_lat')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.text')
                            @slot('field','geo_lon')
                            @slot('value',$medcenter['geo_lon'] ?? null)
                            @slot('label','geo_lon')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-2'])
                        @component('components.form.checkbox')
                            @slot('field','ambulatory')
                            @slot('value',$medcenter['ambulatory'] ?? null)
                            @slot('label','Выезд на дом')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.select2.single')
                            @slot('field','status')
                            @slot('value',$medcenter['status'] ?? null)
                            @slot('placeholder','Статус')
                            @slot('label','Статус')
                            @slot('options',\App\Models\Doctors\Doctor::STATUS)
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.select2.single')
                            @slot('field','rate')
                            @slot('value',$medcenter['rate'] ?? 5)
                            @slot('placeholder','Рейтинг')
                            @slot('label','Рейтинг')
                                @slot('options',[0,1,2,3,4,5,6,7,8,9,10])
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.number')
                            @slot('field','price')
                            @slot('value',$medcenter['price'] ?? null)
                            @slot('label','Цена')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.number')
                            @slot('field','commission')
                            @slot('value',$medcenter['commission'] ?? null)
                            @slot('label','Комиссия')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                            @component('components.form.text')
                                @slot('field','email')
                                @slot('value',$medcenter['email'] ?? null)
                                @slot('label','Email')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.number')
                            @slot('field','money_balans')
                            @slot('value',$medcenter['money_balans'] ?? null)
                            @slot('label','Баланс')
                        @endcomponent
                    @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.text')
                            @slot('field','map')
                            @slot('value',$medcenter['map'] ?? null)
                            @slot('label','Адрес')
                        @endcomponent
                    @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                            @component('components.form.text')
                                @slot('field','sms_address')
                                @slot('value',$medcenter['sms_address'] ?? null)
                                @slot('label','SMS адрес')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.form.select2.single')
                            @slot('field','city_id')
                            @slot('value',$medcenter['city_id'] ?? null)
                            @slot('placeholder','Город')
                            @slot('label','Город')
                                @slot('options',\App\City::query()->orderBy('name')->get())
                                @slot('idField','id')
                                @slot('nameField','name')
                                @slot('search',true)
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-3'])
                            @component('components.form.select2.single')
                                @slot('field','district_id')
                                @slot('value',$medcenter['district_id'] ?? null)
                                @slot('placeholder','Район')
                                @slot('label','Район')
                                @slot('options',\App\Model\Location\District::query()->orderBy('name')->get())
                            @slot('idField','id')
                            @slot('nameField','name')
                            @slot('search',true)
                                @slot('allowClear',true)
                        @endcomponent
                    @endcomponent
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.image')
                    @slot('field','avatar')
                    @slot('value',$medcenter['avatar'] ?? '')
                    @slot('placeholder','Аватар')
                    @slot('label','Аватар')
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
                                        @slot('value',$medcenter['content'] ?? null)
                                        @slot('placeholder','Описание')
                                        @slot('label','Описание')
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.row')
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','content_lite')
                                        @slot('value',$medcenter['content_lite'] ?? null)
                                        @slot('placeholder','Краткое описание')
                                        @slot('label','Краткое описание')
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.text')
                                            @slot('field','meta_h1')
                                            @slot('value',$medcenter['meta_h1'] ?? null)
                                            @slot('label','SEO H1')
                                        @endcomponent
                                    @endcomponent
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.text')
                                            @slot('field','meta_title')
                                            @slot('value',$medcenter['meta_title'] ?? null)
                                            @slot('label','SEO заголовок')
                                        @endcomponent
                                    @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','meta_key')
                                        @slot('value',$medcenter['meta_key'] ?? null)
                                        @slot('placeholder','SEO ключевые слова')
                                        @slot('label','SEO ключевые слова')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.summernote.textarea')
                                        @slot('field','meta_desc')
                                        @slot('value',$medcenter['meta_desc'] ?? null)
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
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection