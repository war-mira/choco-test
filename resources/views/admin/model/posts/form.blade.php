@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Пост</h1>
@endsection
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @component('components.bootstrap.column',['class'=>'col-md-8'])
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
                @component('components.bootstrap.column',['class'=>'col-md-5'])
                    @component('components.form.text')
                        @slot('field','title')
                        @slot('value',$seed['title'] ?? null)
                        @slot('placeholder','Заголовок')
                        @slot('label','Заголовок')
                        @slot('required',true)
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-5'])
                    @component('components.form.text')
                        @slot('field','alias')
                        @slot('value',$seed['alias'] ?? null)
                        @slot('placeholder','Транслит')
                        @slot('label','Транслит')
                        @slot('readonly',true)
                    @endcomponent
                @endcomponent
            @endcomponent
            @component('components.bootstrap.row')
                @component('components.bootstrap.column',['class'=>'col-md-6'])
                    @component('components.form.select2.single')
                        @slot('field','status')
                        @slot('value',$seed['status'] ?? 0)
                        @slot('placeholder','Статус')
                        @slot('label','Статус')
                        @slot('options',\App\Post::STATUS)
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-6'])
                    @component('components.form.select2.single')
                        @slot('field','is_top')
                        @slot('value',$seed['is_top'] ?? 0)
                        @slot('placeholder','В топе')
                        @slot('label','В топе')
                        @slot('options',[0=>'Нет',1=>'Да'])
                    @endcomponent
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-4'])
            @component('components.form.image')
                @slot('field','cover_image')
                @slot('value',$seed['cover_image'] ?? '')
                @slot('placeholder','Обложка')
                @slot('label','Обложка')
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','content_lite')
                    @slot('value',$seed['content_lite'] ?? null)
                    @slot('placeholder','Краткое описание')
                    @slot('formId','edit-form')
                    @slot('label','Описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','content')
                    @slot('value',$seed['content'] ?? null)
                    @slot('placeholder','Контент')
                    @slot('formId','edit-form')
                    @slot('label','Контент')
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
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection