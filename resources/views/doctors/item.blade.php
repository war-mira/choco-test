@extends('redesign.layouts.inner-page')
@section('content')
    @include('search.search_box')
    <!-- begin section -->
    @include('doctors.doctor')
    @include('doctors.docs_near')
@endsection