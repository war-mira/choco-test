<div class="grid__column--item grid__column--item__image grid__column--item__image-left">
    <figure>
        <img src="<?=\App\Components\Image\ImageResize::getImageUrl($item->image, 800, 'auto')?>"
             alt="{{$item->getAlt()}}">
        <figcaption>{!! $item->desc !!}</figcaption>
    </figure>
</div>