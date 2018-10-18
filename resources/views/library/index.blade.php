@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')
@section('breadcrumbs')
    @include('search.default',[
        'route'=>route('library.search') 
    ])
    {{ Breadcrumbs::render('library.index') }}
@endsection
@section('content')
    <section class="section library blog-list">
        @foreach($illnessesGroups as $group)
            @if($group->limitedArticles()->count())
                <div class="library-group__articles-list">
                <div class="container">
                    <div class="blog-list__list">
                        <div class="library-list_heading blog-list__heading">
                            <div class="section-heading__text">{{ $group->name }}</div>
                        </div>
                        @foreach($group->limitedArticles() as $article)
                            @include('library.partials.article_preview',  ['article' => $article, 'group' => $group])
                        @endforeach
                    </div>
                    <div class="library-list__load-more"><a class="library-list__btn btn transparent" href="{{route('library.illnesses-group-articles', $group->alias)}}">Все статьи по теме</a></div>
                </div>
            </div>
            @endif
        @endforeach
    </section>
@endsection