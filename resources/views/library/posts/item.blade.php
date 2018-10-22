@extends('redesign.layouts.inner-page')
@section('breadcrumbs')
    {{ Breadcrumbs::render('posts.post', ['alias' => $post->alias]) }}
@endsection
@section('content')
    <div class="container">
        <div class="section section-article__article-header">
            <div class="section__aside-mobile">
                @include('library.partials.content.aside')
            </div>
            <div class="article__title">
                <h1>{{ $post->title}}</h1>
            </div>
            @if(!empty($post->cover_image))
                <img src="{{ URL::asset($post->cover_image) }}">
            @endif
        </div>
        <div class="section section-article__content">
            <div class="article-content__main ">{!! $post->content !!}</div>
            <div class="article__aside-desktop">
                @include('library.partials.content.aside')
            </div>
        </div>
    </div>
@endsection