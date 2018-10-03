@extends('seo.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><a href="{{route('seo.medcenters.table.view')}}">Медцентры</a>
                    / {{$medcenter->name}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p>Город: <?php echo $medcenter->city->name; ?></p>
                <form method="post">
                    {{csrf_field()}}
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','meta_h1')
                                @slot('value',$medcenter->meta_h1 ?? '')
                                @slot('placeholder','SEO H1')
                                @slot('label','SEO H1')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','meta_title')
                                @slot('value',$medcenter->meta_title ?? '')
                                @slot('placeholder','SEO заголовок')
                                @slot('label','SEO заголовок')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','meta_key')
                            @slot('value',$medcenter->meta_key ?? '')
                            @slot('placeholder','SEO ключевые слова')
                            @slot('label','SEO ключевые слова')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','meta_desc')
                            @slot('value',$medcenter->meta_desc ?? '')
                            @slot('placeholder','SEO описание')
                            @slot('label','SEO описание')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','seo_text')
                            @slot('value',$medcenter->seo_text ?? '')
                            @slot('placeholder','SEO Текст')
                            @slot('label','SEO Текст')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.bootstrap.column',['class'=>'col-md-12 alert alert-info'])
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.textarea')
                                            @slot('field','content')
                                            @slot('value',$medcenter->content ?? " ")
                                            @slot('placeholder','Описание')
                                            @slot('label','Описание')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                                @component('components.bootstrap.row')
                                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                                        @component('components.form.textarea')
                                            @slot('field','content_lite')
                                            @slot('value',$medcenter->content_lite ?? "")
                                            @slot('placeholder','Краткое описание')
                                            @slot('label','Краткое описание')
                                        @endcomponent
                                    @endcomponent
                                @endcomponent
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
                </form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.row -->
    </div>
@endsection