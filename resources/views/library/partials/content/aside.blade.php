<div class="article-content__aside">
    @include('library.partials.article_nav', ['links' => $links])
    @component('elements.side-banner',['position' => App\Banner::POSITION_EXT_C['id']])@endcomponent
</div>