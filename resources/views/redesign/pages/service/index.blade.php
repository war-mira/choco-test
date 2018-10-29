@extends('redesign.layouts.inner-page')
@section('content')
    {{-- @include('search.search_box_service')--}}
    @include('search.filtr_service',[
            'service_count'=> $service_count,
            'breadcrumb_route'=>'service.index',
            'params' => [
               'title'=> 'Медицинские услуги'
               ]
        ])
    <section class="pages--service pages--service__index">

        
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
                                        @if($service->medcenters()->count() > 0)
                                        <li>
                                            <a href={{route('service.medcenter-list',['group'=>$item->alias,'alias'=>$service->alias])}}>{{$service->name}}</a>
                                        </li>
                                        @endif
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

