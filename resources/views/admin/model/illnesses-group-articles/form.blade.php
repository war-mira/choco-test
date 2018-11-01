@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Статья</h1>
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
            @component('components.bootstrap.column',['class'=>'col-md-5'])
                @component('components.form.text')
                    @slot('field','name')
                    @slot('value',$seed['name'] ?? null)
                    @slot('placeholder','Название')
                    @slot('label','Заголовок')
                    @slot('required',true)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.text')
                    @slot('field','alias')
                    @slot('value',$seed['alias'] ?? null)
                    @slot('placeholder','Транслит')
                    @slot('label','Транслит')
                    @slot('readonly',true)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-2'])
                @component('components.form.checkbox')
                    @slot('field','active')
                    @slot('value',$seed['active'] ?? null)
                    @slot('label','Опубликовано')
                @endcomponent
            @endcomponent

        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.image')
                    @slot('field','image')
                    @slot('value',$seed['image'] ?? '')
                    @slot('placeholder','Обложка')
                    @slot('label','Обложка')
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.select2.single')
                    @slot('field','illnesses_group_id')
                    @slot('value',$seed['illnesses_group_id'] ?? 0)
                    @slot('placeholder','Группа')
                    @slot('label','Группа')
                    @slot('options',\App\Models\Library\IllnessesGroup::orderBy('name')->get())
                    @slot('idField','id')
                    @slot('nameField','name')
                @endcomponent
            @endcomponent
        @endcomponent

        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','description-lite')
                    @slot('value',$seed['description-lite'] ?? null)
                    @slot('placeholder','Краткое описание')
                    @slot('formId','edit-form')
                    @slot('label','Краткое описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.textarea')
                    @slot('field','content')
                    @slot('value',$seed['content'] ?? null)
                    @slot('formId','edit-form')
                    @slot('id','grid__textarea')
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                <div class="grid__maker">
                    <div id="grid__container" class="grid">
                    </div>
                    <div class="grid__maker--buttons">
                        <div class="btn add-block" data-type="row"><i class="fa fa-plus"></i> Добавить ряд</div>
                    </div>
                </div>
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

    @push('custom.css')
        <link  rel="stylesheet" type="text/css" href="/projects/longrid-js/css/editor.css">
        <link  rel="stylesheet" type="text/css" href="/projects/libs/dropzone/min/basic.min.css">
        <link  rel="stylesheet" type="text/css" href="/projects/libs/dropzone/min/dropzone.min.css">
    @endpush
    @push('component_scripts')
        <script src="/projects/libs/dropzone/min/dropzone.min.js"></script>
        <script src="/projects/longrid-js/js/editor.js"></script>
    @endpush
@endsection