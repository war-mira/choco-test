@extends('seo.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><a href="{{route('seo.doctors.table.view')}}">Врачи</a> / {{$doctor->name}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Город: <?php echo $doctor->city->name; ?></p>
                <form method="post">
                    {{csrf_field()}}
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','meta_h1')
                                @slot('value',$doctor->meta_h1 ?? '')
                                @slot('placeholder','SEO H1')
                                @slot('label','SEO H1')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','meta_title')
                                @slot('value',$doctor->meta_title ?? '')
                                @slot('placeholder','SEO заголовок')
                                @slot('label','SEO заголовок')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','meta_key')
                            @slot('value',$doctor->meta_key ?? '')
                            @slot('placeholder','SEO ключевые слова')
                            @slot('label','SEO ключевые слова')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','meta_desc')
                            @slot('value',$doctor->meta_desc ?? '')
                            @slot('placeholder','SEO описание')
                            @slot('label','SEO описание')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','seo_text')
                            @slot('value',$doctor->seo_text ?? '')
                            @slot('placeholder','SEO Текст')
                            @slot('label','SEO Текст')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4>Описание</h4>
                        </div>
                        <div class="panel-body">
                            @component('components.bootstrap.row')
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.textarea')
                                        @slot('field','preview_text')
                                        @slot('value',$doctor->preview_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Краткое описание')
                                        @slot('label','Краткое описание')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-6'])
                                    @component('components.form.textarea')
                                        @slot('field','timetable')
                                        @slot('value', $doctor->timetable ?? '')
                                        @slot('required',false)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','График работы')
                                        @slot('label','График работы')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','about_text')
                                        @slot('value',$doctor->about_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Описание')
                                        @slot('label','Описание')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','treatment_text')
                                        @slot('value',$doctor->treatment_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Лечение')
                                        @slot('label','Лечение')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','exp_text')
                                        @slot('value',$doctor->exp_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Опыт')
                                        @slot('label','Опыт')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','grad_text')
                                        @slot('value',$doctor->grad_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Образование')
                                        @slot('label','Образование')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','community_text')
                                        @slot('value',$doctor->community_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Клубы общества')
                                        @slot('label','Клубы общества')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','certs_text')
                                        @slot('value',$doctor->certs_text ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Дипломы сертификаты')
                                        @slot('label','Дипломы сертификаты')
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.column',['class'=>'col-md-12'])
                                    @component('components.form.textarea')
                                        @slot('field','farm_partners')
                                        @slot('value',$doctor->farm_partners ?? '')
                                        @slot('required',true)
                                        @slot('formId','edit-form')
                                        @slot('placeholder','Фарм сотруд')
                                        @slot('label','Фарм сотруд')
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
                </form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.row -->
    </div>
@endsection