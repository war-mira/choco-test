@extends('admin.form')
@section('page-heading')
    <h1 class="page-header">Заявка</h1>
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
                            @slot('placeholder','Новый')
                            @slot('label','Id')
                            @slot('readonly',true)
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-5'])
                        @component('components.form.text')
                            @slot('field','client_name')
                            @slot('value',$seed['client_name'] ?? null)
                            @slot('placeholder','Имя')
                            @slot('label','Имя')
                            @slot('readonly',true)
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-5'])
                        @component('components.form.text')
                            @slot('field','client_phone')
                            @slot('value',$seed['client_phone'] ?? null)
                            @slot('placeholder','Телефон')
                            @slot('label','Телефон')
                            @slot('readonly',true)
                        @endcomponent
                    @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-5'])
                            @component('components.form.text')
                                @slot('field','client_email')
                                @slot('value',$seed['client_email'] ?? null)
                                @slot('placeholder','Email')
                                @slot('label','Email')
                                @slot('readonly',true)
                            @endcomponent
                        @endcomponent
                @endcomponent
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-3'])
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                @component('components.form.select2.single')
                                    @slot('field','status')
                                    @slot('value',$seed['status'] ?? 0)
                                    @slot('placeholder','Статус')
                                    @slot('label','Статус')
                                    @slot('options',\App\Callback::STATUS)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                @component('components.form.text')
                                    @slot('field','target_type_name')
                                    @slot('value',$seed['target_type_name'] ?? null)
                                    @slot('placeholder','Тип')
                                    @slot('label','Тип')
                                    @slot('readonly',true)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                @component('components.form.text')
                                    @slot('field','target')
                                    @slot('value',$seed['target']['name'] ?? null)
                                    @slot('placeholder','Имя')
                                    @slot('label','Имя')
                                    @slot('readonly',true)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-12'])
                                @component('components.form.text')
                                    @slot('field','source_name')
                                    @slot('value',$seed['source_name'] ?? null)
                                    @slot('placeholder','Источник')
                                    @slot('label','Источник')
                                    @slot('readonly',true)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-9'])
                        @component('components.bootstrap.row')
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.textarea')
                                    @slot('field','client_comment')
                                    @slot('value',$seed['client_comment'] ?? null)
                                    @slot('placeholder','Комментарий клиента')
                                    @slot('label','Комментарий клиента')
                                    @slot('height','200px')
                                    @slot('maxlength','250')
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-md-6'])
                                @component('components.form.textarea')
                                    @slot('field','operator_comment')
                                    @slot('value',$seed['operator_comment'] ?? null)
                                    @slot('placeholder','Комментарий оператора')
                                    @slot('label','Комментарий оператора')
                                    @slot('height','200px')
                                    @slot('maxlength','250')
                                @endcomponent
                            @endcomponent
                        @endcomponent
                    @endcomponent
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                <div class="btn-group-vertical">
                    @isset($seed['id'])
                        <a href="{{route('admin.callbacks.orderFrom',['id'=>$seed['id']])}}"
                           class="btn btn-block btn-success">Оформить в ЗАКАЗ</a>
                    @endisset
                </div>
            @endcomponent
        @endcomponent
        <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
    </form>
@endsection