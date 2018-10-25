@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Тип медцентра</h1>
@endsection
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

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
                    @component('components.bootstrap.column',['class'=>'col-md-5'])
                        @component('components.form.text')
                            @slot('field','alias')
                            @slot('value',$seed['alias'] ?? null)
                            @slot('label','Ссылка')
                        @endcomponent

                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-5'])
                        @component('components.form.text')
                            @slot('field','keywords')
                            @slot('value',$seed['keywords'] ?? null)
                            @slot('label','Ключевые слова (keywords)')
                        @endcomponent

                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                        @component('components.form.text')
                            @slot('field','name')
                            @slot('value',$seed['name'] ?? null)
                            @slot('label','Название')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                        @component('components.form.text')
                            @slot('field','title')
                            @slot('value',$seed['title'] ?? null)
                            @slot('label','SEO заголовок')
                        @endcomponent
                    @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.textarea')
                                @slot('label','SEO Описание')
                                @slot('field','description')
                                @slot('value',$seed['description'] ?? null)
                                @slot('formId','edit-form')
                            @endcomponent
                        @endcomponent

                @endcomponent
            @endcomponent
                @component('components.bootstrap.column',['class'=>'col-md-3'])
                    @component('components.form.checkbox')
                        @slot('field','active')
                        @slot('value',$seed['active'] ?? null)
                        @slot('label','Опубликовано')
                    @endcomponent
                @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection