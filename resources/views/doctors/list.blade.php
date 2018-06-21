@extends('app')
@section('content')
    <!-- begin section -->

    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">

            <div class="line"></div>

            <!-- begin breadcrumbs -->
            @component('components.navigation-path',['nodes'=>$navigation])
            @endcomponent
            <div class="row">
                <div class="col-md-9">
                    @include('search.livesearch')
                </div>
            </div>


            <div class="sort">
                <p class="sort__text">Упорядочить:</p>
                <ul class="sort__list  mbottom-10">
                    <li class="sort__item {{(($filter['sort'] ?? 'rate') == 'rate') ? 'current' : ''}}"><a
                                href="{{Request::fullUrlWithQuery(['sort' => 'rate','order' => (($filter['order'] == 'asc') ? 'desc': 'asc')])}}">по
                            рейтингу
                            <span class="glyphicon glyphicon-chevron-{{(($filter['order'] ?? 'rate') == 'asc') ? 'up' : 'down'}}"></span></a>
                        </li>
                    <li class="sort__item {{(($filter['sort'] ?? 'rate') == 'rate') ? 'current' : ''}}"><a
                                href="{{Request::fullUrlWithQuery(['sort' => 'rate','order' => (($filter['order'] == 'asc') ? 'desc': 'asc')])}}">по
                            рейтингу
                            <span class="glyphicon glyphicon-chevron-{{(($filter['order'] ?? 'rate') == 'asc') ? 'up' : 'down'}}"></span></a>
                    </li>
                </ul>
                <form action=""
                      class="row mbottom-10 form-inline">
                    <input type="hidden" name="sort" value="{{request()->input('sort','rate')}}">
                    <input type="hidden" name="order" value="{{request()->input('order','desc')}}">
                </form>
                <!-- end sort -->

                <!-- begin middle -->
                <div class="middle">

                    <!-- begin column -->
                    <div class="column column--left">

                        <!-- begin profiles -->
                        <div class="profiles">
                            @foreach($doctors as $doctor)
                                <div class="profiles__item{{(isset($doctor['is_top_doc']) && $doctor['is_top_doc']) ? " pretty_profile" : "" }}">
                                    @include('model.doctor.profile-short',['width'=>'150px','height'=>'150px'])
                                </div>
                            @endforeach
                        </div>
                        <!-- end profiles -->

                        <!-- begin pagination -->
                    {{ $links }}
                    <!-- end pagination -->

                    </div>
                    <!-- end column -->

                    <!-- begin sidebar -->
                    <aside class="sidebar sidebar--right">
                        <div style="display:none" class="sidebar__section">
                            <h3 class="sidebar__title">Быстрая запись</h3>
                            <p>Текст о том, что если нет времени, то нажмите кнопку ниже, с вами свяжется оператор и все
                                хорошо.</p>
                            <a class="button" href="#reception" rel="modal:open">Записаться быстро</a>
                        </div>
                        @component('elements.banners-slider',['position' => App\Banner::POSITION_EXT_A['id']])

                        @endcomponent

                    </aside>
                    <!-- end sidebar -->

                </div>
                <!-- end middle -->

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->

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

@endsection
