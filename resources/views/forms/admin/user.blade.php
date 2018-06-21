@extends('admin.form')
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-2'])
                @component('components.form.text')
                    @slot('field','id')
                    @slot('value',$seed['id'] ?? null)
                    @slot('readonly',true)
                    @slot('label','Id')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.bootstrap-select.single')
                    @slot('field','role')
                    @slot('value',$seed['role'] ?? null)
                    @slot('options',\App\User::ROLES)
                    @slot('readonly',true)
                    @slot('label','Роль')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.text')
                    @slot('field','name')
                    @slot('value',$seed['name'] ?? null)
                    @slot('label','Имя')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.text')
                    @slot('field','email')
                    @slot('value',$seed['email'] ?? null)
                    @slot('readonly',$readonly)
                    @slot('label','Email')
                @endcomponent
            @endcomponent
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.phone')
                    @slot('field','phone')
                    @slot('value',$seed['phone'] ?? null)
                    @slot('readonly',$readonly)
                    @slot('label','Телефон')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.phone')
                    @slot('field','phone2')
                    @slot('value',$seed['phone2'] ?? null)
                    @slot('label','Телефон доп.')
                    @slot('readonly',$readonly)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.form.bootstrap-select.single')
                    @slot('field','city_id')
                    @slot('value',$seed['city_id'] ?? null)
                    @slot('placeholder','Город')
                    @slot('label','Город')
                    @slot('options',\App\City::orderBy('name')->get())
                    @slot('idField','id')
                    @slot('nameField','name')
                    @slot('search',true)
                    @slot('readonly',$readonly)
                @endcomponent
            @endcomponent
        @endcomponent
        @if($readonly)
            <a class="btn btn-primary btn-block"
               href="{{route('admin.users.form',['name'=>'edit','id'=>$seed['id']])}}">
                Изменить
            </a>
        @else
            <input type="submit" class="btn btn-primary btn-block" value="Сохранить">

        @endif

    </form>
    <script>
        @foreach($errors->keys() as $field)
        $("#edit-form *[name={{$field}}]").addClass("is-invalid");
        $("#edit-form *[name={{$field}}]").after("<div class=\"invalid-feedback\">{{$errors->first($field)}}</div>");
        @endforeach
    </script>
@endsection