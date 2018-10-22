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
        <div class="article-content__aside">
            @include('library.partials.content.aside', ['skill' => $skill ?? null])
            <div class="entity-content__banner">
                <div class="entity-content_askform">
                    <div class="leave-review__heading">Задать вопрос врачу</div>
                    @include('forms.public.ask_doctor_form', ['selectedSkill' => $skill ?? null])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fb-comments" data-href="" data-numposts="5"></div>
