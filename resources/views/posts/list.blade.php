@extends('app')

@section('content')
<!-- begin content -->
<div class="content">

    <!-- begin section -->
    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
        @component('components.navigation-path',
    ['nodes'=>
      [
        [
            'name'=>'Главная',
            'href'=>'/'
        ],
        [
            'name'=>'Новости, интервью, блоги'
        ]
      ]
    ])
        @endcomponent
            <!-- end breadcrumbs -->

            <h1 class="page-title">Новости, интервью, блоги</h1>

            <!-- begin news -->
            <div class="news">
                @foreach($posts as $post)
                <div class="news__item item-news">
                    <div class="item-news__inner">
                        <a href="{{url('post/'.$post->alias)}}" class="item-news__img"
                           style="background-image:url({{$post->cover_image}})"></a>
                        <h3 class="item-news__title">
                            <a href="{{url('post/'.$post->alias)}}">{{$post->title}}</a>
                        </h3>
                        <p class="item-news__meta">
                            <a href="{{url('post/'.$post->alias)}}">Блоги</a>
                            <span class="date">{{$post->created_at->format('Y-m-d')}}</span>

                        </p>
                        <div class="item-news__text">
                            <p>{{$post->content_lite}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end news -->

            <!-- begin pagination -->
        {{ $posts->links('vendor.pagination.default') }}
            <!-- end pagination -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

</div>
<!-- end content -->


@endsection
