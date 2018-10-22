<div class="section__aside-mobile">
    @include('library.partials.content.aside')
</div>
<div class="section-article__article-header">
    @if(!isset($titleInDesc) || $titleInDesc != true)
        <div class="article__title">
            <h1>{{ $content->name }}</h1>
        </div>
    @endif

@if(!empty($content->image) && file_exists($content->image))
    <img src="{{ URL::asset($content->image) }}">
@endif
</div>
<div class="section section-article__content">
    <div class="article-content__main grid">{!! $text??$content->description !!}</div>
    <div class="article__aside-desktop">
        @include('library.partials.content.aside')
    </div>
</div>