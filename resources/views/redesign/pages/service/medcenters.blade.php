@extends('redesign.layouts.inner-page')
@section('content')
    {{-- @include('search.search_box_service')--}}
    <section class="pages--service pages--service__medcenters">
        <div class="container">
            <div class="search-result__list">
                <div class="results d-result service-med-line" data-type="medcenters"
                     data-id="" id="medcenters-result">

                    @foreach($service->medcenters as $medcenter)
                        <div class="medcenter__item  search-result__item entity-line">
                            @component('model.service.medcenter_profile-short',[
                            'medcenter'=>$medcenter
                            ])
                            @endcomponent
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>
@endsection

