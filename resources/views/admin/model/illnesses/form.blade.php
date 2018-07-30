@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Заболевание</h1>
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
                @component('components.bootstrap.column',['class'=>'col-md-4'])
                    @component('components.form.text')
                        @slot('field','name')
                        @slot('value',$seed['name'] ?? null)
                        @slot('placeholder','Название')
                        @slot('label','Заголовок')
                        @slot('required',true)
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-4'])
                    @component('components.form.text')
                        @slot('field','alias')
                        @slot('value',$seed['alias'] ?? null)
                        @slot('placeholder','Транслит')
                        @slot('label','Транслит')
                        @slot('readonly',true)
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-12'])
                    @component('components.form.select2.single')
                        @slot('field','group_id')
                        @slot('value',$seed['group_id'] ?? 0)
                        @slot('placeholder','Группа')
                        @slot('label','Группа')
                        @slot('options',\App\Models\Library\IllnessesGroup::orderBy('name')->get())
                        @slot('idField','id')
                        @slot('nameField','name')
                    @endcomponent
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
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection