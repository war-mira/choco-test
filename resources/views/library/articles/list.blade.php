@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')
@section('breadcrumbs')
    {{ Breadcrumbs::render('library.illnesses-group-articles', $illnessesGroup) }}
@endsection
@section('content')
    <div class="library-group__articles-list">
        <div class="container">
            <div class="blog-list__list">
                <div class="library-list_heading blog-list__heading">
                    <div class="section-heading__text">{{ $illnessesGroup->name }}</div>
                </div>
                @foreach($articles as $article)
                    @include('library.partials.article_preview', ['article' => $article, 'group' => $illnessesGroup])
                @endforeach
            </div>
        </div>
    </div>
    @if($articles->links() != "")
        <div class="text-center search-pagination" id="topPagination">
            {!! $articles->links() !!}
        </div>
    @endif
@endsection