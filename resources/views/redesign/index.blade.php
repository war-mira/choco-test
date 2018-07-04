@extends('redesign.layouts.app')
@section('content')

    <!-- section intro start -->
    <section class="index-intro pattern-bg">
        <div class="index-nav-line">
            <div class="container">
                <div class="index-intro__container">
                    <nav class="index-nav">
                        <a href="{{route('doctors.list')}}" class="index-nav__item index-nav-item">
                            <span class="index-nav-item__icon"><i class="icon-1 hover-icon"></i></span>
                            <span>Врачи</span>
                        </a>
                        <a href="{{route('medcenters.list')}}" class="index-nav__item index-nav-item">
                            <span class="index-nav-item__icon"><i class="icon-2 hover-icon"></i></span>
                            <span>Медцентры</span>
                        </a>
                        {{--<a href="#" class="index-nav__item index-nav-item">--}}
                        {{--<span class="index-nav-item__icon"><i class="icon-3 hover-icon"></i></span>--}}
                        {{--<span>Услуги</span>--}}
                        {{--</a>--}}
                        {{--<a href="#" class="index-nav__item index-nav-item">--}}
                        {{--<span class="index-nav-item__icon"><i class="icon-4 hover-icon"></i></span>--}}
                        {{--<span>Библиотека</span>--}}
                        {{--</a>--}}
                        <a href="#" class="index-nav__item index-nav-item">
                            <span class="index-nav-item__icon"><i class="icon-5 hover-icon"></i></span>
                            <span>Акции</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

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
        <div class="heart-bg responsive_hide">
            <img src="img/heart.png" alt="">
        </div>
    </section>
    <!-- section intro end -->

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
                {{--<div class="doc-letter-search__nav">--}}
                {{--<a href="#" class="doc-letter-search__nav-item">Г</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">К</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">И</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">В</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">Д</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">Л</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">А</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">М</a>--}}
                {{--<a href="#" class="doc-letter-search__nav-item">Н</a>--}}
                {{--</div>--}}
                <div class="doc-letter-search__result" id="doc-letter-search__result">
                    @foreach($skillsList->chunk(ceil($skillsList->count()/3)) as $skillLinksColumn)
                        <div class="doc-letter-search__result-column">
                            @foreach($skillLinksColumn as $skillLink)
                                <a href="{{ $skillLink['href'] }}" class="doc-letter-search__result-item">
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
                    <iframe src="https://www.youtube.com/embed/OkHU9CY7sjA" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- section work-flow end -->

    <!-- section special-offer-list start // service not launched yet -->
    {{--<section class="special-offer-list section">--}}
    {{--<div class="container">--}}
    {{--<div class="section-heading special-offer-list__heading">--}}
    {{--<div class="section-heading__text">Акции и скидки</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list">--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p1.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Консультация хирурга</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите обследование со скидкой 20%</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">5 000 тг.</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p2.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Прием окулиста</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите обследование со скидкой 20%</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">5 000 тг.</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p3.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Обследование у кардиохирурга</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите обследование со скидкой 20%</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">5 000 тг.</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p4.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Курс массажа</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите обследование со скидкой 20%</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">5 000 тг.</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p5.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Ароматерапия</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите ароматерапию</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">БЕСПЛАТНО</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-item toning" style="background-image: url('img/special-offer/p6.jpg');">--}}
    {{--<div class="special-offer-item__discount">-50%</div>--}}
    {{--<div class="special-offer-item__name">Консультация хирурга</div>--}}
    {{--<div class="special-offer-item__descr">Пройдите обследование со скидкой 20%</div>--}}
    {{--<div class="special-offer-item__bot-line">--}}
    {{--<div class="special-offer-item__price">--}}
    {{--<div class="special-offer-item__old-price">10 000 тг.</div>--}}
    {{--<div class="special-offer-item__new-price">5 000 тг.</div>--}}
    {{--</div>--}}
    {{--<a href="#" class="special-offer-item__link btn">Подробнее</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="special-offer-list__list-item special-offer-list__list-item_promo promo-block pattern-bg">--}}
    {{--<div class="promo-block__img"><img src="img/glasess.png" alt=""></div>--}}
    {{--<div class="promo-block__text">--}}
    {{--<div>Рекламное место</div>--}}
    {{--<div>эффективно & эффектно</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <!-- section special-offer-list end -->

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
            </div>
        </div>
    </section>
    <!-- section partners end-->
@endsection