<section class="docs-slider docs-slider_bg-white">
    <div class="container">
        <div class="docs-slider__heading">Врачи поблизости</div>
        <div class="docs-slider__slider entity-slider">
            @foreach($near as $tt)
                <div class="entity-slider__item">
                    <div class="entity-slider__item-img entity-thumb-img">
                        <div class="entity-thumb-img__img-wr">
                            @component('components.prof-img')
                                @slot('src')
                                    {{$doctor['avatar']}}
                                @endslot
                                @slot('width')
                                    250px
                                @endslot
                                @slot('height')
                                    250px
                                @endslot
                            @endcomponent
                            <a href="#" class="entity-thumb-img__add-favorite"></a>
                            <div class="entity-thumb-img__rating">{{$tt->avg_rate}}</div>
                        </div>
                    </div>
                    <a href="{{Route('doctor.item', ['doctor' => $tt->alias])}}" class="docs-slider__item-link">
                        <div class="docs-slider__item-name">{{$tt->name}}</div>
                        <div class="docs-slider__item-spec">
                            @foreach ($tt['skills'] as $i=>$skill)<a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                            @if(count($tt['skills']) > 1 && $i!=(count($tt['skills'])-1)) / @endif  @endforeach
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>