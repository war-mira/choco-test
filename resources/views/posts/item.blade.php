@extends('app')

@section('content')
<!-- begin section -->
<div class="section top-clear">

    <!-- begin container -->
    <div class="container">

        @component('components.navigation-path',
        ['nodes'=>
          [
            [
                'name'=>'Главная',
                'href'=>'/'
            ],
            [
                'name'=>'Новости, интервью, блоги',
                'href'=>'/posts'
            ]
          ]
        ])
        @endcomponent

        <h1 class="page-title mbottom-40">{{$post->title}}</h1>
        @if($post->cover_image)
        <p class="mbottom-40"><img class="img-rounded" src="{{asset($post->cover_image)}}" alt=""></p>
        @endif

        <div class="middle">
            <div class="column column--left">
                {!!str_replace('\r\n',' ',$post->content)!!}
            </div>
            <div class="sidebar sidebar--right">
                <div class="sidebar__section">
                    @component('elements.banners-slider',['position'=>\App\Banner::POSITION_EXT_A['id']])
                    @endcomponent
                </div>
            </div>
        </div>

    </div>
    <!-- end container -->

</div>
<!-- end section -->


@endsection
