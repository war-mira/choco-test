<div class="grid__column--item grid__column--item__image grid__column--item__image-right">
    <figure>
        <img src="<?=\App\Components\Image\ImageResize::getImageUrl($item->image, 800, 'auto')?>"
             alt="{{$item->getAlt()}}">
        @if(!$item->isEmptyCaption())
            <figcaption>{!! $item->getDesc() !!}</figcaption>
        @endif
    </figure>
</div>