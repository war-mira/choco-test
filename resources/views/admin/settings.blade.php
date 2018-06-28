@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Настройки</h1>
@endsection
@section('form')
    <form action="{{$action}}" id="edit-form" method="post">
        {{csrf_field()}}
        @component('components.bootstrap.column',['class'=>'col-md-8'])
            @foreach($items as $item)
                @component('components.bootstrap.row')
                    <h2>{{$item['class']}}</h2>
                    @component('components.bootstrap.column',['class'=>'col-md-4'])
                        @component('components.form.textarea')
                            @slot('field',"settings[{$item["id"]}][title]")
                            @slot('value',$item['title'])
                            @slot('rows',3)
                            @slot('label','title')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-6'])
                        @component('components.form.textarea')
                            @slot('field',"settings[{$item["id"]}][description]")
                            @slot('value',$item['description'])
                            @slot('rows',5)
                            @slot('label','description')
                        @endcomponent
                    @endcomponent
                @endcomponent
            @endforeach
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection