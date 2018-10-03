@extends('admin.app')
@section('content')

    @component('components.form.pair-select')
        @slot('id',$id)
        @slot('data1',$data1)
        @slot('data2',$data2)
    @endcomponent

@endsection