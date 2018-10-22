<div class="grid__column--item grid__column--item__quote grid__column--item__quote-citate">
    <blockquote class="citate">
        <div class="blockquote-content">
            {!! $item->content !!}
        </div>
        @if(!$item->isEmptyCredits())
            <footer>{!! $item->credits !!}</footer>
        @endif
    </blockquote>
</div>