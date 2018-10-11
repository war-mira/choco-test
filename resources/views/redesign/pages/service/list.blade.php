@extends('redesign.layouts.app')
@section('content')
    <section class="pages--service__list">
        @foreach($serviceGroup->services as $item)
            <a href="{{route('service.service-list',[
            'group'=>$serviceGroup->alias,
            'alias'=>$item->alias
            ])}}">
                {{$item->name}}
            </a>
        @endforeach
    </section>
@endsection

