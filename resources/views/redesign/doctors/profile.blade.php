@extends('redesign.layouts.app')
@section('content')
    @push('modals')
        @include('redesign.partials.modals.extended-order')
    @endpush
    <section class="search-screen">
        <div class="header inner-template">
            @include('redesign.partials.header')
        </div>
        <!-- /Title block -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="inner-template main-search-block">
                        @component('redesign.partials.index.search')
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!-- /Search block -->
    </section>

    <section class="single-page-container">
        @include('redesign.doctors.profile.main')
        @include('redesign.doctors.profile.tabs')
    </section>
@endsection