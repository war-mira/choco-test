<section class="docs-slider docs-slider_bg-white">
    <div class="container">
        <div class="docs-slider__heading">Врачи поблизости</div>
        <div class="docs-slider__slider entity-slider">
            @foreach($near as $near_doc)
                <div class="entity-slider__item">
                    <div class="entity-slider__item-img entity-thumb-img">
                        <div class="entity-thumb-img__img-wr">
                            @component('components.prof-img',['doctor'=>$near_doc,
                                'width'=>140,
                                'height'=>200
                                ])
                                @slot('src')
                                    {{$near_doc->avatar}}
                                @endslot

                                @slot('alt')
                                    {{$near_doc->name}}
                                @endslot
                            @endcomponent
                            <div class="entity-thumb-img__rating">{{$near_doc->avg_rate}}</div>
                        </div>
                    </div>
                    <a href="{{Route('doctor.item', ['doctor' => $near_doc->alias])}}" class="docs-slider__item-link">
                        <div class="docs-slider__item-name">{{$near_doc->name}}</div>
                        <div class="docs-slider__item-spec">
                            @foreach ($near_doc->getSkillsList() as $i=>$skill)<a href="{{$skill->href}}"
                                                                                  style="text-decoration: none">{{$skill->name}}</a>
                            @if(count($near_doc->getSkillsList()) > 1 && $i!=(count($near_doc->getSkillsList())-1))
                                /
                            @endif
                            @endforeach
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>