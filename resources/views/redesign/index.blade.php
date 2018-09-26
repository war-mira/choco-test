@extends('redesign.layouts.app')
@section('content')

    <!-- section intro start -->
    <section class="index-intro pattern-bg">
        @include('redesign.partials.nav_line')
        <div class="container">
            <div class="index-intro__container">
                <div class="index-intro__heading">
                    <div>Бесплатный сервис поиска врача</div>
                    <div>НАЙТи ПРОВЕРЕННОГО Врача — легко!</div>
                </div>

                @include('redesign.partials.index.search')

                <div class="index-intro__stats">
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-1.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Doctor::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Врачей работают с нами</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-2.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Callback::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Записались через нас</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-3.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Comment::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Реальных отзывов</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section intro end -->

    <!-- begin questions -->
        <div class="section questions">
            @include('redesign.partials.questions_list')
        </div>
    <!-- end section -->

    <!-- section letter search start -->
    <section class="section pattern-bg doc-letter-search">
        <div class="container">
            <div class="section-heading doc-letter-search__heading">
                <div class="section-heading__text">Быть здоровым - просто!</div>
                <div class="section-heading__descr">Мы поможем найти проверенного врача и записаться на прием в удобное
                    для Вас время
                </div>
            </div>
            <div class="doc-letter-search__search">
                <div class="doc-letter-search__result" id="doc-letter-search__result">
                    @foreach($skillsList->chunk(ceil($skillsList->count()/3)) as $skillLinksColumn)
                        <div class="doc-letter-search__result-column">
                            @foreach($skillLinksColumn as $skillLink)
                                <a href="{{ $skillLink['href'] }}" class="doc-letter-search__result-item" title="{{$skillLink['name']}}">
                                    <span class="doc-letter-search__result-item-text">{{$skillLink['name']}}</span>
                                    <span class="doc-letter-search__result-item-count">{{$skillLink['doctorsCount']}}</span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- section search end -->

    <!-- section work-flow start -->
    <section class="section work-flow">
        <div class="container">
            <div class="section-heading work-flow__heading">
                <div class="section-heading__text">Как это работает?</div>
            </div>
            <div class="work-flow__steps">
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>1</span>
                        <img src="{{asset('img/work-flow-1.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Находите нужного специалиста</div>
                </div>
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>2</span>
                        <img src="{{asset('img/work-flow-2.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Записываетесь на прием <a href="#quick-order-modal"
                                                                                      rel="modal-link">онлайн</a> или по
                        телефону
                    </div>
                </div>
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>3</span>
                        <img src="{{asset('img/work-flow-3.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Оцениваете работу врача или клиники после посещения</div>
                </div>
            </div>
            <div class="video-block">
                <div class="video-block__videoframe">
                    <iframe src="https://drive.google.com/file/d/1UyUMN_E7BsqqwKjA9FIpKguI1N7FCjDk/preview" width="640" height="480"  frameborder="0" allow="autoplay; encrypted-media"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- section work-flow end -->

    <!-- section blog-list start -->
    <section class="section blog-list">
        <div class="container">
            <div class="section-heading blog-list__heading">
                <div class="section-heading__text">Новости и блоги</div>
            </div>
            <div class="blog-list__list">
                @foreach($topPosts as $post)
                    <div class="blog-item blog-list__list-item toning"
                         style="background-image: url({{ URL::asset($post['cover_image'])}});">
                        <div class="blog-item__name">{{$post['title']}}</div>
                        <div class="blog-item__bot-line">
                            <a href="{{url('post/'.$post['alias'])}}"
                               class="blog-item__link"><span>Читать целиком</span><i class="fa fa-chevron-right"
                                                                                     aria-hidden="true"></i></a>
                            <div class="blog-item__date">
                                <div>Дата публикации</div>
                                <div>{{$post['created_at']->format('Y-m-d')}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="blog-list__load-more"><a href="{{url('posts')}}">Больше записей</a></div>
        </div>
    </section>
    <!-- section blog-list end -->

    <!-- section partners start-->
    <section class="section partners">
        <div class="container">
            <div class="section-heading partners__heading">
                <div class="section-heading__text">Наши партнеры</div>
            </div>
            <div class="partners__list">
                <div class="partners__list-item"><img src="{{asset('img/partner/1.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/2.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/3.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/4.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/5.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/6.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/7.jpg')}}" alt=""></div>
            </div>
        </div>
    </section>
    <!-- section partners end-->
    <style>
        .index-intro {
            height:fit-content!important;
        }
    </style>
@endsection