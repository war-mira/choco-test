@extends('redesign.layouts.inner-page')
@section('content')
@include('search.search_box_service')
    <section class="pages--service pages--service__medcenters">
        @include('search.filtr_service')
        <div class="container">
            <div class="search-result__list">
                <div class="results d-result search-result__item entity-line service-med-line" data-type="medcenters" data-id="" id="medcenters-result">

                    @component('model.service.medcenter_profile-short')
                    @endcomponent

                </div>
            </div>
            
        </div>
    </section>
@endsection

