<div class="clinic-slider__slider entity-slider">
    @foreach($near as $tt)
        <div class="entity-slider__item">
            <div class="entity-slider__item-img entity-thumb-img">
                <div class="entity-thumb-img__img-wr">
                    @component('components.medcenters-img')
                        @slot('src')
                            {{$tt->avatar}}
                        @endslot
                        @slot('width')
                            250px
                        @endslot
                        @slot('height')
                            250px
                        @endslot
                    @endcomponent
                    <a href="#" class="entity-thumb-img__add-favorite"></a>
                    <div class="entity-thumb-img__rating">{{$tt['rate']}}</div>
                </div>
            </div>
            <a href="{{Route('medcenter.item', ['medcenter' => $tt->alias])}}" class="entity-slider__item-link">
                <div class="entity-slider__item-name">{{$tt->name}}</div>
                <div class="entity-slider__item-spec">многопрофильное учреждение</div>
            </a>
        </div>
    @endforeach
</div>