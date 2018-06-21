@extends('redesign.layouts.app')
@section('header')
    <div class="title-block">
        <h1 class="title-block__h1">
            Бесплатный сервис поиска врача
        </h1>
        <h2 class="title-block__h2">
            Найти проверенного врача - легко!
        </h2>
    </div>
    <!-- /Title block -->
    @component('redesign.partials.index.search')
    @endcomponent
    <!-- /Search block -->
    <div class="container benefits-block">
        <div class="row">
            <div class="col-sm-4">
                <div class="benefits-item">
                    <div class="benefits-item__icon"><img src="img/icons/stethoscope.svg" alt=""></div>
                    <div class="benefits-item__number">{{$stats['doctors_count']}}</div>
                    <div class="benefits-item__text">Врачей работают с нами</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="benefits-item">
                    <div class="benefits-item__icon"><img src="img/icons/clipboard.svg" alt=""></div>
                    <div class="benefits-item__number">{{$stats['orders_count']}}</div>
                    <div class="benefits-item__text">Записались через нас</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="benefits-item">
                    <div class="benefits-item__icon"><img src="img/icons/heartfeed.svg" alt=""></div>
                    <div class="benefits-item__number">{{$stats['comments_count']}}</div>
                    <div class="benefits-item__text">Реальных отзывов</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if($topDoctors->count() > 0)
        <section class="doctors-top">
            <div class="container">
                <h2 class="block-title">
                    Топ врачей
                </h2>
                <!-- /Title -->
                <div class="top-carousel">
                    <div class="row">
                        @foreach($topDoctors as $doctor)
                            <div class="col-sm-3">
                                <div class="top-doctor-item">
                                    <div class="top-doctor-item__image">
                                        <div class="top-doctor-item__rating-view rating-view--good">{{round($doctor->rate,1)}}
                                            /
                                            5
                                        </div>
                                        <div class="top-doctor-item__photo">
                                            <div class="top-doctor-item__favorite-btn">
                                                <span></span>
                                            </div>
                                            <img src="{{$doctor->avatar}}" alt="">
                                        </div>
                                    </div>


                                    <div class="top-doctor-item__name">{{$doctor->name}}</div>
                                    <div class="top-doctor-item__speciality">{{$doctor->main_skill->name}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <ul class="top-carousel-paging">
                        <li class="top-carousel-paging__li"></li>
                        <li class="top-carousel-paging__li top-carousel-paging__li--active"></li>

                    </ul>

                </div>
            </div>
        </section>
    @endif

    @if($skillsList->count() > 0)
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 offset-sm-1">
                    <div class="specialities-block">
                        <ul class="specialities-block__tabs">
                            <li class="speciality-li">A</li>
                            <li class="speciality-li">Б</li>
                            <li class="speciality-li">В</li>
                            <li class="speciality-li">Г</li>
                            <li class="speciality-li">Д</li>
                            <li class="speciality-li">Е</li>
                        </ul>
                        <!-- /tabs -->
                        <div class="specialities-block__content">
                            <div class="row">
                                @foreach($skillsList->chunk((int)(ceil($skillsList->count()/3))) as $skillsColumn)
                                    <div class="col-sm-4">
                                        <ul class="specialities-block__column">
                                            @foreach($skillsColumn as $skill)
                                                <li><a href="{{$skill['href']}}">{{$skill['name']}}</a><span
                                                            class="column-li__number">{{$skill['doctorsCount']}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="how-it-works">
        <h2 class="block-title white">
            Как это работает?
        </h2>
        <div class="container">
            <div class="steps">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="step">
                            <div class="step__image">
                                <div class="step__icon">
                                    <img src="img/icons/step1.svg" alt="">
                                </div>
                                <div class="step__number">1</div>
                            </div>
                            <div class="step__text">Находите нужного специалиста
                            </div>
                        </div>
                    </div>
                    <!-- /Step 1 -->
                    <div class="col-sm-4">
                        <div class="step">
                            <div class="step__image">
                                <div class="step__icon">
                                    <img src="img/icons/step2.svg" alt="">
                                </div>
                                <div class="step__number">2</div>
                            </div>
                            <div class="step__text">Записываетесь на прием
                                онлайн или по телефону
                            </div>

                        </div>
                    </div>
                    <!-- /Step 2 -->
                    <div class="col-sm-4">
                        <div class="step">
                            <div class="step__image">
                                <div class="step__icon">
                                    <img src="img/icons/step3.svg" alt="">
                                </div>
                                <div class="step__number">3</div>
                            </div>
                            <div class="step__text">Оцениваете работу врача или
                                клиники после посещения
                            </div>

                        </div>
                    </div>
                    <!-- /Step 3 -->
                </div>
            </div>
            <div class="video-block">
                <div class="video-block__videoframe">
                    <iframe width="420" height="270" src="https://www.youtube.com/embed/HXKPZaBTbNE" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- /How it works -->
    @if($topPromotions->count() > 0)
        <section class="promotion">
            <h2 class="block-title">
                Акции и скидки
            </h2>
            <div class="container pt20">
                <div class="row">
                    @foreach($topPromotions as $promotion)
                        <div class="col-sm-4">
                            <div class="promotion__item">
                                <div class="promotion__content">
                                    <div class="promotion__content__percentage">{{$promotion->discount_text}}</div>
                                    <div class="promotion__content__title">{{$promotion->title}}</div>
                                    <div class="promotion__content__description">{{$promotion->short_description}}</div>
                                    <div class="promotion__content__pricing">
                                        <span class="promotion__old-price">{{$promotion->old_price}}</span><span
                                                class="promotion__new-price">{{$promotion->new_price}}</span>
                                    </div>
                                    <a class="promotion__content__more-btn" href="#">
                                        Подробнее
                                    </a>
                                </div>
                                <div class="promotion__image">
                                    <div class="promotion__image__mask"></div>
                                    <img src="{{$promotion->cover_image}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="advertising">
        <div class="container">
            <div class="row">
                <div class="col">
                    @component('elements.banners-slider',['position' =>\App\Banner::POSITION_MAIN_B['id']])

                    @endcomponent
                </div>
            </div>
        </div>
    </section>
    @if($topPosts->count() > 0)
        <!-- /Adv block -->
        <section class="news">

            <h2 class="block-title">
                Новости и блоги
            </h2>
            <div class="container pt20">
                <div class="row">
                    @foreach($topPosts as $post)
                        <div class="col-sm-4">
                            <div class="news__item">
                                <div class="news__content">
                                    <div class="news__content__title">{{$post['title']}}</div>

                                    <a class="news__content__more-btn" href="{{url('post/'.$post['alias'])}}"
                                       tabindex="-1">
                                        Читать целиком <span class="next-arrow"></span>
                                    </a>
                                    <div class="news__content__description">
                                        <div>
                                            Дата публикации
                                        </div>
                                        <span class="news__date">{{$post['date']}}</span>
                                    </div>
                                </div>
                                <div class="news__image">
                                    <div class="news__image__mask"></div>
                                    <img src="{{$post['cover_image']}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="news__more-btn">Больше записей</div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- /News -->
    <section class="partners">
        <h2 class="block-title">
            Наши партнеры
        </h2>
        <div class="container pt20">
            <div class="row">
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/1.jpg" alt="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/2.jpg" alt="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/3.jpg" alt="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/4.jpg" alt="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/5.jpg" alt="">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="partners__item">
                        <img src="img/partners/6.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection