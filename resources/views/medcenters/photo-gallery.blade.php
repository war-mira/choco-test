<section class="photo-gallery_slider photo-gallery_slider_bg-white">
    <div class="container">
        <div class="photo-gallery-slider__heading">Фотографии медцентра</div>
        <div class="photo-gallery-slider__slider entity-slider">
            @if($photos)
                @foreach($photos as $photo)
                    <div class="entity-slider__item">
                        <div class="entity-slider__item-img entity-thumb-img">
                            <div class="entity-thumb-img__img-wr">
                                <a class="image-link" href="{{ url($photo) }}">
                                    <img src="{{ url($photo) }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>