@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Уведомление</h1>
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
                    @slot('field','phone')
                    @slot('value',$seed['phone'] ?? null)
                    @slot('placeholder','Транслит')
                    @slot('label','Транслит')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-12'])
                @component('components.form.summernote.textarea')
                    @slot('field','text')
                    @slot('value',$seed['text'] ?? null)
                    @slot('placeholder','Описание')
                    @slot('formId','edit-form')
                    @slot('label','Описание')
                    @slot('required',true)
                @endcomponent
            @endcomponent
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>

@endsection