@extends('app')
@section('content')

    <!-- begin section -->
    <div class="section top-clear bottom-clear">

        <!-- begin container -->
        <div class="container">

            <div class="line"></div>

            <!-- begin breadcrumbs -->
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a></li>
                    <li class="breadcrumbs__item">Клиники</li>
                </ul>
            </nav>
            <!-- end breadcrumbs -->

            <h1 class="page-title">{{empty($meta['h1']) ? $h1_title : $meta['h1']}} </h1>


            <!-- end seo -->
            <div class="sort">
                <p class="sort__text">Упорядочить:</p>
                <ul class="sort__list  mbottom-10">
                    @foreach($sortOptions as $option)
                        <li class="sort__item {{($filter['sort'] == $option['sort']) ? 'current' : ''}}"><a
                                    href="{{
                                Request::fullUrlWithQuery([
                                'sort' => $option['sort'],
                                'order' => (
                                ($filter['sort'] == $option['sort'] && $filter['order'] == 'desc')
                                ?
                                'asc'
                                :
                                'desc')
                                ])}}">
                                {{$option['name']}}
                                @if($filter['sort'] == $option['sort'])
                                    <span class="glyphicon glyphicon-chevron-{{($filter['order']== 'asc') ? 'up' : 'down'}}"></span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- begin middle -->
            <div class="middle">

                <!-- begin column -->
                <div class="column column--left">

                    <!-- begin profiles -->
                    <div class="profiles">

                        <!-- begin profiles__item -->
                        @foreach($Medcenters as $Medcenter)
                            <div class="profiles__item profiles__item--clinic">
                                <div class="profiles__left">
                                    <img class="profiles__img" src="{{asset($Medcenter->avatar)}}" width="120"
                                         height="120"
                                         alt="">
                                    @component('components.rating-stars',['rating' => $Medcenter['rate']])
                                    @endcomponent
                                </div>
                                <div class="profiles__right">
                                    <header class="profiles__header">
                                        <h3 class="profiles__title">
                                            <a href="{{$Medcenter->href}}">{{$Medcenter['name']}}</a>
                                        </h3>
                                        <p class="text-black">Многопрофильное медицинское учреждение</p>
                                    </header>
                                    <ul class="profiles__desc-list">
                                        <li><span>Врачей:</span> {{$Medcenter->publicDoctors()->count()}}</li>
                                        <li><span>Специализаций:</span> {{$Medcenter->skills()->count()}}</li>
                                        <li><a class="link-dotted" href="#777">{{$Medcenter->city->name}}</a></li>

                                    </ul>
                                    <p class="text-small">{!!$Medcenter['content_lite']!!}</p>
                                    <?php if(!empty($Medcenter['price'])){ ?>
                                    <p class="profiles__price">Стоимость приема: от <strong>{{$Medcenter['price']}}
                                            тг</strong></p>
                                    <?php } ?>
                                    <footer class="profiles__footer">
                                        <a class="button" href="{{$Medcenter->href}}">Подробнее</a>
                                    </footer>
                                </div>
                            </div>
                    @endforeach
                    <!-- end profiles__item -->
                    </div>
                    <!-- end profiles -->

                    <!-- begin pagination -->
                {{ $Pagination->links('vendor.pagination.default') }}
                <!-- end pagination -->

                </div>
                <!-- end column -->

                <!-- begin sidebar -->
                <aside class="sidebar sidebar--right">
                    <div class="sidebar__section">
                        @component('elements.banners-slider',['position'=>\App\Banner::POSITION_EXT_B['id']])
                        @endcomponent
                    </div>
                </aside>
                <!-- end sidebar -->

            </div>
            <!-- end middle -->

        @if(!empty($meta['seoText']))
            <!-- begin section -->
                <div class="section top-clear">

                    <!-- begin container -->
                    <div class="container">

                        <!-- begin middle -->
                        <div class="middle">

                            {!! $meta['seoText'] !!}

                        </div>
                        <!-- end middle -->

                    </div>
                    <!-- end container -->

                </div>
                <!-- end section -->
        @endif

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

@endsection
