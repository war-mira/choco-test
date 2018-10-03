@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
    @include('cabinet.components.doctor.aside')
        <div class="account-line__main account-content">
            @include('cabinet.components.doctor.question-answer-form')
        </div>
    </div>
@endsection