@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
        <doctor-reviews></doctor-reviews>

    </div>
@endsection