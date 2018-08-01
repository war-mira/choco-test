@extends('redesign.layouts.inner-page')
@section('content')
    <section class="section library blog-list">
        <div class="container">
                @foreach($illnessesGroups as $group)
                <div class="blog-list__list">
                    <div class="library-list_heading blog-list__heading">
                        <div class="section-heading__text">{{ $group->name }}</div>
                    </div>
                    @foreach($group->limitedArticles() as $article)
                    <div class="blog-item blog-list__list-item toning"
                         style="background-image: url({{ URL::asset($article['cover_image'])}});">
                        <div class="blog-item__name">{{$article->name}}</div>
                        <div class="blog-item__bot-line">
                            <a href="{{  route('library.article', [$group->alias, $article->alias])}}"
                               class="blog-item__link"><span>Читать целиком</span><i class="fa fa-chevron-right"
                                                                                     aria-hidden="true"></i></a>
                            <div class="blog-item__date">
                                <div>Дата публикации</div>
                                <div>{{$article->created_at->format('Y-m-d')}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="library-list__load-more"><a class="library-list__btn btn transparent" href="{{url('posts')}}">Все статьи по теме</a></div>
            @endforeach
        </div>
    </section>
@endsection