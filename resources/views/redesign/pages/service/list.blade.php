@extends('redesign.layouts.inner-page')
@section('content')
    <section class="pages--service pages--service__list">
        @include('search.filtr_service',[
                   'service_count'=> $serviceGroup->services->count(),
                   'breadcrumb_route'=>'service.list',
                   'params' => [
                      'parent'=> 'Медицинские услуги',
                      'parent_url'=>route('service.index'),
                      'title' => $serviceGroup->name
                      ]
               ])
     <div class="container questions--list">
         <div class="entity-line__name">
            {{$serviceGroup->name}}
        </div>
            <div class="service-list-block">    

                @foreach($serviceGroup->services->chunk($serviceGroup->services->count()/4) as $service_group)
                    <div class="service-list-column">
                        <div class="entity-line__list">
                            <ul>
                            @foreach($service_group as $service)
                                <li>
                                    <a href={{route('service.medcenter-list',['group'=>$serviceGroup->alias,'alias'=>$service->alias])}}>{{$service->name}}</a>
                                </li>
                            @endforeach
                            </ul>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
      
        
    </section>
@endsection