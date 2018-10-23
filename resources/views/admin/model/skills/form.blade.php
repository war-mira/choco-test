@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Специализация</h1>
@endsection
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-2'])
                @component('components.form.text')
                    @slot('field','id')
                    @slot('value',$seed['id'] ?? null)
                    @slot('placeholder','Новый')
                    @slot('label','Id')
                    @slot('readonly',true)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.text')
                    @slot('field','name')
                    @slot('value',$seed['name'] ?? null)
                    @slot('placeholder','Название')
                    @slot('label','Название')
                    @slot('required',true)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.text')
                    @slot('field','alias')
                    @slot('value',$seed['alias'] ?? null)
                    @slot('placeholder','Транслит')
                    @slot('label','Транслит')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','description_lite')
                    @slot('value',$seed['description_lite'] ?? null)
                    @slot('placeholder','Короткое описание')
                    @slot('formId','edit-form')
                    @slot('label','Короткое описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','description')
                    @slot('value',$seed['description'] ?? null)
                    @slot('placeholder','Описание')
                    @slot('formId','edit-form')
                    @slot('label','Описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.text')
                    @slot('field','meta_title')
                    @slot('value',$seed['meta_title'] ?? null)
                    @slot('placeholder','SEO заголовок')
                    @slot('formId','edit-form')
                    @slot('label','SEO заголовок')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','meta_key')
                    @slot('value',$seed['meta_key'] ?? null)
                    @slot('placeholder','SEO ключевые слова')
                    @slot('formId','edit-form')
                    @slot('label','SEO ключевые слова')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','meta_desc')
                    @slot('formId','edit-form')
                    @slot('value',$seed['meta_desc'] ?? null)
                    @slot('placeholder','SEO описание')
                    @slot('label','SEO описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @isset($seed['id'])
            @component('components.bootstrap.row')
                @for($i=0;$i<3;$i++)
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @for($j=0;$j<3;$j++)
                            @component('components.form.select2.single')
                                @slot('id','top_doctors'.($i*3+$j))
                                @slot('field','top_doctors['.($i*3+$j).']')
                                @slot('value',$seed['top_doctors'][($i*3+$j)] ?? null)
                                @slot('placeholder','Топ '.($i*3+$j+1))
                                @slot('label','Топ '.($i*3+$j+1))
                                @slot('options',\App\Skill::find($seed['id'])->doctors()->whereStatus(1)->get())
                                @slot('allowClear',true)
                                @slot('idField','id')
                                @slot('nameField','name')
                            @endcomponent
                        @endfor
                    @endcomponent
                @endfor
            @endcomponent
        @endisset
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection