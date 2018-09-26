<section class="docs-slider docs-slider_bg-white">
    <div class="container">
        <div class="docs-slider__heading">Врачи поблизости</div>
        <div class="docs-slider__slider entity-slider">
            @foreach($near as $tt)
                <div class="entity-slider__item">
                    <div class="entity-slider__item-img entity-thumb-img">
                        <div class="entity-thumb-img__img-wr">
                            @component('components.prof-img',['doctor'=>$tt,
                                'width'=>140,
                                'height'=>200
                                ])
                                @slot('src')
                                    {{$tt->avatar}}
                                @endslot

                                @slot('alt')
                                   {{$tt->name}}
                                @endslot
                            @endcomponent
                            <div class="entity-thumb-img__rating">{{$tt->avg_rate}}</div>
                        </div>
                    </div>
                    <a href="{{Route('doctor.item', ['doctor' => $tt->alias])}}" class="docs-slider__item-link">
                        <div class="docs-slider__item-name">{{$tt->name}}</div>
                        <div class="docs-slider__item-spec">
                            @foreach ($tt['skills'] as $i=>$skill)<a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name}}</a>
                            @if(count($tt['skills']) > 1 && $i!=(count($tt['skills'])-1)) / @endif  @endforeach
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>