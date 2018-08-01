@extends('redesign.layouts.inner-page')
@section('content')
    <div class="container">
        <div class="section section-article__article-header">
            <div class="article__title">
                <h1>{{ $article->name }}</h1>
            </div>
            <img>
        </div>
        <div class="section section-article__content">
            <div class="article-content__main">{{ $article->description }}</div>
            <div class="article-content__aside"></div>
        </div>
    </div>
@endsection