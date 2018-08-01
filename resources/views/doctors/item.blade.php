@extends('new')
@section('content')
    <div class="container">
        @include('redesign.partials.index.search')
    </div>

    <!-- begin section -->
    @include('doctors.doctor')
    @include('doctors.docs_near')
@endsection
