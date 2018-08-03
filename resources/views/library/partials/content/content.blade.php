<div class="section section-article__article-header">
    <div class="article__title">
        <h1>{{ $content->name }}</h1>
    </div>
    <img src="{{ URL::asset($content->image) }}">
</div>
<div class="section section-article__content">
    <div class="article-content__main">{!! $content->description !!}</div>
    @include('library.partials.content.aside')
</div>