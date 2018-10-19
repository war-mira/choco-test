@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')
@section('breadcrumbs')
    {{ Breadcrumbs::render('illness', $illness) }}
@endsection
@section('content')
    <div class="container">
        @include('library.partials.content.content', ['content' => $illness, 'links' => $links])
    </div>
    @if(count($illness->doctors))
        <section class="entity-about">
        <div class="container">
            <div class="entity-about__tab-line tabs">
                <a href="#" data-tab="tab-1" class="entity-about__tab-item entity-about__tab-item_active">
                    <h2 class="entity-about__tab-name">Врачи, лечащие данное заболевание</h2>
                </a>
            </div>
            <div class="entity-about__content entity-content">
                <div id="tab-1" class="entity-about-article current">
                    <div class="entity-content__main">
                            @foreach($illness->doctors as $doctor)
                            <div class="entity-line">
                                @component('model.doctor.prof_article',['doctor'=>$doctor,'width'=>'250px','highlightSkill'=>null,'comercial'=>true])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection