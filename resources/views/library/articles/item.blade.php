@extends('redesign.layouts.inner-page')
@include('library.partials.navigation')
@section('breadcrumbs')
    {{ Breadcrumbs::render('library.illnesses-group-article', $article) }}
@endsection
@section('content')
    <div class="container">
        @include('library.partials.content.content', ['content' => $article])
    </div>
@endsection