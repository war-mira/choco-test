@extends('redesign.layouts.inner-page')
@section('content')
    {{-- @include('search.search_box_service')--}}
    <section class="pages--service pages--service__index">

        @include('search.filtr_service',compact('service_count'))
        <div class="container questions--list">
            @foreach($serviceGroups->chunk(2) as $group)
                <div class="service-list-block">
                    @foreach($group as $item)
                        <div class="service-list-column">
                            <div class="entity-line__name">
                                <a href="{{route('service.group',['alias' => $item->alias])}}">{{$item->name}}</a>
                            </div>
                            <div class="entity-line__list">
                                <ul>
                                    @foreach($item->services()->limit(10)->get() as $service)
                                        <li>
                                            <a href={{route('service.medcenter-list',['group'=>$item->alias,'alias'=>$service->alias])}}>{{$service->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                @if($item->services->count() > 10)
                                    <div class="service-list__more">
                                        <a href="{{route('service.group',['alias'=>$item->alias])}}" class="library-list__btn btn transparent">Показать еще</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@endsection

