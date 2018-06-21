@extends('seo.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><a href="{{route('seo.pageseo.table.view')}}">PageSeo</a>
                    / {{$pageseo->class}} - {{$pageseo->action}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form method="post">
                    {{csrf_field()}}
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','title')
                                @slot('value',$pageseo->title ?? '')
                                @slot('placeholder','SEO заголовок')
                                @slot('label','SEO заголовок')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.text')
                                @slot('field','h1')
                                @slot('value',$pageseo->h1 ?? '')
                                @slot('placeholder','SEO H1')
                                @slot('label','SEO H1')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','keywords')
                            @slot('value',$pageseo->keywords ?? '')
                            @slot('placeholder','SEO ключевые слова')
                            @slot('label','SEO ключевые слова')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-md-6'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','description')
                            @slot('value',$pageseo->description ?? '')
                            @slot('placeholder','SEO описание')
                            @slot('label','SEO описание')
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-md-12'])
                            @component('components.form.textarea') @slot('height','400px')
                            @slot('field','seo_text')
                            @slot('value',$pageseo->seo_text ?? '')
                            @slot('placeholder','SEO Текст')
                            @slot('label','SEO Текст')
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