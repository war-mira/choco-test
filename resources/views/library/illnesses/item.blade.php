@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')
@section('breadcrumbs')
    {{ Breadcrumbs::render('illness', $illness) }}
@endsection
@section('content')
    <div class="container">
        @include('library.partials.content.content', ['content' => $illness, 'links' => $links,'text'=>$text??null])
    </div>
    @if(count($illness->doctors))
        <section class="docs-slider docs-slider_bg-white">
            <div class="container">
                <div class="docs-slider__heading">Врачи поблизости</div>
                <div class="docs-slider__slider entity-slider">
                    @foreach($illness->doctors as $doctor)
                        <div class="entity-slider__item">
                        <div class="entity-slider__item-img entity-thumb-img">
                            <div class="entity-thumb-img__img-wr">
                                <img src="{{ url($doctor->avatar) }}" alt="" class="entity-thumb-img__img profiles__img profiles__img--circle">
                                <div class="entity-thumb-img__rating">{{ $doctor->avg_rate }}</div>
                            </div>
                        </div>
                        <a href="#" class="docs-slider__item-link">
                            <div class="docs-slider__item-name">{{ $doctor->firtsname }}{{ $doctor->lastname }}</div>
                            <div class="docs-slider__item-spec">
                                @foreach ($doctor->skills as $i=>$skill)<a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name}}</a>
                                @if(count($doctor->skills) > 1 && $i!=(count($doctor->skills)-1)) / @endif  @endforeach
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection