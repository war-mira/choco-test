<div class="grid__column--item grid__column--item__image grid__column--item__image-default">
    <figure>
        <img src="<?=\App\Components\Image\ImageResize::getImageUrl($item->image, 800, 'auto')?>"
             alt="{{$item->getAlt()}}">
        <figcaption>{!! $item->getDesc() !!}</figcaption>
    </figure>
</div>