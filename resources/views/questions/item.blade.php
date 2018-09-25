@extends('redesign.layouts.inner-page')
@section('content')
    @include('search.search_box_question')
    <!-- begin section -->
    @include('questions.question_item_block')
    @include('questions.question_near')
@endsection