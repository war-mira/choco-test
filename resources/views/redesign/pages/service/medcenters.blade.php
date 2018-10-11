@extends('redesign.layouts.inner-page')
@section('content')
    {{-- @include('search.search_box_service')--}}
    @include('search.filtr_service',[
               'service_count'=> false,
               'breadcrumb_route'=>'service.medcenter',
               'params' => [
                    'parent' => [
                              'parent'=> 'Медицинские услуги',
                               'parent_url'=>route('service.index'),
                               'title' => $service->group->name,
                               'url' =>route('service.group',$service->group->alias)
                    ],
                    'title' => $service->name
               ]
           ])
    <section class="pages--service pages--service__medcenters">
        <div class="container">
            <div class="search-result__list">
                <div class="results d-result service-med-line" data-type="medcenters"
                     data-id="" id="medcenters-result">

                    @foreach($service->medcenters as $medcenter)
                        <div class="medcenter__item  search-result__item entity-line">
                            @component('model.service.medcenter_profile-short',[
                            'medcenter'=>$medcenter
                            ])
                            @endcomponent
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>
@endsection

